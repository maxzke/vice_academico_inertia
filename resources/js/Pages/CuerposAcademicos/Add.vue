<template>
    <Head title="Cuerpos académicos" />
    <AuthenticatedLayout>
        <form @submit.prevent="store">
            <h5 class="h5">Agregar Nuevo Cuerpo Académico</h5>
            <div class="row mt-5">
                <div class="col-6">
                    <InputLabel
                        for="nombre"
                        value="Nombre del Cuerpo Académico"
                        :class="form.errors.nombre ? 'text-danger' : ''"
                    />
                    <TextInput
                        v-model="this.form.nombre"
                        id="nombre"
                        required
                        autocomplete="off"
                    />
                    <InputError :message="form.errors.nombre" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <InputLabel
                        for="profesor"
                        value="Agregar Profesores"
                        :class="form.errors.profesores ? 'text-danger' : ''"
                    />
                    <div>
                        <multiselect
                            v-model="this.form.profesores"
                            tag-placeholder="Agregar"
                            placeholder="Buscar profesor"
                            label="nombre"
                            track-by="nombre"
                            select-label="Seleccionar"
                            :options="this.all"
                            :multiple="true"
                            :taggable="true"
                            :show-labels="false"
                            @tag="addTag"
                        ></multiselect>
                    </div>

                    <InputError :message="form.errors.profesores" />
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-12 text-center">
                    <SecondaryButton @click="this.volver()" class="mr-2">
                        Cancelar
                    </SecondaryButton>
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Guardar
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script>
import { defineComponent } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Multiselect from "vue-multiselect";
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
export default defineComponent({
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        TextInput,
        InputLabel,
        Multiselect,
        PrimaryButton,
        SecondaryButton,
        InputError,
    },
    props: {
        all: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                profesores: null,
                nombre: null,
            }),
        };
    },
    mounted() {},
    methods: {
        store() {
            this.form.post(this.route("cuerpo_academico.store"), {
                onSuccess: (res) => [
                    this.form.reset(),
                    alertify.success("Guardado."),
                ],
                onError: (msg) => [alertify.error("Datos incompletos.")],
            });
        },
        volver() {
            this.$inertia.get(this.route("cuerpo_academico.index"));
        },
        addTag(newTag) {
            const tag = {
                nombre: newTag,
                code:
                    newTag.substring(0, 2) +
                    Math.floor(Math.random() * 10000000),
            };
            this.options.push(tag);
            this.value.push(tag);
        },
    },
    watch: {},
});
</script>
