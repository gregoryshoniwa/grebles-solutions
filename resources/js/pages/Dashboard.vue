<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import {
    ArrowRight,
    Bot,
    CalendarCheck,
    CircleCheck,
    MessageCircle,
    Phone,
    Sparkles,
    TrendingUp,
    Workflow,
} from '@lucide/vue';
import { computed } from 'vue';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const page = usePage();
const userName = computed(() => {
    const name = (page.props.auth as { user?: { name?: string } })?.user?.name ?? '';
    return name.split(' ')[0];
});

const stats = [
    {
        icon: MessageCircle,
        label: 'Conversations handled',
        value: '—',
        hint: 'Across WhatsApp, web & socials',
    },
    {
        icon: Phone,
        label: 'Calls answered',
        value: '—',
        hint: 'Voice receptionist minutes',
    },
    {
        icon: CalendarCheck,
        label: 'Appointments booked',
        value: '—',
        hint: 'Booked by your AI employees',
    },
    {
        icon: Workflow,
        label: 'Automations run',
        value: '—',
        hint: 'Workflow executions this month',
    },
];

const setupSteps = [
    {
        title: 'Tell us about your business',
        description:
            'Complete your business profile so your AI employee knows who it works for.',
        done: false,
    },
    {
        title: 'Build your Company Knowledge Base',
        description:
            'Upload your price lists, FAQs and policies — the knowledge your agent will answer from.',
        done: false,
    },
    {
        title: 'Choose your channels',
        description:
            'Web chat, WhatsApp, voice or video — pick where your AI employee should work.',
        done: false,
    },
    {
        title: 'Test and go live',
        description:
            'Ask it your hardest customer questions, then launch it to the world.',
        done: false,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4 md:p-6">
        <!-- welcome -->
        <div
            class="relative overflow-hidden rounded-2xl border border-sidebar-border/70 bg-gradient-to-br from-blue-600/15 via-transparent to-transparent p-6 md:p-8 dark:border-sidebar-border"
        >
            <div
                class="pointer-events-none absolute -top-20 right-0 h-56 w-56 rounded-full bg-blue-500/15 blur-[90px]"
            />
            <div class="relative flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p
                        class="inline-flex items-center gap-1.5 text-xs font-semibold tracking-widest text-blue-500 uppercase"
                    >
                        <Sparkles class="size-3.5" /> Grebles AI Workforce
                    </p>
                    <h1 class="mt-2 text-2xl font-bold tracking-tight md:text-3xl">
                        Welcome{{ userName ? `, ${userName}` : '' }}.
                    </h1>
                    <p class="mt-2 max-w-xl text-sm text-muted-foreground">
                        This is your command centre. Once your first AI employee is
                        deployed, you'll see every conversation, call and booking it
                        handles — live, right here.
                    </p>
                </div>
                <a
                    href="#setup"
                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition hover:bg-blue-500"
                >
                    <Bot class="size-4.5" />
                    Deploy your first AI employee
                    <ArrowRight class="size-4" />
                </a>
            </div>
        </div>

        <!-- stats -->
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div
                v-for="stat in stats"
                :key="stat.label"
                class="rounded-2xl border border-sidebar-border/70 p-5 dark:border-sidebar-border"
            >
                <div class="flex items-center justify-between">
                    <span
                        class="flex size-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-500"
                    >
                        <component :is="stat.icon" class="size-5" />
                    </span>
                    <TrendingUp class="size-4 text-muted-foreground/50" />
                </div>
                <p class="mt-4 text-3xl font-bold tracking-tight">{{ stat.value }}</p>
                <p class="mt-1 text-sm font-medium">{{ stat.label }}</p>
                <p class="mt-0.5 text-xs text-muted-foreground">{{ stat.hint }}</p>
            </div>
        </div>

        <!-- setup checklist -->
        <div
            id="setup"
            class="rounded-2xl border border-sidebar-border/70 p-6 dark:border-sidebar-border"
        >
            <div class="flex flex-wrap items-center justify-between gap-2">
                <div>
                    <h2 class="text-lg font-semibold">Get your AI employee working</h2>
                    <p class="mt-1 text-sm text-muted-foreground">
                        Four steps from signup to a working AI workforce.
                    </p>
                </div>
                <span
                    class="rounded-full border border-blue-500/30 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500"
                >
                    0 of {{ setupSteps.length }} complete
                </span>
            </div>
            <ol class="mt-6 grid gap-4 md:grid-cols-2">
                <li
                    v-for="(step, i) in setupSteps"
                    :key="step.title"
                    class="flex gap-4 rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
                >
                    <span
                        class="flex size-8 shrink-0 items-center justify-center rounded-full border text-sm font-semibold"
                        :class="
                            step.done
                                ? 'border-blue-500 bg-blue-500 text-white'
                                : 'border-sidebar-border text-muted-foreground'
                        "
                    >
                        <CircleCheck v-if="step.done" class="size-4.5" />
                        <template v-else>{{ i + 1 }}</template>
                    </span>
                    <div>
                        <p class="font-medium">{{ step.title }}</p>
                        <p class="mt-1 text-sm text-muted-foreground">
                            {{ step.description }}
                        </p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</template>
