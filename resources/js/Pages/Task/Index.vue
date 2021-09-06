<template>
    <app-layout title="Tasks">
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Tasks
                <create-task :categories="categories" />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <task-list :tasks="tasks" :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import CreateTask from './Partials/CreateTask.vue'
import TaskList from './Partials/TaskList.vue'

export default defineComponent({
    components: {
        AppLayout,
        CreateTask,
        TaskList,
    },

    props: {
        categories: Array,
        tasks: Array,
    },
})
</script>

