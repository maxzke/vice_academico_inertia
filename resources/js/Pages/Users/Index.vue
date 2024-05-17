<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header> Usuarios </template>

        <Link
            :href="route('register')"
            class="ms-4 font-semibold text-sky-600 hover:text-sky-400 dark:text-sky-600 dark:hover:text-sky-400"
            >Registrar Nuevo Usuarios</Link
        >
        <div
            class="inline-block min-w-full overflow-hidden rounded-lg shadow mt-4 bg-white"
        >
            <table class="w-full whitespace-no-wrap">
                <tr
                    class="bg-white border-b text-left text-xs font-semibold uppercase tracking-wide text-gray-500"
                >
                    <th
                        class="border-b-2 border-gray-200 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                    >
                        Nombre
                    </th>
                    <th
                        class="border-b-2 border-gray-200 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                    >
                        Email
                    </th>
                </tr>
                <tbody>
                    <template v-for="user in users.data" :key="user.id">
                        <tr
                            class="align-middle hover:bg-slate-100 focus-within:bg-slate-100 cursor-pointer"
                        >
                            <td
                                class="border-b border-gray-200 px-5 py-3 text-sm"
                            >
                                <p
                                    class="text-gray-900 whitespace-no-wrap text-capitalize"
                                >
                                    {{ user.name }}
                                </p>
                            </td>
                            <td
                                class="border-b border-gray-200 px-5 py-1 text-sm"
                            >
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ user.email }}
                                </p>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div
                class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"
            >
                <pagination :links="users.links" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <small class="text-muted"
                    >Solo los usuarios registrados tendrán acceso al
                    sistema.</small
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    users: Object,
});
</script>
