<template>
    <Head title="Profesores" />
    <AuthenticatedLayout>
        <section class="py-2">
            <div class="row">
                <div class="col-12 col-md-4 text-gray-700">
                    <h5 class="flex align-items-center h5 ps-2">
                        Profesores
                        <span class="badge bg-gray-400 ms-2">{{
                            this.totalItem
                        }}</span>
                    </h5>
                </div>
                <div class="col-9 col-md-5">
                    <input
                        type="search"
                        name="buscar"
                        class="w-full h-7 border-none bg-white shadow"
                        placeholder="Buscar"
                        autocomplete="off"
                        v-model="this.paramSearch.search"
                    />
                </div>
                <div class="col-2 col-md-3">
                    <AddButton @click="this.create()">
                        <i class="fa-solid fa-plus pe-1"></i> Agregar
                    </AddButton>
                </div>
            </div>
            <div class="row mt-3">
                <div
                    class="col-12 bg-white rounded-md shadow overflow-x-auto px-0"
                >
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="pb-3 pt-6 px-6">Nombre</th>
                            <th class="pb-3 pt-6 px-6">Campus</th>
                            <th class="pb-3 pt-6 px-6">Categoria</th>
                            <th class="pb-3 pt-6 px-6">Sni</th>
                            <th class="pb-3 pt-6 px-6">Carrera</th>
                            <th></th>
                        </tr>
                        <tbody>
                            <tr
                                class="align-middle hover:bg-slate-100 focus-within:bg-slate-100 cursor-pointer"
                                v-for="item in this.all.data"
                                :key="item.id"
                                @click="show(item)"
                            >
                                <td class="text-capitalize border-t py-2">
                                    <span
                                        class="px-2"
                                        v-text="item.nombre"
                                    ></span>
                                </td>
                                <td class="text-capitalize border-t py-2">
                                    <span
                                        class="px-2"
                                        v-text="item.campus.nombre"
                                    ></span>
                                </td>
                                <td class="text-capitalize border-t py-2">
                                    <span
                                        class="px-2"
                                        v-text="item.categoria.nombre"
                                    ></span>
                                </td>
                                <td class="text-capitalize border-t py-2">
                                    <span
                                        class="px-2"
                                        v-text="item.sni.nombre"
                                    ></span>
                                </td>
                                <td class="text-capitalize border-t py-2">
                                    <span
                                        class="px-2"
                                        v-text="item.carreras[0].nombre"
                                    ></span>
                                </td>
                                <td class="border-t">
                                    <i
                                        class="px-2 fa-solid fa-angle-right text-slate-400"
                                    ></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pb-5">
                    <pagination class="mt-6" :links="this.all.links" />
                </div>
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
import debounce from "lodash/debounce";
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";
import Dropdown from "@/Components/Dropdown.vue";

export default defineComponent({
    components: {
        AuthenticatedLayout,
        AddButton,
        Delete,
        Head,
        Link,
        pagination,
        Dropdown,
    },
    props: {
        all: Object,
        totalItem: Number,
    },
    data() {
        return {
            paramSearch: {
                search: null,
            },
        };
    },
    mounted() {},
    methods: {
        create() {
            this.$inertia.get(this.route("profesor.create"));
        },
        show(profesor) {
            this.$inertia.get(this.route("profesor.show", profesor));
        },
    },
    watch: {
        paramSearch: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(
                    this.route("profesor.index"),
                    pickBy(this.paramSearch),
                    {
                        preserveState: true,
                    }
                );
            }, 350),
        },
    },
});
</script>
