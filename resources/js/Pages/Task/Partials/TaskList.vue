<template>
    <div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Completed
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="task in tasks" :key="task.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            {{ task.description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{ 'bg-green-200 text-green-800': task.completed, 'bg-red-300 text-red-700': !task.completed}">
                                            {{ task.completed ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-700">
                                            {{ task.category.name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" @click.prevent="updateTask(task)" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>

                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Task Modal -->
        <jet-dialog-modal :show="updatingTask" @close="closeModal">
            <template #title>
                Update Task
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Task Name"
                                ref="description"
                                v-model="form.description"
                                @keyup.enter="update" />

                    <jet-input-error :message="form.errors.description" class="mt-2" />
                </div>
                <div class="mt-4">
                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-3/4"
                        v-model="form.category_id" >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id" >
                                {{ category.name }}
                        </option>
                    </select>

                    <jet-input-error :message="form.errors.category_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <jet-checkbox v-model:checked="form.completed"/>
                        <span class="ml-2 text-sm text-gray-600">Completed</span>
                    </label>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="update" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </jet-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>
<script>
import JetButton from '@/Jetstream/Button.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
        JetCheckbox
    },

    props: {
        tasks: Array,
        categories: Array
    },

    data() {
        return {
            updatingTask: false,
            selectedTask: {},

            form: this.$inertia.form({
                description: '',
                category_id: '',
                completed: false
            })
        }
    },

    methods: {
        updateTask(task) {
            this.fetchCategories();
            this.updatingTask = true;
            this.selectedTask = task;
            this.form.description = task.description;
            this.form.category_id = task.category.id;
            this.form.completed = task.completed;

            setTimeout(() => this.$refs.description.focus(), 250)
        },


        fetchCategories() {
            Inertia.reload({ only: ['categories'] })
        },

        update() {
            this.form.put(route('tasks.update', this.selectedTask.id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.closeModal();
                    this.form.reset();
                },
            })
        },

        closeModal() {
            this.updatingTask = false

            this.form.clearErrors()
            this.form.reset()
        },
    },
}
</script>
