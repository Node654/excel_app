<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(['failedRows']);
console.log(props.failedRows.data);
</script>

<template>

    <MainLayout>
        <div>
            Failed rows
        </div>
        <div class="container mx-auto" v-if="props.failedRows">
            <table class="border w-full mb-5">
                <thead class="border">
                    <tr>
                        <th class="border">Id</th>
                        <th class="border">Row</th>
                        <th class="border">Key</th>
                        <th class="border">Message</th>
                        <th class="border">task_id</th>
                        <th class="border">Created_at</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="failedRow in props.failedRows.data">
                        <td class="border">{{ failedRow.id }}</td>
                        <td class="border">{{ failedRow.row }}</td>
                        <td class="border">{{ failedRow.key }}</td>
                        <td class="border">{{ failedRow.message }}</td>
                        <td class="border">{{ failedRow.taskId.id }}</td>
                        <td class="border">{{ failedRow.createdAt }}</td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('task.index')" class="text-sky-400 text-2xl">Tasks</Link>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
