<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    Bot,
    CalendarCheck,
    Check,
    Globe,
    Mail,
    Menu,
    MessageCircle,
    Phone,
    PiggyBank,
    ShieldCheck,
    Sparkles,
    Star,
    Timer,
    Video,
    Workflow,
    X,
    Zap,
} from '@lucide/vue';
import { useIntersectionObserver } from '@vueuse/core';
import { computed, onMounted, onUnmounted, ref } from 'vue';
import CircuitBoard from '@/components/CircuitBoard.vue';
import { dashboard, login, register } from '@/routes';

const mobileMenuOpen = ref(false);

// live activity simulation for the hero chips
const waSeconds = ref(12);
const voiceQueue = ref(3);
let activityTimer: ReturnType<typeof setInterval> | undefined;

onMounted(() => {
    activityTimer = setInterval(() => {
        waSeconds.value = waSeconds.value >= 18 ? 2 : waSeconds.value + 1;
        if (waSeconds.value % 6 === 0) {
            voiceQueue.value = 1 + ((voiceQueue.value + 1) % 4);
        }
    }, 1000);
});

onUnmounted(() => clearInterval(activityTimer));

// count-up animation for the stats band
const statsSection = ref<HTMLElement | null>(null);
const statCounts = ref({ openRate: 0, seconds: 0, saved: 0, days: 0 });
let statsStarted = false;

