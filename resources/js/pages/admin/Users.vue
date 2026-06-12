<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Search, ShieldCheck, ShieldOff, Trash2 } from '@lucide/vue';
import { ref, watch } from 'vue';
import { Input } from '@/components/ui/input';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Admin', href: '/admin' },
            { title: 'Users', href: '/admin/users' },
        ],
    },
});

type AdminUser = {
    id: number;
    name: string;
    email: string;
    role: string;
    is_active: boolean;
    created_at: string;
    company: { id: number; name: string } | null;
};

const props = defineProps<{
    users: {
        data: AdminUser[];
        links: Array<{ url: string | null; label: string; active: boolean }>;
        total: number;
    };
    filters: { search?: string; role?: string };
}>();

const search = ref(props.filters.search ?? '');
const role = ref(props.filters.role ?? '');
let searchDebounce: ReturnType<typeof setTimeout> | undefined;

watch([search, role], () => {
    clearTimeout(searchDebounce);
    searchDebounce = setTimeout(() => {
        router.get(
            '/admin/users',
            { search: search.value || undefined, role: role.value || undefined },
            { preserveState: true, replace: true },
        );
    }, 350);
});

const roleBadge: Record<string, string> = {
    admin: 'bg-red-500/10 text-red-500 border-red-500/20',
    owner: 'bg-blue-500/10 text-blue-500 border-blue-500/20',
    member: 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
};

function setRole(user: AdminUser, event: Event) {
    const value = (event.target as HTMLSelectElement).value;
    router.patch(`/admin/users/${user.id}`, { role: value }, { preserveScroll: true });
}

function toggleActive(user: AdminUser) {
    router.patch(
        `/admin/users/${user.id}`,
        { is_active: !user.is_active },
        { preserveScroll: true },
    );
}

function deleteUser(user: AdminUser) {
    if (confirm(`Delete ${user.name}? This cannot be undone.`)) {
        router.delete(`/admin/users/${user.id}`, { preserveScroll: true });
    }
}

function formatDate(value: string): string {
    return new Date(value).toLocaleDateString(undefined, {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
}
</script>

<template>
    <Head title="Admin · Users" />

    <div class="flex h-full flex-1 flex-col gap-5 p-4 md:p-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Users</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                {{ users.total }} accounts across the platform. Change roles, suspend
                or remove accounts.
            </p>
        </div>

        <!-- filters -->
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative w-full max-w-xs">
                <Search
                    class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                />
                <Input
                    v-model="search"
                    type="search"
                    placeholder="Search name or email…"
                    class="pl-9"
                />
            </div>
            <select
                v-model="role"
                class="h-9 rounded-md border border-input bg-transparent px-3 text-sm shadow-xs"
            >
                <option value="">All roles</option>
                <option value="admin">Admins</option>
                <option value="owner">Owners</option>
                <option value="member">Members</option>
            </select>
        </div>

        <!-- table -->
        <div
            class="overflow-x-auto rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border"
        >
            <table class="w-full min-w-[760px] text-sm">
                <thead>
                    <tr
                        class="border-b border-sidebar-border/70 text-left text-xs text-muted-foreground uppercase dark:border-sidebar-border"
                    >
                        <th class="px-5 py-3.5 font-medium">User</th>
                        <th class="px-5 py-3.5 font-medium">Company</th>
                        <th class="px-5 py-3.5 font-medium">Role</th>
                        <th class="px-5 py-3.5 font-medium">Status</th>
                        <th class="px-5 py-3.5 font-medium">Joined</th>
                        <th class="px-5 py-3.5 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                    <tr v-for="user in users.data" :key="user.id">
                        <td class="px-5 py-3.5">
                            <p class="font-medium">{{ user.name }}</p>
                            <p class="text-xs text-muted-foreground">{{ user.email }}</p>
                        </td>
                        <td class="px-5 py-3.5 text-muted-foreground">
                            {{ user.company?.name ?? '—' }}
                        </td>
                        <td class="px-5 py-3.5">
                            <select
                                :value="user.role"
                                class="rounded-full border px-2.5 py-1 text-xs font-medium capitalize"
                                :class="roleBadge[user.role]"
                                @change="setRole(user, $event)"
                            >
                                <option value="admin">admin</option>
                                <option value="owner">owner</option>
                                <option value="member">member</option>
                            </select>
                        </td>
                        <td class="px-5 py-3.5">
                            <span
                                class="rounded-full px-2.5 py-0.5 text-xs font-medium"
                                :class="
                                    user.is_active
                                        ? 'bg-emerald-500/10 text-emerald-500'
                                        : 'bg-red-500/10 text-red-500'
                                "
                            >
                                {{ user.is_active ? 'Active' : 'Suspended' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-muted-foreground">
                            {{ formatDate(user.created_at) }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-1.5">
                                <button
                                    class="rounded-lg p-2 text-muted-foreground transition hover:bg-accent hover:text-foreground"
                                    :title="user.is_active ? 'Suspend' : 'Reactivate'"
                                    @click="toggleActive(user)"
                                >
                                    <ShieldOff v-if="user.is_active" class="size-4" />
                                    <ShieldCheck v-else class="size-4" />
                                </button>
                                <button
                                    class="rounded-lg p-2 text-muted-foreground transition hover:bg-red-500/10 hover:text-red-500"
                                    title="Delete"
                                    @click="deleteUser(user)"
                                >
                                    <Trash2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="users.data.length === 0">
                        <td colspan="6" class="px-5 py-10 text-center text-muted-foreground">
                            No users match your filters.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <div v-if="users.links.length > 3" class="flex flex-wrap justify-center gap-1.5">
            <button
                v-for="link in users.links"
                :key="link.label"
                :disabled="!link.url"
                class="rounded-lg px-3.5 py-2 text-sm transition"
                :class="
                    link.active
                        ? 'bg-blue-600 font-semibold text-white'
                        : link.url
                          ? 'border border-sidebar-border/70 hover:bg-accent dark:border-sidebar-border'
                          : 'text-muted-foreground/40'
                "
                @click="link.url && router.get(link.url, {}, { preserveState: true })"
                v-html="link.label"
            />
        </div>
    </div>
</template>
