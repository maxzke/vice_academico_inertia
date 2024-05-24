<template>
    <Head title="Profesores" />
    <AuthenticatedLayout>
        <section class="py-2">
            <form @submit.prevent="store">
                <section class="bg-gray-200 py-3 px-3">
                    <h5 class="h5 text-center">Registrar Profesor</h5>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-6">
                            <div class="flex">
                                <InputLabel
                                    for="nombre"
                                    value="Nombre completo"
                                /><InputError
                                    class="ml-1"
                                    :message="form.errors.nombre"
                                />
                            </div>
                            <TextInput
                                v-model="this.form.nombre"
                                id="nombre"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="ingreso" value="Ingreso" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.ingreso"
                                />
                            </div>
                            <TextInput
                                v-model="this.form.ingreso"
                                id="ingreso"
                                type="date"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="sexo" value="Sexo" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.sexo"
                                />
                            </div>
                            <select
                                class="mt-1 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                id="sexo"
                                v-model="this.form.sexo"
                            >
                                <option disabled selected value="SELECCIONAR">
                                    SELECCIONAR
                                </option>
                                <option value="mujer">Mujer</option>
                                <option value="hombre">Hombre</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="row mt-3 justify-content-center align-items-center"
                    >
                        <!-- campus -->
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="campus" value="Campus" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.campus_id"
                                />
                            </div>
                            <select
                                class="mt-1 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                id="campus"
                                v-model="this.form.campus_id"
                            >
                                <option disabled selected value="SELECCIONAR">
                                    SELECCIONAR
                                </option>
                                <option
                                    v-for="item in this.campus"
                                    :key="item.id"
                                    :value="item.id"
                                    v-text="item.nombre"
                                ></option>
                            </select>
                        </div>
                        <!-- sni -->
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="sni" value="Sni" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.sni_id"
                                />
                            </div>
                            <select
                                class="mt-1 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                id="sni"
                                v-model="this.form.sni_id"
                            >
                                <option disabled selected value="SELECCIONAR">
                                    SELECCIONAR
                                </option>
                                <option
                                    v-for="item in this.snis"
                                    :key="item.id"
                                    :value="item.id"
                                    v-text="item.nombre"
                                ></option>
                            </select>
                        </div>
                        <!-- categorias -->
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="sni" value="Categoria" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.categoria_id"
                                />
                            </div>
                            <select
                                class="mt-1 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                id="categoria"
                                v-model="this.form.categoria_id"
                            >
                                <option disabled selected value="SELECCIONAR">
                                    SELECCIONAR
                                </option>
                                <option
                                    v-for="item in this.categorias"
                                    :key="item.id"
                                    :value="item.id"
                                    v-text="item.nombre"
                                ></option>
                            </select>
                        </div>
                        <!-- grado -->
                        <div class="col-3">
                            <div class="flex">
                                <InputLabel for="sni" value="Grado" />
                                <InputError
                                    class="ml-1"
                                    :message="form.errors.grado_id"
                                />
                            </div>
                            <select
                                class="mt-1 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                id="categoria"
                                v-model="this.form.grado_id"
                            >
                                <option disabled selected value="SELECCIONAR">
                                    SELECCIONAR
                                </option>
                                <option
                                    v-for="item in this.grados"
                                    :key="item.id"
                                    :value="item.id"
                                    v-text="item.nombre"
                                ></option>
                            </select>
                        </div>
                    </div>
                </section>

                <div
                    class="row mt-3 justify-content-center align-items-center g-2"
                >
                    <div class="col-6 text-center">
                        <h5 class="h5 text-gray-700">Adscripción</h5>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <!-- carrera -->
                    <div class="col-7">
                        <div class="flex">
                            <InputLabel for="carreras" value="Carrera" />
                            <InputError
                                class="ml-1"
                                :message="form.errors.carrera_id"
                            />
                        </div>
                        <vSelect
                            id="carreras"
                            v-if="this.carreras.length > 0"
                            v-model="this.form.carrera_id"
                            :options="this.carreras"
                            label="nombre"
                            class="bg-white focus:border-none h-8 border-gray-200 text-gray-900 text-sm text-capitalize"
                        >
                            <template
                                #no-options="{ search, searching, loading }"
                            >
                                No hay datos...
                            </template>
                        </vSelect>
                    </div>
                    <!-- fecha -->
                    <div class="col-3">
                        <div class="flex">
                            <InputLabel
                                for="fecha"
                                value="Fecha de ingreso a la carrera"
                            />
                            <InputError
                                class="ml-1"
                                :message="form.errors.fecha"
                            />
                        </div>
                        <TextInput
                            v-model="this.form.fecha"
                            id="fecha"
                            type="date"
                            autocomplete="off"
                        />
                    </div>
                </div>
                <div class="row mt-5">
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
        </section>
    </AuthenticatedLayout>
</template>

<script>
import { defineComponent } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddButton from "@/Components/AddButton.vue";
import Delete from "@/Pages/Profesores/Delete.vue";
import pagination from "@/Components/Pagination.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import vSelect from "vue-select";
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import "vue-select/dist/vue-select.css";
export default defineComponent({
    components: {
        AuthenticatedLayout,
        AddButton,
        Delete,
        Head,
        Link,
        pagination,
        TextInput,
        InputLabel,
        InputError,
        vSelect,
        PrimaryButton,
        SecondaryButton,
    },
    props: {
        campus: Object,
        snis: Object,
        categorias: Object,
        carreras: Object,
        grados: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                nombre: null,
                apellido_p: null,
                apellido_m: null,
                ingreso: null,
                sexo: null,
                fecha: null,
                campus_id: null,
                sni_id: null,
                categoria_id: null,
                carrera_id: null,
                grado_id: null,
            }),
        };
    },
    mounted() {},
    methods: {
        store() {
            this.form.post(this.route("profesor.store"), {
                onSuccess: (res) => [
                    this.form.reset(),
                    alertify.success("Guardado."),
                ],
                onError: (msg) => [alertify.error("No guardado.")],
            });
        },
        volver() {
            this.$inertia.get(this.route("profesor.index"));
        },
    },
    watch: {},
});
</script>
