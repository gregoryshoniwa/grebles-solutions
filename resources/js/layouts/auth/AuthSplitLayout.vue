<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Bot, MessageCircle, Phone, ShieldCheck, Zap } from '@lucide/vue';
import CircuitBoard from '@/components/CircuitBoard.vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();

const highlights = [
    { icon: MessageCircle, text: 'WhatsApp, voice & video — answered 24/7' },
    { icon: Zap, text: 'Live in 14 days' },
    { icon: ShieldCheck, text: 'COBIT-governed AI' },
    { icon: Phone, text: 'A human one escalation away' },
];
</script>

<template>
    <div
        class="dark relative grid h-dvh flex-col items-center justify-center bg-[#0b1220] px-6 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0"
    >
        <!-- ===== brand panel ===== -->
        <div
            class="relative hidden h-full flex-col overflow-hidden border-r border-white/5 bg-[#030712] p-10 text-white lg:flex"
        >
            <div class="pointer-events-none absolute inset-0">
                <div
                    class="absolute -top-32 -left-20 h-[420px] w-[520px] rounded-full bg-blue-600/25 blur-[140px]"
                />
                <div
                    class="absolute right-0 bottom-0 h-[280px] w-[280px] rounded-full bg-red-500/10 blur-[120px]"
                />
                <div
                    class="absolute inset-0 opacity-60 [mask-image:radial-gradient(ellipse_at_center,black_25%,transparent_80%)]"
                >
                    <CircuitBoard />
                </div>
            </div>

            <Link :href="home()" class="relative z-20 flex items-center">
                <img
                    src="/images/logo-dark.png"
                    alt="Grebles Solutions"
                    class="h-24 w-auto object-contain"
                />
            </Link>

            <div class="relative z-20 my-auto w-full max-w-md self-center">
                <!-- AI chat mockup -->
                <div
                    class="relative rounded-2xl border border-white/10 bg-white/[0.04] p-5 shadow-2xl backdrop-blur-sm"
                >
                    <div class="flex items-center gap-3 border-b border-white/5 pb-4">
                        <span
                            class="flex size-10 items-center justify-center rounded-full bg-blue-500/15 text-blue-400"
                        >
                            <Bot class="size-5" />
                        </span>
                        <div class="flex-1 leading-tight">
                            <p class="text-sm font-semibold">Grebles AI Employee</p>
                            <p class="flex items-center gap-1.5 text-xs text-slate-400">
                                <span
                                    class="size-1.5 animate-pulse rounded-full bg-emerald-400"
                                />
                                Online — every hour of every day
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3 pt-4 text-sm">
                        <div class="flex justify-end">
                            <p
                                class="max-w-[80%] rounded-2xl rounded-br-sm bg-blue-600 px-4 py-2.5 text-white"
                            >
                                Hi! Do you deliver to Bulawayo?
                            </p>
                        </div>
                        <div class="flex justify-start">
                            <p
                                class="max-w-[85%] rounded-2xl rounded-bl-sm border border-white/10 bg-white/[0.06] px-4 py-2.5 text-slate-200"
                            >
                                We do! Delivery to Bulawayo is $5 and arrives in 1–2
                                days. Want me to book your order?
                            </p>
                        </div>
                        <p class="pl-1 text-xs text-slate-500">
                            Replied in 4 seconds — no human needed
                        </p>
                        <div class="flex justify-start">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-2xl rounded-bl-sm border border-white/10 bg-white/[0.06] px-4 py-3"
                            >
                                <span class="typing-dot" style="animation-delay: 0s" />
                                <span class="typing-dot" style="animation-delay: 0.2s" />
                                <span class="typing-dot" style="animation-delay: 0.4s" />
                            </span>
                        </div>
                    </div>

                    <!-- floating voice chip -->
                    <div
                        class="absolute -right-6 -bottom-5 flex items-center gap-3 rounded-2xl border border-white/10 bg-[#0b1220]/95 px-4 py-2.5 shadow-2xl backdrop-blur-md"
                    >
                        <span
                            class="flex size-8 items-center justify-center rounded-full bg-emerald-500/15 text-emerald-400"
                        >
                            <Phone class="size-4" />
                        </span>
                        <span class="leading-tight">
                            <span class="block text-xs font-semibold text-white"
                                >Voice call answered</span
                            >
                            <span class="mt-1 flex h-3 items-end gap-[3px]">
                                <span
                                    v-for="i in 7"
                                    :key="i"
                                    class="wave-bar"
                                    :style="{ animationDelay: `${i * 0.12}s` }"
                                />
                            </span>
                        </span>
                    </div>
                </div>

                <h2 class="mt-12 text-2xl leading-snug font-bold tracking-tight">
                    Your business, answered
                    <span
                        class="bg-gradient-to-r from-blue-400 to-sky-400 bg-clip-text text-transparent"
                        >every hour of every day</span
                    ><span class="text-red-500">.</span>
                </h2>

                <ul class="mt-5 grid grid-cols-2 gap-3">
                    <li
                        v-for="item in highlights"
                        :key="item.text"
                        class="flex items-center gap-2.5 text-xs text-slate-300"
                    >
                        <span
                            class="flex size-7 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-blue-500/10 text-blue-400"
                        >
                            <component :is="item.icon" class="size-3.5" />
                        </span>
                        {{ item.text }}
                    </li>
                </ul>
            </div>

            <p class="relative z-20 text-xs text-slate-500">
                © {{ new Date().getFullYear() }} Grebles Solutions — Harare,
                Zimbabwe. Serving Southern Africa.
            </p>
        </div>

        <!-- ===== form panel ===== -->
        <div class="relative flex h-full items-center justify-center overflow-y-auto">
            <div class="pointer-events-none absolute inset-0">
                <div
                    class="absolute -top-24 right-0 h-72 w-72 rounded-full bg-blue-600/10 blur-[110px]"
                />
            </div>

            <div class="relative mx-auto w-full max-w-[420px] px-2 py-8 sm:px-0">
                <Link :href="home()" class="mb-6 flex justify-center lg:hidden">
                    <img
                        src="/images/icon.png"
                        alt="Grebles Solutions"
                        class="size-12 object-contain"
                    />
                </Link>

                <div
                    class="rounded-2xl border border-white/10 bg-white/[0.03] p-6 shadow-2xl backdrop-blur-sm sm:p-8"
                >
                    <div class="mb-6 flex flex-col space-y-1.5 text-center">
                        <h1
                            class="text-xl font-semibold tracking-tight text-white"
                            v-if="title"
                        >
                            {{ title }}
                        </h1>
                        <p class="text-sm text-muted-foreground" v-if="description">
                            {{ description }}
                        </p>
                    </div>
                    <slot />
                </div>

                <p class="mt-6 text-center text-xs text-slate-500">
                    Protected by COBIT-governed security practices.
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.typing-dot {
    width: 6px;
    height: 6px;
    border-radius: 9999px;
    background: rgb(148 163 184);
    animation: typingBounce 1.2s ease-in-out infinite;
}

@keyframes typingBounce {
    0%,
    60%,
    100% {
        transform: translateY(0);
        opacity: 0.4;
    }
    30% {
        transform: translateY(-4px);
        opacity: 1;
    }
}

.wave-bar {
    width: 3px;
    border-radius: 9999px;
    background: rgb(52 211 153);
    height: 4px;
    animation: waveBounce 1s ease-in-out infinite;
}

@keyframes waveBounce {
    0%,
    100% {
        height: 4px;
    }
    50% {
        height: 12px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .typing-dot,
    .wave-bar {
        animation: none;
    }
}
</style>
