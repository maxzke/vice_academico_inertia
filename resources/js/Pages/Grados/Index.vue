<template>
    <Head title="Grados" />
    <AuthenticatedLayout>
        <section class="py-2">
            <div class="row">
                <div class="col-12 col-md-4 text-indigo-800">
                    <h5 class="flex align-items-center h5 ps-2">
                        Grados
                        <span class="badge bg-indigo-400 ms-2">{{
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
                    <Add />
                </div>
            </div>
            <div class="row mt-3">
                <div
                    class="col-12 bg-white rounded-md shadow overflow-x-auto px-0"
                >
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="pb-3 pt-6 px-6">Nombre</th>
                            <th></th>
                        </tr>
                        <tbody>
                            <tr
                                class="align-middle hover:bg-slate-100 focus-within:bg-slate-100"
                                v-for="(item, i) in this.all.data"
                                :key="item.id"
                            >
                                <td class="text-capitalize border-t py-3">
                                    <span
                                        class="px-4"
                                        v-text="item.nombre"
                                    ></span>
                                </td>
                                <td class="border-t">
                                    <Update :item="item" />
                                    <Delete
                                        :item_id="item.id"
                                        :item_nombre="item.nombre"
                                    />
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
import Add from "@/Pages/Grados/Add.vue";
import Delete from "@/Pages/Grados/Delete.vue";
import Update from "@/Pages/Grados/Update.vue";
import pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import pickBy from "lodash/pickBy";

export default defineComponent({
    components: {
        AuthenticatedLayout,
        Add,
        Delete,
        Update,
        Head,
        Link,
        pagination,
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
    methods: {},
    watch: {
        paramSearch: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(
                    this.route("grados.index"),
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
