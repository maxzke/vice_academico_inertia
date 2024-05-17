<template>
    <button
        role="button"
        class="btn btn-sm text-white bg-slate-400 hover:bg-red-400 ms-1 h-7 pt-1"
        @click="openModal()"
    >
        <i class="fa-solid fa-trash"></i>
    </button>
    <DeleteConfirmationModal
        :show="confirmingOpenModal"
        @close="confirmingOpenModal = false"
        maxWidth="sm"
    >
        <template #title> Eliminar </template>

        <template #content>
            <div class="px-6">
                <p>¿Desea Eliminar ?</p>
                <br />
                <p>{{ this.item_nombre }}</p>
            </div>

            <div class="flex flex-row justify-end px-6 mt-4 text-right">
                <SecondaryButton
                    type="button"
                    @click="confirmingOpenModal = false"
                >
                    Cerrar
                </SecondaryButton>

                <DeleteButton
                    class="ml-2"
                    type="submit"
                    @click="this.destroy()"
                    :disabled="this.form.processing"
                >
                    Eliminar
                </DeleteButton>
            </div>
        </template>
    </DeleteConfirmationModal>
</template>
<script>
import { defineComponent } from "vue";
import DeleteConfirmationModal from "@/Components/DeleteConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

export default defineComponent({
    components: {
        DeleteConfirmationModal,
        SecondaryButton,
        DeleteButton,
        TextInput,
        InputLabel,
        InputError,
    },
    props: {
        item_id: Number,
        item_nombre: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                id: null,
            }),
            confirmingOpenModal: false,
        };
    },
    methods: {
        openModal() {
            this.form.id = this.item_id;
            this.confirmingOpenModal = true;
        },
        closeModal() {
            this.confirmingOpenModal = true;
        },
        destroy() {
            this.form.delete(this.route("materias.destroy", this.form.id), {
                onSuccess: () => [
                    this.closeModal(),
                    alertify.success("Eliminado !"),
                ],
                onError: (msg) => [alertify.error(msg.error)],
            });
        },
    },
});
</script>
