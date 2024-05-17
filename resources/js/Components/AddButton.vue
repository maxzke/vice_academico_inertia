<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="btn bg-teal-500 hover:bg-teal-600 active:bg-teal-500 h-7 flex align-items-center text-sm text-white focus:ring-0"
    >
        <slot />
    </button>
</template>
