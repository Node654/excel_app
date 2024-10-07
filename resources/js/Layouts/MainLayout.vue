<script setup>
import { Link } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";
</script>

<template>

    <div class="w-full mx-auto text-center">
        <Navigation />

        <slot />
    </div>

</template>

<style scoped>

</style>
