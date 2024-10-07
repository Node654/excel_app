<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {ref, useTemplateRef} from "vue";
import {router} from "@inertiajs/vue3";

const fileInput = useTemplateRef('file');
const fileExcel = ref(null);

function selectExcel() {
    fileInput.value.click();
}

function addFile(e) {
    fileExcel.value = e.target.files[0];
}

function storeExcel() {
    const formData = new FormData();
    formData.append('file', fileExcel.value);
    router.post('/projects/import/store', formData);
}

</script>

<template>

    <MainLayout>
        <div class="flex justify-center">
            <form class="mt-5 mr-10">
                <div>
                    <input @change.prevent="addFile" type="file" ref="file" class="hidden">
                    <button type="button" @click.prevent="selectExcel" class="hover:bg-gray-600 hover:text-green-500 w-28 p-5 text-sky-50 bg-sky-500 rounded-full">Excel</button>
                </div>
            </form>
            <div v-if="fileExcel" class="mt-5">
                <button @click.prevent="storeExcel" class="hover:bg-red-600 hover:text-green-500 w-28 p-5 text-sky-50 bg-green-500 rounded-full">Import</button>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
