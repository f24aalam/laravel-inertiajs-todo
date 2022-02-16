<template>
    <app-layout title="Tasks">
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Tasks
                <save-task :categories="categories" />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
                <jet-input type="text" class="mt-1 block w-3/4" @keyup="search" :value="query"/>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <list-task :tasks="tasks" :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetInput from '@/Jetstream/Input.vue'
import SaveTask from './Partials/SaveTask.vue'
import ListTask from './Partials/ListTask.vue'
import { Inertia } from '@inertiajs/inertia'

export default defineComponent({
    components: {
        AppLayout,
        JetInput,
        SaveTask,
        ListTask,
    },

    props: {
        categories: Array,
        tasks: Array,
        query: String,
    },

    data() {
        return {
            timer: null
        }
    },

    methods: {
        search(event) {
            if (this.timer !== null) {
                clearTimeout(this.timer);
            }

            this.timer = setTimeout(() => {
                this.timer = null;

                Inertia.replace(
                    route('tasks.index', {
                        query: event.target.value,
                    }),
                );
            }, 500);
        }
    }
})
</script>

