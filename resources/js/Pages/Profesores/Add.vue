<template>
    <Head title="Profesores" />
    <AuthenticatedLayout>
        <form @submit.prevent="store">
            <section class="py-2">
                <section class="bg-gray-200 py-3">
                    <h5 class="h5 text-center">Editar Profesor</h5>
                    <div
                        class="row justify-content-center align-items-center g-2"
                    >
                        <div class="col-5">
                            <InputLabel
                                for="nombre"
                                value="Nombre completo"
                                :class="form.errors.nombre ? 'text-danger' : ''"
                            />
                            <TextInput
                                v-model="this.form.nombre"
                                id="nombre"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-3">
                            <InputLabel for="ingreso" value="Ingreso" />
                            <TextInput
                                v-model="this.form.fecha_ingreso"
                                id="ingreso"
                                type="date"
                                autocomplete="off"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.fecha_ingreso"
                            />
                        </div>
                        <div class="col-2">
                            <InputLabel
                                for="sexo"
                                value="Sexo"
                                :class="form.errors.sexo ? 'text-danger' : ''"
                            />
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
                    <div class="row mt-3 text-center g-2">
                        <!-- campus -->
                        <div class="col-4">
                            <InputLabel
                                for="campus"
                                value="Campus"
                                :class="
                                    form.errors.campus_id ? 'text-danger' : ''
                                "
                            />
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
                        </div>
                        <!-- sni -->
                        <div class="col-4">
                            <InputLabel
                                for="sni"
                                value="Sni"
                                :class="form.errors.sni_id ? 'text-danger' : ''"
                            />
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
                        </div>
                        <!-- categorias -->
                        <div class="col-4">
                            <InputLabel
                                for="categoria"
                                value="Categoria"
                                :class="
                                    form.errors.categoria_id
                                        ? 'text-danger'
                                        : ''
                                "
                            />
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
                        </div>
                    </div>
                </section>
            </section>
            <section>
                <div class="row mt-1">
                    <div class="col-6">
                        <div class="adscripcion bg-gray-200 py-3">
                            <div
                                class="row justify-content-center align-items-center g-2"
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
                                        :class="
                                            form.errors.carrera_id
                                                ? 'text-danger'
                                                : ''
                                        "
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="promocion bg-gray-200 py-3">
                            <div
                                class="row justify-content-center align-items-center g-2"
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
                                        v-model="this.form.fecha_grado"
                                        id="fecha"
                                        type="date"
                                        autocomplete="off"
                                    />
                                    <InputError
                                        :message="form.errors.fecha_grado"
                                    />
                                </div>
                                <!-- carrera -->
                                <div class="col-8">
                                    <div class="flex">
                                        <InputLabel
                                            for="grado"
                                            value="Grado"
                                            :class="
                                                form.errors.grado_id
                                                    ? 'text-danger'
                                                    : ''
                                            "
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
                        </div>
                    </div>
                </div>
            </section>
            <div class="row pt-3">
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
                fecha_grado: null,
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
