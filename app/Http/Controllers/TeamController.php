<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        abort_unless($user->isOwner(), 403);

        $company = $this->resolveCompany($user);

        return Inertia::render('team/Index', [
            'company' => $company->only(['id', 'name']),
            'members' => $company->users()
                ->orderByRaw("role = 'owner' desc")
                ->orderBy('name')
                ->get(['id', 'name', 'email', 'role', 'is_active', 'created_at']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isOwner(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::default()],
        ]);

        $company = $this->resolveCompany($user);

        User::create([
            ...$validated,
            'role' => User::ROLE_MEMBER,
            'company_id' => $company->id,
        ])->forceFill(['email_verified_at' => now()])->save();

        return back()->with('success', "{$validated['name']} added to your team.");
    }

    public function destroy(Request $request, User $member): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isOwner(), 403);
        abort_unless($member->company_id === $user->company_id, 403);

        if ($member->is($user) || $member->isOwner()) {
            return back()->withErrors(['member' => 'The company owner cannot be removed.']);
        }

        $member->delete();

        return back()->with('success', "{$member->name} removed from your team.");
    }

    private function resolveCompany(User $user): Company
    {
        if ($user->company_id !== null) {
            return $user->company;
        }

        $company = Company::create([
            'name' => "{$user->name}'s Company",
            'owner_id' => $user->id,
        ]);

        $user->forceFill(['company_id' => $company->id])->save();

        return $company;
    }
}
