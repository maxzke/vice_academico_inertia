<template>
    <button
        role="button"
        class="btn btn-sm btn-spinner text-white bg-slate-400 hover:bg-indigo-400 h-7 pt-1"
        @click="openModal()"
    >
        <i class="fas fa-pen"></i>
        <!-- <i class="fa-solid fa-pen-to-square fa-xs"></i>-->
    </button>
    <UpdateConfirmationModal
        :show="confirmingOpenModal"
        @close="confirmingOpenModal = false"
        maxWidth="sm"
    >
        <template #title> Actualizar </template>

        <template #content>
            <form @submit.prevent="update">
                <div class="px-6">
                    <InputLabel for="nombre" value="Nombre" />
                    <TextInput
                        v-model="this.form.nombre"
                        id="nombre"
                        required
                        autocomplete="off"
                    />
                    <InputError class="mt-2" :message="form.errors.nombre" />
                </div>

                <div class="flex flex-row justify-end px-6 mt-4 text-right">
                    <SecondaryButton type="button" @click="this.closeModal()">
                        Cerrar
                    </SecondaryButton>

                    <UpdateButton
                        class="ml-2"
                        type="submit"
                        :disabled="this.form.processing"
                    >
                        Actualizar
                    </UpdateButton>
                </div>
            </form>
        </template>
    </UpdateConfirmationModal>
</template>
<script>
import { defineComponent } from "vue";
import UpdateConfirmationModal from "@/Components/UpdateConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        UpdateConfirmationModal,
        SecondaryButton,
        UpdateButton,
        TextInput,
        InputLabel,
        InputError,
    },
    props: {
        item: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: "put",
                id: this.item.id,
                nombre: this.item.nombre,
            }),
            confirmingOpenModal: false,
        };
    },
    methods: {
        openModal() {
            this.confirmingOpenModal = true;
        },
        closeModal() {
            this.confirmingOpenModal = false;
        },
        update() {
            this.form.post(this.route("materias.update", this.form.id), {
                onSuccess: () => [
                    this.closeModal(),
                    alertify.success("Actualizado !"),
                ],
                onError: (msg) => [
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: msg.error,
                        showConfirmButton: false,
                        timer: 1500,
                    }),
                ],
            });
        },
    },
});
</script>
