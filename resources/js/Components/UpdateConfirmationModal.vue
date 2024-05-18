<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div
            class="flex flex-row justify-start px-6 py-2 bg-amber-400 text-lg fw-bold text-capitalize text-white"
        >
            <slot name="title" />
        </div>
        <div class="bg-white pt-2 pb-4 sm:pb-4">
            <div class="row mt-3">
                <div class="col-12">
                    <slot name="content" />
                </div>
            </div>
        </div>
    </Modal>
</template>
