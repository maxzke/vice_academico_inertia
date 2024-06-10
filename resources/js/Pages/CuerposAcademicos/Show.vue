<template>
    <Head title="Cuerpo Académico" />
    <AuthenticatedLayout>
        <section>
            <div class="flex align-items-center">
                <span class="text-slate-600 text-capitalize"
                    >Cuerpo Acedémico:</span
                >
                <span class="text-slate-600 text-capitalize ml-3">{{
                    this.cuerpo_academico.nombre
                }}</span>
            </div>
            <div class="flex align-items-center mt-1">
                <span class="text-slate-600 text-capitalize"> Proyecto:</span>
                <span class="text-slate-600 text-capitalize ml-3">{{
                    this.cuerpo_academico.nombre
                }}</span>
            </div>
            <div class="row mt-2">
                <template
                    v-for="item in this.profesores.profesores"
                    :key="item.id"
                >
                    <div class="col-4 my-1">
                        <div class="card">
                            <div class="card-header bg-white">
                                <span class="text-slate-600 text-capitalize">
                                    {{ item.nombre }}
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
                                                {{ item.sexo }}
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
                                                    moment(item.ingreso).format(
                                                        "DD-MM-YYYY"
                                                    )
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
                                                {{ item.sni?.nombre }}
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
                                                {{ item.campus?.nombre }}
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
                                                {{ item.categoria?.nombre }}
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
                                                >{{ item.carreras[0]?.nombre }}
                                            </span>
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
                                                >{{ item.grados[0]?.nombre }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </template>
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
        cuerpo_academico: Object,
        profesores: Object,
        proyecto: Object,
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
            this.form.post(this.route("item.store"), {
                onSuccess: (res) => [
                    this.form.reset(),
                    alertify.success("Guardado."),
                ],
                onError: (msg) => [alertify.error("No guardado.")],
            });
        },
        volver() {
            //router.visit(this.volver_url);
            this.$inertia.get(this.route("item.index"));
        },
        editar() {
            this.$inertia.get(this.route("item.edit", this.profesor));
        },
    },
    watch: {},
});
</script>
