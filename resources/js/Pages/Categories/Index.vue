<template>
    <Head title="Categories" />

    <GuestLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <ul role="list" class="divide-y divide-gray-100">
                        <li
                            v-for="category in categories"
                            :key="category.id"
                            class="flex justify-between gap-x-6 py-5 px-5"
                        >
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p
                                        class="text-sm font-semibold text-gray-900"
                                    >
                                        {{ category.name }}
                                    </p>
                                    <p
                                        class="mt-1 truncate text-xs text-gray-500"
                                    >
                                        {{ category.description }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Floating Button -->
        <button
            @click="openModal"
            class="fixed bottom-6 right-6 bg-blue-500 text-white rounded-full p-4 shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 px-6"
            aria-label="Create New Category"
        >
            +
        </button>

        <!-- Modal -->
        <div
            v-if="isModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-11/12 max-w-md p-6 relative"
            >
                <button
                    @click="closeModal"
                    class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none"
                    aria-label="Close Modal"
                >
                    &times;
                </button>
                <h2 class="text-xl font-semibold mb-4">Create New Category</h2>
                <form @submit.prevent="createCategory">
                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="Category Name"
                        class="border p-2 mb-2 w-full rounded"
                        required
                    />
                    <textarea
                        v-model="form.description"
                        placeholder="Description"
                        class="border p-2 mb-2 w-full rounded"
                    ></textarea>
                    <button
                        type="submit"
                        class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600"
                    >
                        Create
                    </button>
                </form>

                <div
                    v-if="form.errors.name || form.errors.description"
                    class="text-red-500 mt-2"
                >
                    <ul>
                        <li v-if="form.errors.name">{{ form.errors.name }}</li>
                        <li v-if="form.errors.description">
                            {{ form.errors.description }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    components: { GuestLayout, Head },
    props: {
        categories: Array,
        isAdmin: Boolean,
    },
    setup() {
        const form = useForm({
            name: "",
            description: "",
        });

        const isModalOpen = ref(false);

        const openModal = () => {
            isModalOpen.value = true;
        };

        const closeModal = () => {
            isModalOpen.value = false;
            form.reset();
        };

        const createCategory = () => {
            form.post(route("categories.store"), {
                onSuccess: () => {
                    form.reset();
                    isModalOpen.value = false;
                },
            });
        };

        return {
            form,
            isModalOpen,
            openModal,
            closeModal,
            createCategory,
        };
    },
};
</script>

<style scoped>
.fixed {
    transition: opacity 0.3s ease;
}
</style>
