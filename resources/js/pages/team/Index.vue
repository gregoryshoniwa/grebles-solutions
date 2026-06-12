<script setup lang="ts">
import { Form, Head, router, usePage } from '@inertiajs/vue3';
import { Crown, Trash2, UserPlus, Users } from '@lucide/vue';
import { computed } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Team', href: '/team' }],
    },
});

type Member = {
    id: number;
    name: string;
    email: string;
    role: string;
    is_active: boolean;
    created_at: string;
};

const props = defineProps<{
    company: { id: number; name: string };
    members: Member[];
}>();

const page = usePage();
const currentUserId = computed(
    () => (page.props.auth as { user?: { id?: number } })?.user?.id,
);

function removeMember(member: Member) {
    if (confirm(`Remove ${member.name} from your team?`)) {
        router.delete(`/team/${member.id}`, { preserveScroll: true });
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
    <Head title="Team" />

    <div class="flex h-full flex-1 flex-col gap-6 p-4 md:p-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">{{ company.name }} — Team</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Add assisting users who can work in your company account. You stay the
                owner.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
            <!-- members list -->
            <div
                class="self-start rounded-2xl border border-sidebar-border/70 dark:border-sidebar-border"
            >
                <div
                    class="flex items-center gap-2.5 border-b border-sidebar-border/70 px-6 py-4 dark:border-sidebar-border"
                >
                    <Users class="size-4.5 text-blue-500" />
                    <h2 class="font-semibold">
                        Members
                        <span class="ml-1 text-sm font-normal text-muted-foreground">
                            {{ members.length }}
                        </span>
                    </h2>
                </div>
                <div class="divide-y divide-sidebar-border/70 dark:divide-sidebar-border">
                    <div
                        v-for="member in members"
                        :key="member.id"
                        class="flex items-center gap-3 px-6 py-4"
                    >
                        <span
                            class="flex size-10 shrink-0 items-center justify-center rounded-full bg-blue-500/10 text-sm font-semibold text-blue-500"
                        >
                            {{ member.name.charAt(0).toUpperCase() }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="flex items-center gap-1.5 truncate font-medium">
                                {{ member.name }}
                                <Crown
                                    v-if="member.role === 'owner'"
                                    class="size-3.5 text-amber-500"
                                />
                                <span
                                    v-if="member.id === currentUserId"
                                    class="text-xs text-muted-foreground"
                                    >(you)</span
                                >
                            </p>
                            <p class="truncate text-sm text-muted-foreground">
                                {{ member.email }}
                            </p>
                        </div>
                        <span class="hidden text-xs text-muted-foreground sm:block">
                            Added {{ formatDate(member.created_at) }}
                        </span>
                        <button
                            v-if="member.role !== 'owner'"
                            class="rounded-lg p-2 text-muted-foreground transition hover:bg-red-500/10 hover:text-red-500"
                            title="Remove from team"
                            @click="removeMember(member)"
                        >
                            <Trash2 class="size-4" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- add member form -->
            <div
                class="self-start rounded-2xl border border-sidebar-border/70 p-6 dark:border-sidebar-border"
            >
                <div class="flex items-center gap-2.5">
                    <UserPlus class="size-4.5 text-blue-500" />
                    <h2 class="font-semibold">Add a team member</h2>
                </div>
                <p class="mt-1.5 text-sm text-muted-foreground">
                    They'll be able to sign in and help manage your account.
                </p>

                <Form
                    method="post"
                    action="/team"
                    :reset-on-success="['name', 'email', 'password']"
                    v-slot="{ errors, processing }"
                    class="mt-5 grid gap-4"
                >
                    <div class="grid gap-2">
                        <Label for="member-name">Name</Label>
                        <Input
                            id="member-name"
                            name="name"
                            required
                            placeholder="Full name"
                        />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="member-email">Email address</Label>
                        <Input
                            id="member-email"
                            name="email"
                            type="email"
                            required
                            placeholder="email@example.com"
                        />
                        <InputError :message="errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="member-password">Temporary password</Label>
                        <PasswordInput
                            id="member-password"
                            name="password"
                            required
                            placeholder="They can change it later"
                        />
                        <InputError :message="errors.password" />
                    </div>
                    <Button type="submit" class="mt-1" :disabled="processing">
                        <Spinner v-if="processing" />
                        Add member
                    </Button>
                </Form>
            </div>
        </div>
    </div>
</template>
