<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex h-8 items-center px-4 py-1 bg-red-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-500 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition rounded"
    >
        <slot />
    </button>
</template>
