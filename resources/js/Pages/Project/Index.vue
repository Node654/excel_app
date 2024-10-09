<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    projects: Object
})

</script>

<template>

    <MainLayout>
        <div>
            Project index
        </div>

        <div class="container mx-auto" v-if="props.projects">
            <table class="border w-full">
                <thead class="border">
                    <tr>
                        <th class="border">Id</th>
                        <th class="border">Type_id</th>
                        <th class="border">Title</th>
                        <th class="border">Created_at_time</th>
                        <th class="border">Contracted_at</th>
                        <th class="border">Deadline</th>
                        <th class="border">Is_network</th>
                        <th class="border">Is_on_time</th>
                        <th class="border">Has_outsource</th>
                        <th class="border">Has_investors</th>
                        <th class="border">Worker_count</th>
                        <th class="border">Service_count</th>
                    </tr>

                </thead>
                    <tbody class="border">
                    <tr v-for="project in props.projects.data">
                        <td class="border">{{ project.id }}</td>
                        <td class="border">{{ project.type.title }}</td>
                        <td class="border">{{ project.title.path }}</td>
                        <td class="border">{{ project.createdAtTime }}</td>
                        <td class="border">{{ project.contractedAt }}</td>
                        <td class="border">{{ project.deadline }}</td>
                        <td class="border">{{ project.isNetwork }}</td>
                        <td class="border">{{ project.isOnTime }}</td>
                        <td class="border">{{ project.hasOutsource }}</td>
                        <td class="border">{{ project.hasInvestors }}</td>
                        <td class="border">{{ project.workerCount }}</td>
                        <td class="border">{{ project.serviceCount }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <Pagination class="mt-7" :links="props.projects.meta.links"/>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
