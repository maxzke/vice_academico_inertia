<template>
    <header
        class="flex items-center justify-between border-b-4 bg-teal-600 px-6 py-3"
    >
        <div class="flex items-center">
            <button
                @click="
                    $page.props.showingMobileMenu =
                        !$page.props.showingMobileMenu
                "
                class="text-gray-500 focus:outline-none lg:hidden"
            >
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M4 6H20M4 12H20M4 18H11"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>
        </div>

        <div class="flex items-center">
            <!-- <span
                class="relative block overflow-hidden text-white text-capitalize me-3"
            >
                <i class="fa-solid fa-user text-green-300"></i>
                {{ $page.props.auth.user.name }}
            </span> -->
            <dropdown>
                <template #trigger>
                    <span
                        class="relative block overflow-hidden text-white text-capitalize me-3 hover:cursor-pointer"
                        @click="dropdownOpen = !dropdownOpen"
                    >
                        <i class="fa-solid fa-user text-green-300 pr-1"></i>
                        {{ $page.props.auth.user.name }}
                    </span>
                </template>
                <template #content>
                    <dropdown-link
                        class="w-full text-left"
                        :href="route('profile.edit')"
                        method="get"
                        as="button"
                    >
                        Perfil
                    </dropdown-link>
                    <dropdown-link
                        class="w-full text-left"
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        Salir
                    </dropdown-link>
                </template>
            </dropdown>
        </div>
    </header>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>
