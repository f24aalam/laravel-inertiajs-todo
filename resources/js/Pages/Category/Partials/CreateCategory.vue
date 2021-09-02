<template>
    <div>
        <jet-button @click="createCategory">
            Create New
        </jet-button>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="creatingCategory" @close="closeModal">
            <template #title>
                Create Category
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Category Name"
                                ref="name"
                                v-model="form.name"
                                @keyup.enter="create" />

                    <jet-input-error :message="form.errors.name" class="mt-2" />
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

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
    },

    data() {
        return {
            creatingCategory: false,

            form: this.$inertia.form({
                name: '',
            })
        }
    },

     methods: {
        createCategory() {
            this.creatingCategory = true;

            setTimeout(() => this.$refs.name.focus(), 250)
        },

        create() {
            this.form.post(route('categories.store'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.name.focus(),
                onFinish: () => this.form.reset(),
            })
        },

        closeModal() {
            this.creatingCategory = false

            this.form.reset()
        },
    },
}
</script>
