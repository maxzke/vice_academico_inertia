<template>
    <Head title="Profesores" />
    <AuthenticatedLayout>
        <section class="py-2">
            <form @submit.prevent="update">
                <section class="bg-gray-200 py-3">
                    <h5 class="h5 text-center">Editar Profesor</h5>
                    <div
                        class="row justify-content-center align-items-center g-2"
                    >
                        <div class="col-5">
                            <InputLabel for="nombre" value="Nombre completo" />
                            <TextInput
                                v-model="this.form.nombre"
                                id="nombre"
                                autocomplete="off"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.nombre"
                            />
                        </div>
                        <div class="col-3">
                            <InputLabel for="ingreso" value="Ingreso" />
                            <TextInput
                                v-model="this.form.ingreso"
                                id="ingreso"
                                type="date"
                                autocomplete="off"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.ingreso"
                            />
                        </div>
                        <div class="col-2">
                            <InputLabel for="sexo" value="Sexo" />
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
                            <InputError :message="form.errors.sexo" />
                        </div>
                    </div>
                    <div
                        class="row mt-3 justify-content-center align-items-center g-2"
                    >
                        <!-- campus -->
                        <div class="col-3">
                            <InputLabel for="campus" value="Campus" />
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
                            <!-- <vSelect
                                id="campus"
                                v-if="this.campus.length > 0"
                                v-model="this.form.campus_id"
                                :options="this.campus"
                                label="nombre"
                                class="bg-white focus:border-none h-8 border-gray-200 text-gray-900 text-sm text-capitalize"
                            >
                                <template
                                    #no-options="{ search, searching, loading }"
                                >
                                    No hay datos...
                                </template>
                            </vSelect> -->

                            <InputError :message="form.errors.campus_id" />
                        </div>
                        <!-- sni -->
                        <div class="col-3">
                            <InputLabel for="sni" value="Sni" />
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
                            <!-- <vSelect
                                id="sni"
                                v-if="this.snis.length > 0"
                                v-model="this.form.sni_id"
                                :options="this.snis"
                                label="nombre"
                                class="bg-white focus:border-none h-8 border-gray-200 text-gray-900 text-sm text-capitalize"
                            >
                                <template
                                    #no-options="{ search, searching, loading }"
                                >
                                    No hay datos...
                                </template>
                            </vSelect> -->
                            <InputError :message="form.errors.sni_id" />
                        </div>
                        <!-- categorias -->
                        <div class="col-4">
                            <InputLabel for="categoria" value="Categoria" />
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
                            <!-- <vSelect
                                id="sni"
                                v-if="this.categorias.length > 0"
                                v-model="this.form.categoria_id"
                                :options="this.categorias"
                                label="nombre"
                                class="bg-white focus:border-none h-8 border-gray-200 text-gray-900 text-sm text-capitalize"
                            >
                                <template
                                    #no-options="{ search, searching, loading }"
                                >
                                    No hay datos...
                                </template>
                            </vSelect> -->

                            <InputError :message="form.errors.categoria_id" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <SecondaryButton
                                @click="this.volver()"
                                class="mr-2"
                            >
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
                </section>
            </form>
        </section>
        <section>
            <div class="row">
                <div class="col-6">
                    <div class="adscripcion mx-1 bg-gray-200">
                        <form @submit.prevent="update_adscripcion">
                            <div
                                class="row mt-3 justify-content-center align-items-center g-2"
                            >
                                <div class="col-12 text-center">
                                    <h5 class="h5 text-gray-700">
                                        Adscripción
                                    </h5>
                                </div>
                            </div>
                            <div
                                class="row justify-content-center align-items-center g-2"
                            >
                                <!-- fecha -->
                                <div class="col-6">
                                    <InputLabel
                                        for="fecha"
                                        value="Fecha de ingreso a la carrera"
                                    />
                                    <TextInput
                                        v-model="this.form.fecha"
                                        id="fecha"
                                        type="date"
                                        autocomplete="off"
                                    />
                                    <InputError :message="form.errors.fecha" />
                                </div>
                                <!-- carrera -->
                                <div class="col-10">
                                    <InputLabel
                                        for="carreras"
                                        value="Carrera"
                                    />
                                    <vSelect
                                        id="carreras"
                                        v-if="this.carreras.length > 0"
                                        v-model="this.form.carrera_id"
                                        :options="this.carreras"
                                        label="nombre"
                                        class="bg-white focus:border-none h-8 border-gray-200 text-gray-900 text-sm text-capitalize"
                                    >
                                        <template
                                            #no-options="{
                                                search,
                                                searching,
                                                loading,
                                            }"
                                        >
                                            No hay datos...
                                        </template>
                                    </vSelect>

                                    <InputError
                                        :message="form.errors.carrera_id"
                                    />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <SecondaryButton
                                        @click="this.volver()"
                                        class="mr-2"
                                    >
                                        Cancelar
                                    </SecondaryButton>
                                    <PrimaryButton
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Guardar
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Carrera</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in this.profesor.carreras"
                                    :key="item.id"
                                >
                                    <td>
                                        <span
                                            class="text-capitalize"
                                            v-text="item.nombre"
                                        ></span>
                                    </td>
                                    <td>
                                        <span>{{
                                            moment(item.pivot.fecha).format(
                                                "DD-MM-YYYY"
                                            )
                                        }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <div class="promocion mx-1 bg-gray-200">
                        <form @submit.prevent="update_promocion">
                            <div
                                class="row mt-3 justify-content-center align-items-center g-2"
                            >
                                <div class="col-12 text-center">
                                    <h5 class="h5 text-gray-700">Promoción</h5>
                                </div>
                            </div>
                            <div
                                class="row justify-content-center align-items-center g-2"
                            >
                                <!-- fecha -->
                                <div class="col-6">
                                    <InputLabel
                                        for="fecha"
                                        value="Fecha de ingreso a la carrera"
                                    />
                                    <TextInput
                                        v-model="this.form.fecha"
                                        id="fecha"
                                        type="date"
                                        autocomplete="off"
                                    />
                                    <InputError :message="form.errors.fecha" />
                                </div>
                                <!-- carrera -->
                                <div class="col-8">
                                    <div class="flex">
                                        <InputLabel for="grado" value="Grado" />
                                        <InputError
                                            class="ml-1"
                                            :message="form.errors.grado_id"
                                        />
                                    </div>
                                    <select
                                        class="col-12 pt-1 h-8 text-gray-900 text-sm text-capitalize focus:border-gray-300 focus:ring-0 border-gray-300"
                                        id="grado"
                                        v-model="this.form.grado_id"
                                    >
                                        <option
                                            disabled
                                            selected
                                            value="SELECCIONAR"
                                        >
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
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <SecondaryButton
                                        @click="this.volver()"
                                        class="mr-2"
                                    >
                                        Cancelar
                                    </SecondaryButton>
                                    <PrimaryButton
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Guardar
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Grado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in this.profesor.carreras"
                                    :key="item.id"
                                >
                                    <td>
                                        <span
                                            class="text-capitalize"
                                            v-text="item.nombre"
                                        ></span>
                                    </td>
                                    <td>
                                        <span>{{
                                            moment(item.pivot.fecha).format(
                                                "DD-MM-YYYY"
                                            )
                                        }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row mt-5 py-5">
                <div class="col-12"></div>
            </div>
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
import moment from "moment";
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
        profesor: Object,
        campus: Object,
        snis: Object,
        categorias: Object,
        carreras: Object,
        grados: Object,
    },
    data() {
        return {
            moment: moment,
            form: this.$inertia.form({
                type: null,
                nombre: this.profesor.nombre,
                apellido_p: this.profesor.apellido_p,
                apellido_m: this.profesor.apellido_m,
                ingreso: this.profesor.ingreso,
                sexo: this.profesor.sexo,
                fecha: this.profesor.fecha,
                campus_id: this.profesor.campus_id,
                sni_id: this.profesor.sni_id,
                categoria_id: this.profesor.categoria_id,
                carrera_id: this.profesor.carrera_id,
            }),
        };
    },
    mounted() {},
    methods: {
        update() {
            this.form.type = "profesor";
            this.form.put(this.route("profesor.update", this.profesor.id), {
                onSuccess: (res) => [alertify.success("Actualizado.")],
                onError: (msg) => [alertify.error("No Actualizado.")],
            });
        },
        update_adscripcion() {
            this.form.type = "adscripcion";
            this.form.put(this.route("profesor.update", this.profesor.id), {
                onSuccess: (res) => [alertify.success("Actualizado.")],
                onError: (msg) => [alertify.error("No Actualizado.")],
            });
        },
        update_promocion() {
            this.form.type = "promocion";
            this.form.put(this.route("profesor.update", this.profesor.id), {
                onSuccess: (res) => [alertify.success("Actualizado.")],
                onError: (msg) => [alertify.error("No Actualizado.")],
            });
        },
        volver() {
            this.$inertia.get(this.route("profesor.index"));
        },
    },
    watch: {},
});
</script>
