<template>
    <Head title="Reportes" />

    <AuthenticatedLayout>
        <template #header> Generar Reporte </template>
        <div class="container py-2">
            <form action="generar-reporte" target="_blank">
                <div class="row">
                    <div class="col-4 text-center">
                        <h1 class="h5">Rango de Fechas</h1>
                        <div class="row">
                            <div class="col-6">
                                <label for="inicio">A partir de la fecha</label>
                                <input
                                    class="h-7 border-gray-200 bg-white"
                                    type="date"
                                    name="inicio"
                                    id="inicio"
                                    v-model="this.form.fecha_inicio"
                                />
                            </div>
                            <div class="col-6">
                                <label for="inicio">Hasta la fecha</label>
                                <input
                                    class="h-7 border-gray-200 bg-white"
                                    type="date"
                                    name="fin"
                                    id="fin"
                                    v-model="this.form.fecha_fin"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-4 text-center">
                        <h1 class="h5">Filtrar por:</h1>
                        <!-- <div class="row my-3">
                            <div class="col-4">
                                <input
                                    name="checked"
                                    type="checkbox"
                                    id="checkbox"
                                    v-model="this.form.checked"
                                />
                                <label for="checkbox" class="px-2">Todos</label>
                            </div>
                        </div> -->
                        <select
                            name="tipo"
                            id="persona"
                            class="pt-1 col-12 h-8 text-gray-900 text-sm text-capitalize border-gray-200"
                            v-model="this.form.filtro"
                            @change="getListado()"
                        >
                            <option
                                disabled="SELECCIONAR"
                                value="SELECCIONAR"
                                selected
                            >
                                SELECCIONAR
                            </option>
                            <option value="cobrador">cobrador</option>
                            <option value="vendedor">vendedor</option>
                            <option value="vehiculo">vehiculo</option>
                        </select>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-4">
                        <vSelect
                            v-if="!this.form.checked"
                            v-model="this.form.item_selected"
                            :options="this.listado"
                            label="nombre"
                            class="bg-white focus:border-none h-8 border-gray-800 text-gray-900 text-sm text-capitalize"
                        >
                            <template
                                #no-options="{ search, searching, loading }"
                            >
                                Sin datos que mostrar...
                            </template>
                        </vSelect>
                        <input
                            type="hidden"
                            name="selected"
                            :value="this.form.item_selected?.id"
                        />
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-4">
                        <button
                            type="submit"
                            class="btn bg-teal-500 hover:bg-teal-600 active:bg-teal-500 h-7 flex align-items-center text-sm text-white focus:ring-0"
                            :disabled="this.form.filtro == null"
                        >
                            <i class="fa-regular fa-file-excel px-2"></i>
                            Generar Reportre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { defineComponent } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
export default defineComponent({
    components: {
        AuthenticatedLayout,
        Head,
        vSelect,
    },
    props: {
        listado: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                fecha_inicio: null,
                fecha_fin: null,
                checked: false,
                item_selected: null,
                filtro: null,
            }),
        };
    },
    mounted() {
        this.form.fecha_inicio = new Date().toISOString().slice(0, 10);
        this.form.fecha_fin = new Date().toISOString().slice(0, 10);
    },
    methods: {
        getListado() {
            this.form.item_selected = null;
            router.get(
                this.route("reporte.index"),
                { filtrar: this.form.filtro },
                { only: ["listado"], preserveState: true }
            );
        },
        reportePorVehiculo() {
            this.filtro = vehiculo;
        },
    },
    watch: {
        // paramSearch: {
        //     deep: true,
        //     handler: debounce(function () {
        //         this.$inertia.get(
        //             this.route("articulos.index"),
        //             pickBy(this.paramSearch),
        //             {
        //                 preserveState: true,
        //             }
        //         );
        //     }, 350),
        // },
    },
});
</script>
