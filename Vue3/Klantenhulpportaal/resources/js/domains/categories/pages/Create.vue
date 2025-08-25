<template>
    <div class="create">
        <h1>Categorie toevoegen</h1>
        <Form :category="category" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { categoryStore } from '../store';
import { CategoryForm } from '../types';
import Form from '../components/CategoryForm.vue';

const router = useRouter();

const category = ref<CategoryForm>({
    name: '',
    description: '',
});

const handleSubmit = async (data: CategoryForm) => {
    try {
        await categoryStore.actions.create(data);
        router.push({ name: 'categories.overview' });
    } catch (error) {
        console.error('Create error:', error);
    }
};
</script>

<style scoped>
.category-container {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

h1 {
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.btn-back {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: #6b7280;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 1rem;
    transition: filter 0.2s ease;
}

.btn-back:hover {
    filter: brightness(1.1);
}
</style>