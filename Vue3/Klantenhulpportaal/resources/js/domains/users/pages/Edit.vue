<template>
    <div class="edit">
        <h1>Categorie bewerken</h1>
        <div v-if="loading">Loading...</div>
        <Form v-else-if="categoryData" :category="categoryData" @submit="handleSubmit" />
        <div v-else-if="error" class="error">{{ error }}</div>
        <div v-else class="not-found">Categorie niet gevonden</div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { categoryStore } from '../store';
import { CategoryForm } from '../types';
import Form from '../components/CategoryForm.vue';

const router = useRouter();
const route = useRoute();
const loading = ref(true);
const error = ref<string | null>(null);

const categoryId = computed(() => Number(route.params.categoryId));

// Haal category data op voor het formulier
const category = computed(() => categoryStore.getters.byId(categoryId.value).value);

// Prepare form data
const categoryData = computed(() => {
    if (!category.value) return null;
    return {
        name: category.value.name,
        description: category.value.description || ''
    };
});

onMounted(async () => {
    try {
        loading.value = true;
        error.value = null;        
        await categoryStore.actions.getById(categoryId.value);
        
        // Wacht even om zeker te zijn dat de store is bijgewerkt
        setTimeout(() => {           
            loading.value = false;
        }, 100);        
    } catch (err) {
        error.value = 'Fout bij laden categorie';
        console.error('Error loading category:', err);
        loading.value = false;
    }
});

const handleSubmit = async (data: CategoryForm) => {
    try {
        await categoryStore.actions.update(categoryId.value, data);
        router.push({ name: 'categories.overview' });
    } catch (err) {
        error.value = 'Fout bij bijwerken categorie';
        console.error('Update error:', err);
    }
}
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