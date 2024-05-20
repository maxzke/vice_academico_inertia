<template>
    <Link
        class="block px-4 py-2 text-sm text-slate-700 bg-gray-200 hover:text-slate-50 hover:bg-teal-600"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
