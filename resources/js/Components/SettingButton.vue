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
        class="btn btn-sm btn-spinner text-white bg-amber-400 hover:bg-amber-500"
    >
        <slot />
        <i class="fa-solid fa-gear"></i>
    </button>
</template>
