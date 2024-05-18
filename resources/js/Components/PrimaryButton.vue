<template>
    <button
        :type="type"
        class="rounded-md bg-teal-600 px-4 py-2 text-center text-sm text-white hover:bg-teal-500"
    >
        <slot />
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>
