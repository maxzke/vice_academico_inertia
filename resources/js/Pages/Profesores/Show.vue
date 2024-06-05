<template>
    <Head title="Profesores" />
    <AuthenticatedLayout>
        <section>
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header bg-white">
                            <span
                                class="fw-bold text-slate-600 text-capitalize"
                            >
                                {{ this.profesor.nombre }}
                            </span>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Sexo</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize">
                                            {{ this.profesor.sexo }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Ingreso</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize">
                                            {{
                                                moment(
                                                    this.profesor.ingreso
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >SNI</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize">
                                            {{ this.profesor.sni.nombre }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Campus</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize">
                                            {{ this.profesor.campus.nombre }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Categoria</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize">
                                            {{ this.profesor.categoria.nombre }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Carrera</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize"
                                            >{{
                                                this.profesor.carreras[0]
                                                    ?.nombre
                                            }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"></span>
                                    </td>
                                    <td>
                                        <template
                                            v-for="(carrera, index) in this
                                                .profesor.carreras"
                                            :key="carrera.id"
                                        >
                                            <span
                                                v-if="index > 0"
                                                class="text-muted small text-capitalize"
                                                >{{ carrera.nombre }}<br
                                            /></span>
                                        </template>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"
                                            >Grado</span
                                        >
                                    </td>
                                    <td>
                                        <span class="small text-capitalize"
                                            >{{
                                                this.profesor.grados[0]?.nombre
                                            }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end">
                                        <span class="text-muted small"></span>
                                    </td>
                                    <td>
                                        <template
                                            v-for="(grado, index) in this
                                                .profesor.grados"
                                            :key="grado.id"
                                        >
                                            <span
                                                v-if="index > 0"
                                                class="text-muted small text-capitalize"
                                                >{{ grado.nombre }}<br
                                            /></span>
                                        </template>
                                    </td>
                                </tr>
                            </table>
                            <PrimaryButton @click="editar()" class="mt-4">
                                <i class="fa-solid fa-pen"></i> Editar
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row pt-3">
            <div class="col-12 text-center">
                <SecondaryButton @click="this.volver()" class="mr-2">
                    <i class="fa-solid fa-angle-left"></i> Volver
                </SecondaryButton>
            </div>
        </div>
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
import { Link, router } from "@inertiajs/vue3";
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
        volver_url: String,
    },
    data() {
        return {
            moment: moment,
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
            //router.visit(this.volver_url);
            this.$inertia.get(this.route("profesor.index"));
        },
        editar() {
            this.$inertia.get(this.route("profesor.edit", this.profesor));
        },
    },
    watch: {},
});
</script>
