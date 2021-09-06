<template>
    <div>
        <jet-button @click="createTask">
            Create New
        </jet-button>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="creatingTask" @close="closeModal">
            <template #title>
                Create Task
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Task Description"
                                ref="description"
                                v-model="form.description"
                                @keyup.enter="create" />

                    <jet-input-error :message="form.errors.description" class="mt-2" />
                </div>

                <div class="mt-4">
                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-3/4"
                        v-model="form.category_id" >
                        <option value="" disabled selected>Select Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>

                    <jet-input-error :message="form.errors.category_id" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="create" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
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
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
    },

    props: {
        categories: Array
    },

    data() {
        return {
            creatingTask: false,

            form: this.$inertia.form({
                description: '',
                category_id: ''
            })
        }
    },

    mounted () {
    },

    methods: {
        createTask() {
            this.fetchCategories();
            this.creatingTask = true;

            setTimeout(() => this.$refs.description.focus(), 250)
        },

        fetchCategories() {
            Inertia.reload({ only: ['categories'] })
        },

        create() {
            this.form.post(route('tasks.store'), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.closeModal();
                    this.form.reset();
                },
            })
        },

        closeModal() {
            this.creatingTask = false
            this.form.clearErrors()
            this.form.reset()
        },
    },
}
</script>
