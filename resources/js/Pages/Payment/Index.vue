<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    payments: Object
})

</script>

<template>

    <MainLayout>
        <div>
            Payments index
        </div>

        <div class="container mx-auto" v-if="props.payments">
            <table class="border w-full">
                <thead class="border">
                    <tr>
                        <th class="border">Id</th>
                        <th class="border">Project_id</th>
                        <th class="border">Title</th>
                        <th class="border">Value</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="payment in props.payments.data">
                        <td class="border">{{ payment.id }}</td>
                        <td class="border">{{ payment.project_id }}</td>
                        <td class="border">{{ payment.title }}</td>
                        <td class="border">{{ payment.value }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-5">
                <Link :href="route('project.index')" class="text-2xl text-sky-500">Projects</Link>
            </div>
            <div>
                <Pagination class="mt-7" :links="props.payments.meta.links"/>
            </div>
        </div>
    </MainLayout>

</template>

<style scoped>

</style>
