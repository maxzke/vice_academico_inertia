<template>
    <Link :href="href" :class="classes">
        <slot name="icon" />
        <span>
            <slot />
        </span>
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "flex items-center py-2 ps-2 bg-yellow-400 bg-opacity-15 text-gray-900 hover:text-gray-900"
        : "flex items-center py-2 ps-2 text-gray-400 hover:bg-yellow-400 hover:text-gray-900"
);
</script>
