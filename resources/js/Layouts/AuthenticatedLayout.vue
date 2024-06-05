<template>
    <div class="flex h-screen bg-slate-50">
        <Navigation />
        <div class="flex flex-1 flex-col overflow-hidden">
            <Header />
            <main class="flex-1 overflow-y-auto overflow-x-hidden py-3">
                <div class="container-fluid mx-auto px-5">
                    <h4 class="text-xl font-medium text-indigo-800">
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
    background-color: #90bdeb;
}
</style>
