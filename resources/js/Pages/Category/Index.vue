<template>
    <app-layout title="Categories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <category-list :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import CategoryList from './Partials/CategoryList.vue'

    export default defineComponent({
        components: {
            AppLayout,
            CategoryList,
        },
        props: {
            categories: Array
        }
    })
</script>
