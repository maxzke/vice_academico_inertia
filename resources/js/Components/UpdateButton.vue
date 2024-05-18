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
        class="inline-flex h-8 items-center px-5 py-1 bg-amber-400 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-400 focus:ring-0 disabled:opacity-25 transition rounded"
    >
        <slot />
    </button>
</template>
