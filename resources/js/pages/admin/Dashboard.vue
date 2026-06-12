<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    Building2,
    ShieldAlert,
    TrendingUp,
    UserCheck,
    Users,
} from '@lucide/vue';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Admin', href: '/admin' }],
    },
});

defineProps<{
    stats: {
        companies: number;
        owners: number;
        members: number;
        suspended: number;
        newThisMonth: number;
    };
    recentUsers: Array<{
        id: number;
        name: string;
        email: string;
        role: string;
        is_active: boolean;
        created_at: string;
        company: { id: number; name: string } | null;
    }>;
}>();

const roleBadge: Record<string, string> = {
    admin: 'bg-red-500/10 text-red-500 border-red-500/20',
    owner: 'bg-blue-500/10 text-blue-500 border-blue-500/20',
    member: 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
};

function formatDate(value: string): string {
    return new Date(value).toLocaleDateString(undefined, {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
}
</script>

<template>
    <Head title="Admin · Overview" />

    <div class="flex h-full flex-1 flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Platform overview</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Every customer, company and team member on Grebles — at a glance.
                </p>
            </div>
            <Link
                href="/admin/users"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-500"
            >
                Manage users
                <ArrowRight class="size-4" />
            </Link>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border">
                <span class="flex size-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-500">
                    <Building2 class="size-5" />
                </span>
                <p class="mt-4 text-3xl font-bold">{{ stats.companies }}</p>
                <p class="mt-1 text-sm text-muted-foreground">Companies</p>
            </div>
            <div class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border">
                <span class="flex size-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-500">
                    <UserCheck class="size-5" />
                </span>
                <p class="mt-4 text-3xl font-bold">{{ stats.owners }}</p>
                <p class="mt-1 text-sm text-muted-foreground">Customer owners</p>
            </div>
            <div class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border">
                <span class="flex size-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-500">
                    <Users class="size-5" />
                </span>
                <p class="mt-4 text-3xl font-bold">{{ stats.members }}</p>
                <p class="mt-1 text-sm text-muted-foreground">Team members</p>
            </div>
            <div class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border">
                <span class="flex size-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-500">
                    <TrendingUp class="size-5" />
                </span>
                <p class="mt-4 text-3xl font-bold">{{ stats.newThisMonth }}</p>
                <p class="mt-1 text-sm text-muted-foreground">New this month</p>
            </div>
            <div class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border">
                <span class="flex size-10 items-center justify-center rounded-xl bg-red-500/10 text-red-500">
                    <ShieldAlert class="size-5" />
                </span>
                <p class="mt-4 text-3xl font-bold">{{ stats.suspended }}</p>
                <p class="mt-1 text-sm text-muted-foreground">Suspended</p>
            </div>
        </div>

        <div class="rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border">
            <div class="flex items-center justify-between border-b border-sidebar-border/70 px-6 py-4 dark:border-sidebar-border">
                <h2 class="font-semibold">Recent signups</h2>
                <Link href="/admin/users" class="text-sm text-blue-500 hover:underline">
                    View all
                </Link>
            </div>
            <div class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                <div
                    v-for="user in recentUsers"
                    :key="user.id"
                    class="flex flex-wrap items-center gap-3 px-6 py-3.5"
                >
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-medium">
                            {{ user.name }}
                            <span v-if="!user.is_active" class="ml-2 text-xs text-red-500">suspended</span>
                        </p>
                        <p class="truncate text-sm text-muted-foreground">{{ user.email }}</p>
                    </div>
                    <span class="hidden text-sm text-muted-foreground sm:block">
                        {{ user.company?.name ?? '—' }}
                    </span>
                    <span
                        class="rounded-full border px-2.5 py-0.5 text-xs font-medium capitalize"
                        :class="roleBadge[user.role]"
                    >
                        {{ user.role }}
                    </span>
                    <span class="w-24 text-right text-xs text-muted-foreground">
                        {{ formatDate(user.created_at) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
