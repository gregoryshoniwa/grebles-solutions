<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <img
        src="/images/logo-mark.png"
        alt="Grebles Solutions"
        :class="className"
        class="object-contain"
        v-bind="$attrs"
    />
</template>
