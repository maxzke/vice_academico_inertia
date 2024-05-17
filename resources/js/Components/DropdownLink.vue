<template>
    <Link
        class="block px-4 py-2 text-sm text-white bg-indigo-800 hover:bg-indigo-700"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
