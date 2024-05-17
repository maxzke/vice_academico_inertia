<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Dashboard </template>
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2">SISTEMA DE ADMINISTRACIÓN ACADEMICA</h2>
                    <h3 class="h3">Universidad Del Papaloapan</h3>
                    <span>
                        <!-- AQUI SE MOSTRARAN LOS CLIENTES CON FECHAS PROXIMAS DE
                        PAGOS -->
                    </span>

                    <!-- tarjeta -->
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-file-invoice-dollar fa-3x"></i>
                        <div class="ms-3">
                            <h4 class="mb-0">57 new orders</h4>
                            <p class="text-body-secondary fs-9 mb-0">
                                Awating processing
                            </p>
                        </div>
                    </div>
                    <!-- tarjeta -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
