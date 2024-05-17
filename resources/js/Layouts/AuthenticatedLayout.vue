<template>
    <div class="flex h-screen bg-gray-200">
        <Navigation />
        <div class="flex flex-1 flex-col overflow-hidden">
            <Header />
            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-panel">
                <div class="container-fluid mx-auto px-5">
                    <h4 class="mb-2 text-xl font-medium text-indigo-800 pt-2">
                        <slot name="header" />
                    </h4>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from "@/Layouts/Header.vue";
import Navigation from "@/Layouts/Navigation.vue";
</script>
<style>
.bg-panel {
    background-color: #f1f5f9;
}
</style>
