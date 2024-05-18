<template>
    <Link
        class="block px-4 py-2 text-sm text-dark bg-gray-50 hover:bg-teal-600"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
