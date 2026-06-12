<script setup lang="ts">
type Trace = {
    d: string;
    duration: string;
    delay: string;
    color?: string;
};

// Orthogonal circuit traces with 45° bends, drawn on a 1200x800 grid.
const traces: Trace[] = [
    { d: 'M 0 120 H 260 L 320 180 H 540 L 600 240 H 820', duration: '6s', delay: '0s' },
    { d: 'M 1200 90 H 980 L 920 150 H 700 L 640 210 V 380', duration: '7s', delay: '1.4s' },
    { d: 'M 0 420 H 180 L 240 360 H 430 V 200 L 490 140 H 640', duration: '8s', delay: '0.8s' },
    { d: 'M 1200 480 H 1000 L 940 420 H 760 V 560 L 700 620 H 480', duration: '7.5s', delay: '2.2s', color: '#f87171' },
    { d: 'M 0 660 H 220 L 280 600 H 520 L 580 660 H 800 V 520', duration: '9s', delay: '0.4s' },
    { d: 'M 1200 700 H 920 L 860 640 V 460 L 800 400 H 660', duration: '6.5s', delay: '3s' },
    { d: 'M 100 800 V 620 L 160 560 H 360 V 420 L 420 360', duration: '8.5s', delay: '1.8s' },
    { d: 'M 1100 0 V 160 L 1040 220 V 400 L 980 460 H 840', duration: '7s', delay: '2.6s', color: '#f87171' },
    { d: 'M 540 800 V 700 L 600 640 V 480 L 660 420 H 760', duration: '6s', delay: '4s' },
    { d: 'M 0 260 H 140 L 200 320 H 350 V 480 L 410 540 H 560', duration: '9.5s', delay: '3.4s' },
];

// Solder pads / nodes at trace endpoints and junctions.
const nodes = [
    { x: 820, y: 240 }, { x: 640, y: 380 }, { x: 640, y: 140 },
    { x: 480, y: 620 }, { x: 800, y: 520 }, { x: 660, y: 400 },
    { x: 420, y: 360 }, { x: 840, y: 460 }, { x: 760, y: 420 },
    { x: 560, y: 540 }, { x: 260, y: 120 }, { x: 940, y: 420 },
];
</script>

<template>
    <svg
        class="h-full w-full"
        viewBox="0 0 1200 800"
        fill="none"
        preserveAspectRatio="xMidYMid slice"
        aria-hidden="true"
    >
        <!-- static copper traces -->
        <path
            v-for="(trace, i) in traces"
            :key="`t-${i}`"
            :d="trace.d"
            stroke="rgba(59,130,246,0.13)"
            stroke-width="1.5"
        />

        <!-- electric pulses travelling along the traces -->
        <path
            v-for="(trace, i) in traces"
            :key="`p-${i}`"
            :d="trace.d"
            class="circuit-pulse"
            :stroke="trace.color ?? '#38bdf8'"
            stroke-width="2"
            stroke-linecap="round"
            :style="{
                animationDuration: trace.duration,
                animationDelay: trace.delay,
            }"
        />

        <!-- solder pads -->
        <g v-for="(node, i) in nodes" :key="`n-${i}`">
            <circle
                :cx="node.x"
                :cy="node.y"
                r="5"
                fill="#030712"
                stroke="rgba(59,130,246,0.35)"
                stroke-width="1.5"
            />
            <circle
                :cx="node.x"
                :cy="node.y"
                r="2"
                fill="#38bdf8"
                class="circuit-node"
                :style="{ animationDelay: `${(i * 0.7) % 4}s` }"
            />
        </g>
    </svg>
</template>

<style scoped>
.circuit-pulse {
    stroke-dasharray: 90 1400;
    stroke-dashoffset: 1490;
    animation-name: circuitFlow;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    filter: drop-shadow(0 0 6px currentColor);
    opacity: 0.9;
}

.circuit-node {
    animation: circuitBlink 4s ease-in-out infinite;
}

@keyframes circuitFlow {
    0% {
        stroke-dashoffset: 1490;
    }
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes circuitBlink {
    0%,
    100% {
        opacity: 0.25;
    }
    50% {
        opacity: 1;
        filter: drop-shadow(0 0 5px #38bdf8);
    }
}

@media (prefers-reduced-motion: reduce) {
    .circuit-pulse,
    .circuit-node {
        animation: none;
    }
    .circuit-pulse {
        opacity: 0;
    }
}
</style>
