<template>
    <app-layout title="Categories">
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Categories
                <create-category />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <list-category :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ListCategory from './Partials/ListCategory.vue'
    import CreateCategory from './Partials/CreateCategory.vue'

    export default defineComponent({
        components: {
            AppLayout,
            ListCategory,
            CreateCategory
        },
        props: {
            categories: Array
        }
    })
</script>
