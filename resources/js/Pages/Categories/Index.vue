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
                                    <p class="text-sm/6 font-semibold text-gray-900">{{ category.name }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ category.description }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </GuestLayout>
</template>

<script>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    components: {GuestLayout, AuthenticatedLayout, Head},
    props: {
        categories: Array,
    },
    data() {
        return {
            form: {
                name: '',
                description: '',
            },
            errors: [],
        };
    },
};
</script>