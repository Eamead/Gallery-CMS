<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Categories</h1>
        <ul>
            <li v-for="category in categories" :key="category.id" class="flex justify-between items-center">
                <span>{{ category.name }}</span>
            </li>
        </ul>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            newCategory: {
                name: '',
                description: '',
            },
            isAdmin: false,
        };
    },
    methods: {
        fetchCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data;
            });
        },
    },
    mounted() {
        this.fetchCategories();
    },
};
</script>
