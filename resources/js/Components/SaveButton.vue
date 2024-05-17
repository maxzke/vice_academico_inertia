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
        class="inline-flex h-8 items-center px-4 py-1 bg-teal-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 active:bg-teal-500 focus:ring-0 disabled:opacity-25 transition rounded"
    >
        <slot />
    </button>
</template>
