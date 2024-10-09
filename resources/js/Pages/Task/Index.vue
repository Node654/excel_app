<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(['tasks']);

</script>

<template>

    <MainLayout>
        <div>
            Task index
        </div>
        <div class="container mx-auto" v-if="props.tasks">
            <table class="border w-full">
                <thead class="border">
                    <tr>
                        <th class="border">Id</th>
                        <th class="border">User</th>
                        <th class="border">File</th>
                        <th class="border">Status</th>
                        <th class="border">Failed Rows</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="task in props.tasks.data">
                        <td class="border">{{ task.id }}</td>
                        <td class="border">{{ task.user.name }}</td>
                        <td class="border">{{ task.file.path }}</td>
                        <td class="border">{{ task.status }}</td>
                        <td class="border" v-if="task.failedRowsCount > 0">
                            <Link :href="route('tasks.failed-list', task.id)" class="text-sky-400">Failed Row</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <Pagination class="mt-7" :links="props.tasks.meta.links"/>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
