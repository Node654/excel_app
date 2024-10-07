<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex space-x-4 mx-auto">
                        <div class="w-96 flex justify-between mx-auto">
                            <Link :href="route('project.index')" :class="['rounded-md px-3 py-2 text-sm font-medium',
                                 $page.component === 'Project/Index' ? 'bg-gray-900 text-white' : 'hover:bg-gray-700 hover:text-white text-gray-300'
                                 ]">Project index</Link>
                            <Link :href="route('project.import')" :class="['rounded-md px-3 py-2 text-sm font-medium',
                                 $page.component === 'Project/Import' ? 'bg-gray-900 text-white' : 'hover:bg-gray-700 hover:text-white text-gray-300'
                                 ]">Project import</Link>
                            <Link :href="route('task.index')" :class="['rounded-md px-3 py-2 text-sm font-medium',
                                 $page.component === 'Task/Index' ? 'bg-gray-900 text-white' : 'hover:bg-gray-700 hover:text-white text-gray-300'
                                 ]">Tasks</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
