<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'companies' => Company::count(),
                'owners' => User::where('role', User::ROLE_OWNER)->count(),
                'members' => User::where('role', User::ROLE_MEMBER)->count(),
                'suspended' => User::where('is_active', false)->count(),
                'newThisMonth' => User::where('created_at', '>=', now()->startOfMonth())->count(),
            ],
            'recentUsers' => User::with('company:id,name')
                ->latest()
                ->take(8)
                ->get(['id', 'name', 'email', 'role', 'company_id', 'is_active', 'created_at']),
        ]);
    }
}
