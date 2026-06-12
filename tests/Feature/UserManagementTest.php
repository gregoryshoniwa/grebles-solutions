<?php

use App\Models\Company;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

function makeOwnerWithCompany(): User
{
    $owner = User::factory()->create(['role' => User::ROLE_OWNER]);
    $company = Company::factory()->create(['owner_id' => $owner->id]);
    $owner->forceFill(['company_id' => $company->id])->save();

    return $owner->fresh();
}

test('guests cannot access the admin area', function () {
    get('/admin')->assertRedirect(route('login'));
});

test('customers cannot access the admin area', function () {
    actingAs(makeOwnerWithCompany());

    get('/admin')->assertForbidden();
    get('/admin/users')->assertForbidden();
});

test('admins can view the admin dashboard and users index', function () {
    actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]));

    get('/admin')->assertOk();
    get('/admin/users')->assertOk();
});

test('admins are redirected from dashboard to the admin overview', function () {
    actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]));

    get('/dashboard')->assertRedirect('/admin');
});

test('an admin can suspend a user and the user is locked out', function () {
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    $customer = makeOwnerWithCompany();

    actingAs($admin);
    patch("/admin/users/{$customer->id}", ['is_active' => false])->assertRedirect();

    expect($customer->fresh()->is_active)->toBeFalse();

    actingAs($customer->fresh());
    get('/dashboard')->assertRedirect(route('login'));
    $this->assertGuest();
});

test('an admin cannot suspend or delete themselves', function () {
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

    actingAs($admin);
    patch("/admin/users/{$admin->id}", ['is_active' => false])->assertSessionHasErrors('user');
    delete("/admin/users/{$admin->id}")->assertSessionHasErrors('user');

    expect($admin->fresh()->is_active)->toBeTrue();
});

test('an owner can add a team member to their company', function () {
    $owner = makeOwnerWithCompany();

    actingAs($owner);
    post('/team', [
        'name' => 'Assistant One',
        'email' => 'assistant@example.com',
        'password' => 'SuperSecret9!',
    ])->assertRedirect();

    $member = User::where('email', 'assistant@example.com')->firstOrFail();
    expect($member->role)->toBe(User::ROLE_MEMBER)
        ->and($member->company_id)->toBe($owner->company_id);
});

test('an owner can remove a team member but not themselves', function () {
    $owner = makeOwnerWithCompany();
    $member = User::factory()->create([
        'role' => User::ROLE_MEMBER,
        'company_id' => $owner->company_id,
    ]);

    actingAs($owner);
    delete("/team/{$member->id}")->assertRedirect();
    expect(User::find($member->id))->toBeNull();

    delete("/team/{$owner->id}")->assertSessionHasErrors('member');
    expect(User::find($owner->id))->not->toBeNull();
});

test('members cannot manage the team', function () {
    $owner = makeOwnerWithCompany();
    $member = User::factory()->create([
        'role' => User::ROLE_MEMBER,
        'company_id' => $owner->company_id,
    ]);

    actingAs($member);
    get('/team')->assertForbidden();
    post('/team', [
        'name' => 'Sneaky',
        'email' => 'sneaky@example.com',
        'password' => 'SuperSecret9!',
    ])->assertForbidden();
});

test('an owner cannot remove a member of another company', function () {
    $ownerA = makeOwnerWithCompany();
    $ownerB = makeOwnerWithCompany();
    $memberB = User::factory()->create([
        'role' => User::ROLE_MEMBER,
        'company_id' => $ownerB->company_id,
    ]);

    actingAs($ownerA);
    delete("/team/{$memberB->id}")->assertForbidden();
    expect(User::find($memberB->id))->not->toBeNull();
});