function animateStats() {
    const targets = { openRate: 98, seconds: 10, saved: 23, days: 14 };
    const duration = 1400;
    const start = performance.now();

    const tick = (now: number) => {
        const t = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - t, 3);
        statCounts.value = {
            openRate: Math.round(targets.openRate * eased),
            seconds: Math.round(targets.seconds * eased),
            saved: Math.round(targets.saved * eased),
            days: Math.round(targets.days * eased),
        };
        if (t < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
}

useIntersectionObserver(
    statsSection,
    ([entry]) => {
        if (entry?.isIntersecting && !statsStarted) {
            statsStarted = true;
            animateStats();
        }
    },
    { threshold: 0.35 },
);

const navLinks = [
    { label: 'Services', href: '#services' },
    { label: 'How it works', href: '#how-it-works' },
    { label: 'Pricing', href: '#pricing' },
    { label: 'Contact', href: '#contact' },
];

const services = [
    {
        icon: MessageCircle,
        title: 'AI Customer Agent',
        description:
            'A 24/7 agent on your WhatsApp, website and socials — grounded in your own Company Knowledge Base. It answers customers, qualifies leads and books appointments while you sleep.',
        accent: 'from-emerald-400/20 to-emerald-400/0',
    },
    {
        icon: Phone,
        title: 'AI Voice Receptionist',
        description:
            'Never miss a call again. A natural speech-to-speech receptionist answers your phone line, takes messages and books appointments — every call, every hour.',
        accent: 'from-blue-400/20 to-blue-400/0',
    },
    {
        icon: Video,
        title: 'AI Video Agent & Avatars',
        description:
            'A face-to-face AI employee on live video calls. It sees shared screens, guides customers through forms and products, and runs demos around the clock.',
        accent: 'from-violet-400/20 to-violet-400/0',
    },
    {
        icon: Workflow,
        title: 'Process Automation',
        description:
            'Quote follow-ups, invoices, payment reminders, document processing and CRM updates — automated end-to-end, with a visual dashboard of every workflow.',
        accent: 'from-amber-400/20 to-amber-400/0',
    },
    {
        icon: Globe,
        title: 'Websites & Apps',
        description:
            'Modern websites, e-commerce and custom systems with mobile money and regional payment integration — or a full website-as-a-service subscription from $50/month.',
        accent: 'from-sky-400/20 to-sky-400/0',
    },
    {
        icon: ShieldCheck,
        title: 'IT & AI Governance',
        description:
            'COBIT-based governance health-checks, AI adoption policy and compliance roadmaps — enterprise-grade governance, sized and priced for your business.',
        accent: 'from-rose-400/20 to-rose-400/0',
    },
];

const steps = [
    {
        number: '01',
        title: 'Discovery call',
        description:
            'A 30-minute call about your business: where you lose time, miss calls or drop sales. You talk, we map it.',
    },
    {
        number: '02',
        title: 'We build your AI employee',
        description:
            'We train your agent on your prices, services and policies, connect your channels and test it against real questions.',
    },
    {
        number: '03',
        title: 'You approve, we go live',
        description:
            'You test it yourself, we tune it together, and your AI employee starts working — typically within 14 days.',
    },
    {
        number: '04',
        title: 'It works. You watch it work.',
        description:
            'A monthly report shows every conversation handled, lead captured and hour saved — with a human always one escalation away.',
    },
];

const plans = [
    {
        name: 'Starter',
        price: '$80',
        period: '/month',
        setup: 'once-off setup from $300',
        description: 'A web chat agent for your website, trained on your business.',
        features: [
            'AI chat agent on your website',
            'Trained on your prices & FAQs',
            '500 conversations / month',
            'Lead capture & email alerts',
            'Monthly performance report',
        ],
        featured: false,
    },
    {
        name: 'Standard',
        price: '$150',
        period: '/month',
        setup: 'once-off setup from $500',
        description: 'Your AI employee on WhatsApp — where your customers already are.',
        features: [
            'Everything in Starter',
            'WhatsApp Business channel',
            '1,500 conversations / month',
            'Appointment booking',
            'Human handoff & escalation',
            'Knowledge base updates included',
        ],
        featured: true,
    },
    {
        name: 'Pro',
        price: '$250',
        period: '/month',
        setup: 'once-off setup from $800',
        description: 'Multi-channel AI workforce with voice and integrations.',
        features: [
            'Everything in Standard',
            'AI voice receptionist add-on',
            'Facebook & Instagram channels',
            '4,000 conversations / month',
            'CRM & calendar integrations',
            'Quarterly strategy review',
        ],
        featured: false,
    },
];

const heroChips = computed(() => [
    {
        icon: MessageCircle,
        title: 'WhatsApp',
        subtitle: `answered ${waSeconds.value}s ago`,
        position: 'top-4 -left-2 sm:top-8 sm:-left-6',
        delay: '0s',
        pingDelay: '0s',
    },
    {
        icon: Phone,
        title: 'Voice',
        subtitle: `${voiceQueue.value} ${voiceQueue.value === 1 ? 'call' : 'calls'} in queue`,
        position: 'top-1/3 -right-3 sm:-right-8',
        delay: '1.2s',
        pingDelay: '1.3s',
    },
    {
        icon: CalendarCheck,
        title: 'Booked',
        subtitle: 'Sunday 11:00',
        position: 'bottom-6 left-2 sm:bottom-10 sm:-left-2',
        delay: '2.4s',
        pingDelay: '2.6s',
    },
]);
</script>

<template>
    <Head title="AI Workforce for Southern African Business">
        <meta
            name="description"
            content="Grebles Solutions deploys AI employees that answer your WhatsApp, phone and video calls 24/7 — plus process automation, websites and COBIT-based IT governance."
        />
    </Head>

    <div class="min-h-screen bg-[#030712] text-slate-100 antialiased">
        <!-- ====== NAV ====== -->
        <header
            class="fixed inset-x-0 top-0 z-50 border-b border-white/5 bg-[#030712]/80 backdrop-blur-xl"
        >
            <nav
                class="mx-auto flex h-28 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8"
            >
                <a href="#" class="flex items-center">
                    <img
                        src="/images/logo-dark.png"
                        alt="Grebles Solutions"
                        class="h-24 w-auto object-contain"
                    />
                </a>

                <div class="hidden items-center gap-8 md:flex">
                    <a
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="text-sm text-slate-300 transition hover:text-white"
                    >
                        {{ link.label }}
                    </a>
                </div>

                <div class="hidden items-center gap-3 md:flex">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-500"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="px-3 py-2 text-sm text-slate-300 transition hover:text-white"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="register()"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-600/25 transition hover:bg-blue-500"
                        >
                            Get started
                        </Link>
                    </template>
                </div>

                <button
                    class="-mr-1 rounded-lg p-2 text-slate-300 hover:bg-white/5 md:hidden"
                    aria-label="Toggle menu"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <X v-if="mobileMenuOpen" class="size-6" />
                    <Menu v-else class="size-6" />
                </button>
            </nav>

            <!-- mobile menu -->
            <div
                v-if="mobileMenuOpen"
                class="border-t border-white/5 bg-[#030712] px-4 pt-2 pb-4 md:hidden"
            >
                <a
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="block rounded-lg px-3 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.label }}
                </a>
                <div class="mt-3 flex gap-3 border-t border-white/5 pt-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="flex-1 rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-medium text-white"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="flex-1 rounded-lg border border-white/10 px-4 py-2.5 text-center text-sm text-slate-200"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="register()"
                            class="flex-1 rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-medium text-white"
                        >
                            Get started
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <!-- ====== HERO ====== -->
        <section class="relative overflow-hidden pt-28">
            <!-- background effects -->
            <div class="pointer-events-none absolute inset-0">
                <div
                    class="absolute -top-40 left-1/2 h-[600px] w-[900px] -translate-x-1/2 rounded-full bg-blue-600/20 blur-[160px]"
                />
                <div
                    class="absolute top-1/2 right-0 h-[400px] w-[400px] rounded-full bg-red-500/10 blur-[140px]"
                />
                <div
                    class="absolute inset-0 bg-[linear-gradient(to_right,rgba(148,163,184,0.04)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.04)_1px,transparent_1px)] bg-[size:72px_72px]"
                />
                <div
                    class="absolute inset-0 [mask-image:radial-gradient(ellipse_at_center,black_30%,transparent_75%)]"
                >
                    <CircuitBoard />
                </div>
            </div>

            <div
                class="relative mx-auto grid max-w-7xl gap-14 px-4 pt-16 pb-20 sm:px-6 lg:grid-cols-2 lg:items-center lg:gap-8 lg:px-8 lg:pt-24 lg:pb-28"
            >
                <!-- copy -->
                <div>
                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3.5 py-1.5 text-xs font-medium text-blue-300"
                    >
                        <Sparkles class="size-3.5" />
                        AI-run. Human-backed. Built in Southern Africa.
                    </div>

                    <h1
                        class="text-4xl leading-[1.08] font-bold tracking-tight text-white sm:text-5xl lg:text-6xl"
                    >
                        An
                        <span
                            class="bg-gradient-to-r from-blue-400 via-sky-400 to-blue-500 bg-clip-text text-transparent"
                            >AI workforce</span
                        >
                        for every Southern African business<span class="text-red-500">.</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-400">
                        Grebles deploys AI employees that answer your WhatsApp, your
                        phone and your video calls 24/7 — grounded in your business,
                        governed by COBIT, and integrated with the tools you already
                        use.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <Link
                            :href="register()"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-blue-600/30 transition hover:bg-blue-500"
                        >
                            <Bot class="size-5" />
                            Deploy your AI Employee
                            <ArrowRight
                                class="size-4 transition-transform group-hover:translate-x-0.5"
                            />
                        </Link>
                        <a
                            href="#how-it-works"
                            class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3.5 text-base font-medium text-slate-200 transition hover:bg-white/10"
                        >
                            See how it works
                        </a>
                    </div>

                    <div
                        class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-slate-400"
                    >
                        <span class="inline-flex items-center gap-2">
                            <Star class="size-4 fill-amber-400 text-amber-400" />
                            Pilot programme open
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <ShieldCheck class="size-4 text-blue-400" />
                            COBIT-governed
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <Zap class="size-4 text-amber-400" />
                            Deploy in 14 days
                        </span>
                    </div>
                </div>

                <!-- visual -->
                <div class="relative mx-auto w-full max-w-md lg:max-w-lg">
                    <div
                        class="relative rounded-3xl border border-white/10 bg-gradient-to-b from-white/[0.07] to-white/[0.02] p-8 backdrop-blur-sm sm:p-12"
                    >
                        <!-- breathing glow behind logo -->
                        <div
                            class="hero-glow absolute inset-0 m-auto h-64 w-64 rounded-full bg-blue-500/25 blur-[90px]"
                        />

                        <!-- orbiting rings -->
                        <div
                            class="orbit pointer-events-none absolute inset-0 m-auto size-72 sm:size-88"
                            style="animation-duration: 22s"
                        >
                            <span
                                class="absolute inset-0 rounded-full border border-blue-400/15"
                            />
                            <span
                                class="absolute top-0 left-1/2 size-2.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-400 shadow-[0_0_12px_rgba(56,189,248,0.9)]"
                            />
                        </div>
                        <div
                            class="orbit orbit-reverse pointer-events-none absolute inset-0 m-auto size-84 sm:size-104"
                            style="animation-duration: 34s"
                        >
                            <span
                                class="absolute inset-0 rounded-full border border-dashed border-blue-400/10"
                            />
                            <span
                                class="absolute top-1/2 left-0 size-2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-red-400 shadow-[0_0_10px_rgba(248,113,113,0.9)]"
                            />
                        </div>

                        <!-- drifting particles -->
                        <span
                            v-for="(p, i) in 6"
                            :key="`particle-${i}`"
                            class="particle pointer-events-none absolute size-1 rounded-full bg-sky-300/70"
                            :style="{
                                left: `${12 + i * 15}%`,
                                animationDelay: `${i * 1.8}s`,
                                animationDuration: `${7 + (i % 3) * 2}s`,
                            }"
                        />

                        <img
                            src="/images/icon.png"
                            alt=""
                            class="hero-g relative mx-auto w-56 sm:w-72"
                        />

                        <!-- floating chips -->
                        <div
                            v-for="chip in heroChips"
                            :key="chip.title"
                            class="absolute flex animate-[heroFloat_6s_ease-in-out_infinite] items-center gap-3 rounded-2xl border border-white/10 bg-[#0b1220]/90 px-4 py-2.5 shadow-2xl backdrop-blur-md"
                            :class="chip.position"
                            :style="{ animationDelay: chip.delay }"
                        >
                            <span class="relative flex size-9">
                                <span
                                    class="chip-ping absolute inset-0 rounded-full bg-blue-400/40"
                                    :style="{ animationDelay: chip.pingDelay }"
                                />
                                <span
                                    class="relative flex size-9 items-center justify-center rounded-full bg-blue-500/15 text-blue-400"
                                >
                                    <component :is="chip.icon" class="size-4.5" />
                                </span>
                            </span>
                            <span class="leading-tight">
                                <span class="block text-sm font-semibold text-white">{{
                                    chip.title
                                }}</span>
                                <span class="block text-xs text-slate-400">{{
                                    chip.subtitle
                                }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====== STATS BAND ====== -->
        <section
            ref="statsSection"
            class="relative border-y border-white/5 bg-white/[0.02]"
        >
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <p
                    class="text-center text-sm font-semibold tracking-widest text-blue-400 uppercase"
                >
                    Why businesses are switching to AI employees
                </p>

                <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- WhatsApp open rate -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition duration-300 hover:border-emerald-400/30"
                    >
                        <div
                            class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-emerald-400/60 to-transparent"
                        />
                        <span
                            class="flex size-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400"
                        >
                            <MessageCircle class="size-5.5" />
                        </span>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">
                            {{ statCounts.openRate }}<span class="text-emerald-400">%</span>
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-200">
                            of WhatsApp messages get read
                        </p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Email manages just 20%. Your AI employee lives where your
                            customers actually look.
                        </p>
                    </div>

                    <!-- response time -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition duration-300 hover:border-blue-400/30"
                    >
                        <div
                            class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-blue-400/60 to-transparent"
                        />
                        <span
                            class="flex size-11 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400"
                        >
                            <Timer class="size-5.5" />
                        </span>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">
                            &lt;{{ statCounts.seconds
                            }}<span class="text-blue-400">s</span>
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-200">
                            to answer — any hour, any day
                        </p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Most businesses take hours to reply. 78% of customers buy
                            from whoever responds first.
                        </p>
                    </div>

                    <!-- savings -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition duration-300 hover:border-amber-400/30"
                    >
                        <div
                            class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-amber-400/60 to-transparent"
                        />
                        <span
                            class="flex size-11 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400"
                        >
                            <PiggyBank class="size-5.5" />
                        </span>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">
                            <span class="text-amber-400">$</span>{{ statCounts.saved
                            }}k<span class="text-amber-400">+</span>
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-200">
                            saved per year on reception
                        </p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            An AI receptionist costs a fraction of a salary — and never
                            takes leave, gets sick or resigns.
                        </p>
                    </div>

                    <!-- go-live -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition duration-300 hover:border-red-400/30"
                    >
                        <div
                            class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-red-400/60 to-transparent"
                        />
                        <span
                            class="flex size-11 items-center justify-center rounded-xl bg-red-500/10 text-red-400"
                        >
                            <Zap class="size-5.5" />
                        </span>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">
                            {{ statCounts.days }}
                            <span class="text-2xl text-red-400">days</span>
                        </p>
                        <p class="mt-1 text-sm font-medium text-slate-200">
                            from first call to go-live
                        </p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-500">
                            Discovery call, training on your business, testing,
                            launch — your AI employee working in two weeks.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====== SERVICES ====== -->
        <section id="services" class="scroll-mt-20 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold tracking-widest text-blue-400 uppercase">
                        What we do
                    </p>
                    <h2
                        class="mt-3 text-3xl font-bold tracking-tight text-white sm:text-4xl"
                    >
                        One partner. A full AI-powered IT department.
                    </h2>
                    <p class="mt-4 text-lg text-slate-400">
                        From your first website to a fully AI-run operation — every
                        service is something we use to run Grebles itself.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="service in services"
                        :key="service.title"
                        class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-7 transition duration-300 hover:border-blue-400/30 hover:bg-white/[0.05]"
                    >
                        <div
                            class="pointer-events-none absolute inset-0 bg-gradient-to-br opacity-0 transition duration-300 group-hover:opacity-100"
                            :class="service.accent"
                        />
                        <div
                            class="relative flex size-12 items-center justify-center rounded-xl border border-white/10 bg-blue-500/10 text-blue-400"
                        >
                            <component :is="service.icon" class="size-6" />
                        </div>
                        <h3 class="relative mt-5 text-lg font-semibold text-white">
                            {{ service.title }}
                        </h3>
                        <p class="relative mt-2.5 text-sm leading-relaxed text-slate-400">
                            {{ service.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====== HOW IT WORKS ====== -->
        <section
            id="how-it-works"
            class="scroll-mt-20 border-y border-white/5 bg-white/[0.02] py-20 lg:py-28"
        >
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold tracking-widest text-blue-400 uppercase">
                        How it works
                    </p>
                    <h2
                        class="mt-3 text-3xl font-bold tracking-tight text-white sm:text-4xl"
                    >
                        From first call to working AI employee in 14 days.
                    </h2>
                </div>

                <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        v-for="(step, i) in steps"
                        :key="step.number"
                        class="relative"
                    >
                        <div
                            v-if="i < steps.length - 1"
                            class="absolute top-6 left-14 hidden h-px w-[calc(100%-3rem)] bg-gradient-to-r from-blue-500/40 to-transparent lg:block"
                        />
                        <div
                            class="relative flex size-12 items-center justify-center rounded-xl border border-blue-400/30 bg-blue-500/10 text-sm font-bold text-blue-300"
                        >
                            {{ step.number }}
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-white">
                            {{ step.title }}
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-400">
                            {{ step.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====== PRICING ====== -->
        <section id="pricing" class="scroll-mt-20 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold tracking-widest text-blue-400 uppercase">
                        Pricing
                    </p>
                    <h2
                        class="mt-3 text-3xl font-bold tracking-tight text-white sm:text-4xl"
                    >
                        Less than a salary. Working every hour.
                    </h2>
                    <p class="mt-4 text-lg text-slate-400">
                        Zimbabwe pricing shown — regional plans for South Africa and
                        Botswana available. Custom automation, websites and governance
                        quoted per project.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 lg:grid-cols-3">
                    <div
                        v-for="plan in plans"
                        :key="plan.name"
                        class="relative flex flex-col rounded-2xl border p-8"
                        :class="
                            plan.featured
                                ? 'border-blue-500/50 bg-gradient-to-b from-blue-600/15 to-white/[0.03] shadow-2xl shadow-blue-600/10'
                                : 'border-white/10 bg-white/[0.03]'
                        "
                    >
                        <div
                            v-if="plan.featured"
                            class="absolute -top-3.5 left-1/2 -translate-x-1/2 rounded-full bg-blue-600 px-4 py-1 text-xs font-semibold text-white"
                        >
                            Most popular
                        </div>
                        <h3 class="text-lg font-semibold text-white">{{ plan.name }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ plan.description }}</p>
                        <p class="mt-6">
                            <span class="text-4xl font-bold text-white">{{
                                plan.price
                            }}</span>
                            <span class="text-slate-400">{{ plan.period }}</span>
                        </p>
                        <p class="mt-1 text-xs text-slate-500">{{ plan.setup }}</p>
                        <ul class="mt-7 flex-1 space-y-3">
                            <li
                                v-for="feature in plan.features"
                                :key="feature"
                                class="flex items-start gap-3 text-sm text-slate-300"
                            >
                                <Check class="mt-0.5 size-4 shrink-0 text-blue-400" />
                                {{ feature }}
                            </li>
                        </ul>
                        <Link
                            :href="register()"
                            class="mt-8 rounded-xl px-5 py-3 text-center text-sm font-semibold transition"
                            :class="
                                plan.featured
                                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25 hover:bg-blue-500'
                                    : 'border border-white/10 bg-white/5 text-slate-200 hover:bg-white/10'
                            "
                        >
                            Get started
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====== CTA BANNER ====== -->
        <section class="px-4 sm:px-6 lg:px-8">
            <div
                class="relative mx-auto max-w-7xl overflow-hidden rounded-3xl border border-blue-400/20 bg-gradient-to-br from-blue-600/20 via-[#0b1220] to-[#0b1220] px-6 py-16 text-center sm:px-16"
            >
                <div
                    class="pointer-events-none absolute -top-24 left-1/2 h-72 w-[600px] -translate-x-1/2 rounded-full bg-blue-500/20 blur-[120px]"
                />
                <div
                    class="pointer-events-none absolute inset-0 opacity-60 [mask-image:linear-gradient(to_bottom,black,transparent_85%)]"
                >
                    <CircuitBoard />
                </div>
                <h2
                    class="relative text-3xl font-bold tracking-tight text-white sm:text-4xl"
                >
                    Experience it before you buy it.
                </h2>
                <p class="relative mx-auto mt-4 max-w-xl text-lg text-slate-400">
                    Every enquiry to Grebles is answered by the same AI employees we
                    sell. Message us and see how fast — and how human — it feels.
                </p>
                <div
                    class="relative mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row"
                >
                    <a
                        href="#contact"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-xl shadow-blue-600/30 transition hover:bg-blue-500"
                    >
                        <MessageCircle class="size-5" />
                        Talk to our AI right now
                    </a>
                    <Link
                        :href="register()"
                        class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-6 py-3.5 text-base font-medium text-slate-200 transition hover:bg-white/10"
                    >
                        Create your account
                        <ArrowRight class="size-4" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- ====== CONTACT ====== -->
        <section id="contact" class="scroll-mt-20 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold tracking-widest text-blue-400 uppercase">
                        Contact
                    </p>
                    <h2
                        class="mt-3 text-3xl font-bold tracking-tight text-white sm:text-4xl"
                    >
                        Start with a free discovery call.
                    </h2>
                    <p class="mt-4 text-lg text-slate-400">
                        Tell us where your business loses time. We'll show you exactly
                        what an AI employee would do about it — no obligation.
                    </p>
                </div>

                <div class="mx-auto mt-12 grid max-w-4xl gap-6 sm:grid-cols-3">
                    <a
                        href="https://wa.me/263000000000?text=Hi%20Grebles%2C%20I%27d%20like%20a%20discovery%20call"
                        target="_blank"
                        rel="noopener"
                        class="group rounded-2xl border border-white/10 bg-white/[0.03] p-7 text-center transition hover:border-emerald-400/40 hover:bg-white/[0.05]"
                    >
                        <span
                            class="mx-auto flex size-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400"
                        >
                            <MessageCircle class="size-6" />
                        </span>
                        <h3 class="mt-4 font-semibold text-white">WhatsApp us</h3>
                        <p class="mt-1.5 text-sm text-slate-400">
                            Our AI agent replies in seconds, any hour.
                        </p>
                    </a>
                    <a
                        href="mailto:hello@grebles.co.zw"
                        class="group rounded-2xl border border-white/10 bg-white/[0.03] p-7 text-center transition hover:border-blue-400/40 hover:bg-white/[0.05]"
                    >
                        <span
                            class="mx-auto flex size-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400"
                        >
                            <Mail class="size-6" />
                        </span>
                        <h3 class="mt-4 font-semibold text-white">Email us</h3>
                        <p class="mt-1.5 text-sm text-slate-400">
                            hello@grebles.co.zw — answered same day.
                        </p>
                    </a>
                    <a
                        href="tel:+263000000000"
                        class="group rounded-2xl border border-white/10 bg-white/[0.03] p-7 text-center transition hover:border-violet-400/40 hover:bg-white/[0.05]"
                    >
                        <span
                            class="mx-auto flex size-12 items-center justify-center rounded-xl bg-violet-500/10 text-violet-400"
                        >
                            <Phone class="size-6" />
                        </span>
                        <h3 class="mt-4 font-semibold text-white">Call us</h3>
                        <p class="mt-1.5 text-sm text-slate-400">
                            Our AI receptionist will book you in.
                        </p>
                    </a>
                </div>
            </div>
        </section>

        <!-- ====== FOOTER ====== -->
        <footer class="border-t border-white/5 bg-white/[0.02]">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col items-center justify-between gap-8 md:flex-row md:items-start"
                >
                    <div class="max-w-xs text-center md:text-left">
                        <img
                            src="/images/logo-dark.png"
                            alt="Grebles Solutions"
                            class="mx-auto h-12 w-auto object-contain md:mx-0"
                        />
                        <p class="mt-4 text-sm leading-relaxed text-slate-400">
                            An AI-first IT solutions company. Process automation, AI
                            engineering, web development and IT governance for Southern
                            Africa.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-12 text-sm sm:grid-cols-3">
                        <div>
                            <p class="font-semibold text-white">Company</p>
                            <ul class="mt-3 space-y-2 text-slate-400">
                                <li>
                                    <a href="#services" class="hover:text-white">Services</a>
                                </li>
                                <li>
                                    <a href="#pricing" class="hover:text-white">Pricing</a>
                                </li>
                                <li>
                                    <a href="#contact" class="hover:text-white">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-white">Services</p>
                            <ul class="mt-3 space-y-2 text-slate-400">
                                <li>AI Employees</li>
                                <li>Process Automation</li>
                                <li>Websites &amp; Apps</li>
                                <li>IT Governance</li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-semibold text-white">Account</p>
                            <ul class="mt-3 space-y-2 text-slate-400">
                                <li>
                                    <Link :href="login()" class="hover:text-white"
                                        >Log in</Link
                                    >
                                </li>
                                <li>
                                    <Link :href="register()" class="hover:text-white"
                                        >Sign up</Link
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-10 flex flex-col items-center justify-between gap-3 border-t border-white/5 pt-7 text-xs text-slate-500 sm:flex-row"
                >
                    <p>
                        © {{ new Date().getFullYear() }} Grebles Solutions. All rights
                        reserved.
                    </p>
                    <p>Harare, Zimbabwe — serving Southern Africa.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
@keyframes heroFloat {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* glass G: float + breathing glow */
.hero-g {
    animation:
        heroFloat 7s ease-in-out infinite,
        glowPulse 4.5s ease-in-out infinite;
}

@keyframes glowPulse {
    0%,
    100% {
        filter: drop-shadow(0 0 35px rgba(59, 130, 246, 0.35));
    }
    50% {
        filter: drop-shadow(0 0 65px rgba(59, 130, 246, 0.65))
            drop-shadow(0 0 18px rgba(248, 113, 113, 0.25));
    }
}

/* background glow breathes with the G */
.hero-glow {
    animation: glowBreathe 4.5s ease-in-out infinite;
}

@keyframes glowBreathe {
    0%,
    100% {
        opacity: 0.7;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.15);
    }
}

/* orbiting rings with glowing satellites */
.orbit {
    animation: orbitSpin linear infinite;
}

.orbit-reverse {
    animation-direction: reverse;
}

@keyframes orbitSpin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* icon ping rings on the chips */
.chip-ping {
    animation: chipPing 3.6s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes chipPing {
    0%,
    60% {
        transform: scale(1);
        opacity: 0;
    }
    65% {
        opacity: 0.7;
    }
    90%,
    100% {
        transform: scale(1.9);
        opacity: 0;
    }
}

/* particles drifting up through the card */
.particle {
    bottom: 8%;
    animation: particleRise ease-in infinite;
}

@keyframes particleRise {
    0% {
        transform: translateY(0);
        opacity: 0;
    }
    15% {
        opacity: 0.9;
    }
    80% {
        opacity: 0.3;
    }
    100% {
        transform: translateY(-340px);
        opacity: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    .hero-g,
    .hero-glow,
    .orbit,
    .chip-ping,
    .particle {
        animation: none;
    }
    .particle,
    .chip-ping {
        opacity: 0;
    }
}
</style>
