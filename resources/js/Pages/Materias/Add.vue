<template>
    <AddButton @click="openModal()">
        <i class="fa-solid fa-plus pe-1"></i> Agregar
    </AddButton>
    <AddConfirmationModal
        :show="confirmingOpenModal"
        @close="confirmingOpenModal = false"
        maxWidth="sm"
    >
        <template #title> agregar nuevo </template>

        <template #content>
            <form @submit.prevent="store">
                <div class="px-6">
                    <InputLabel for="nombre" value="Nombre" />
                    <TextInput
                        v-model="this.form.nombre"
                        id="nombre"
                        ref="input_nombre"
                        required
                        autocomplete="off"
                    />
                    <InputError class="mt-2" :message="form.errors.nombre" />
                </div>

                <div class="flex flex-row justify-end px-6 mt-4 text-right">
                    <SecondaryButton type="button" @click="this.closeModal()">
                        Cerrar
                    </SecondaryButton>

                    <SaveButton
                        class="ml-2"
                        type="submit"
                        :disabled="this.form.processing"
                    >
                        Guardar
                    </SaveButton>
                </div>
            </form>
        </template>
    </AddConfirmationModal>
</template>
<script>
import { defineComponent, nextTick, ref } from "vue";
import AddButton from "@/Components/AddButton.vue";
import AddConfirmationModal from "@/Components/AddConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SaveButton from "@/Components/SaveButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        AddButton,
        AddConfirmationModal,
        SecondaryButton,
        SaveButton,
        TextInput,
        InputLabel,
        InputError,
    },
    props: {},
    data() {
        return {
            form: this.$inertia.form({
                nombre: null,
            }),
            confirmingOpenModal: false,
        };
    },
    methods: {
        openModal() {
            this.confirmingOpenModal = true;
            nextTick(() => this.$refs.input_nombre.$el.focus());
        },
        closeModal() {
            this.confirmingOpenModal = false;
            this.form.reset();
        },
        store() {
            this.form.post(this.route("materias.store"), {
                onSuccess: (res) => [
                    this.closeModal(),
                    this.form.reset(),
                    alertify.success("Guardado."),
                ],
            });
        },
    },
});
</script>
