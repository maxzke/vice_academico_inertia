<template>
    <div
        :class="$page.props.showingMobileMenu ? 'block' : 'hidden'"
        @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"
    ></div>

    <div
        :class="
            $page.props.showingMobileMenu
                ? 'translate-x-0 ease-out'
                : '-translate-x-full ease-in'
        "
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-40 bg-dark transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
    >
        <div class="flex justify-center items-center">
            <div class="flex items-center">
                <span class="mx-1 text-lg font-semibold text-white">UNPA</span>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <div class="flex items-center">
                <span class="mx-1 text-lg font-semibold text-white"
                    >ACADEMICOS</span
                >
            </div>
        </div>

        <nav x-data="{ isMultiLevelMenuOpen: false }">
            <nav-link
                class="mt-2"
                :href="route('dashboard')"
                :active="route().current('dashboard')"
            >
                <i class="fa-solid fa-gauge-high"></i>
                <span class="ps-2">Dashboard</span>
            </nav-link>
            <nav-link
                class="mt-2"
                :href="route('profesores.index')"
                :active="route().current('profesores.*')"
                ><i class="fa-solid fa-user-tie"></i>
                <span class="ps-2">Profesores</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('campus.index')"
                :active="route().current('campus.*')"
                ><i class="fa-solid fa-location-dot"></i>
                <span class="ps-2">Campus</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('carreras.index')"
                :active="route().current('carreras.*')"
                ><i class="fa-solid fa-graduation-cap"></i>
                <span class="ps-2">Carreras</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('materias.index')"
                :active="route().current('materias.*')"
                ><i class="fa-solid fa-book"></i>
                <span class="ps-2">Materias</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('ciclos.index')"
                :active="route().current('ciclos.*')"
                ><i class="fa-regular fa-calendar-days"></i>
                <span class="ps-2">Ciclos</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('categorias.index')"
                :active="route().current('categorias.*')"
                ><i class="fa-solid fa-table-list"></i>
                <span class="ps-2">Categorias</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('grados.index')"
                :active="route().current('grados.*')"
                ><i class="fa-solid fa-layer-group"></i>
                <span class="ps-2">Grados</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('sni.index')"
                :active="route().current('sni.*')"
                ><i class="fa-brands fa-google-scholar"></i>
                <span class="ps-2">Sni</span></nav-link
            >
            <nav-link
                class="mt-2"
                :href="route('users.index')"
                :active="route().current('users.index')"
            >
                <i class="fa-solid fa-user-large"></i
                ><span class="ps-2">Usuarios </span>
            </nav-link>
            <nav-link
                class="mt-2"
                :href="route('reporte.index')"
                :active="route().current('reporte.*')"
            >
                <i class="fa-solid fa-chart-simple"></i
                ><span class="ps-2">Reportes </span>
            </nav-link>
        </nav>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
    components: {
        NavLink,
        Link,
    },

    setup() {
        let showingTwoLevelMenu = ref(true);

        return {
            showingTwoLevelMenu,
        };
    },
};
</script>

<style scoped></style>
