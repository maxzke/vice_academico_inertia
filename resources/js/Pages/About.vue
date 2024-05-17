<template>
    <Head title="About us" />

    <AuthenticatedLayout>
        <template #header> About us </template>

        <div class="row bg-white rounded">
            <div class="col-12">
                <p>Sample static text page Bootstrap</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
