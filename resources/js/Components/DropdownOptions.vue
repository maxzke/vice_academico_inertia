<template>
    <span
        class="px-1 py-2 text-sm text-white bg-indigo-800 hover:bg-indigo-700"
    >
        <slot />
    </span>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
