<template>
    <div class="category-container">        
        <h3>Categorie Details</h3>
        <div v-if="!category" class="loading">
            Categorie niet gevonden of aan het laden...
        </div>
        <table v-else>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ category.name }}</td>
                    <td>{{ category.description }}</td>
                    <td class="category-action">
                        <RouterLink
                            :to="{ name: 'categories.edit', params: { categoryId: category.id } }"
                            class="btn btn-edit">
                            Wijzig
                        </RouterLink>
                        <button class="btn btn-delete" @click="deleteCategory(category.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { categoryStore } from '../store';

const route = useRoute();


const categoryId = computed(() => Number(route.params.categoryId));

const category = computed(() => {
    return categoryStore.getters.byId(categoryId.value).value;
});

const deleteCategory = async (id: number) => {
    try {
        await categoryStore.actions.delete(id);        
    } catch (error) {
        console.error('Error deleting category:', error);
    }
};

onMounted(async () => {
    await categoryStore.actions.getById(categoryId.value);
});
</script>

<style scoped>
.category-container {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
    position: relative;
}

/* Tabel basisstijl */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.9rem;
}

/* Headerstijl */
thead th {
    background-color: #f4f4f4;
    text-align: left;
    padding: 0.5rem 0.75rem;
    border-bottom: 2px solid #ddd;
}

/* Cell padding en border */
tbody td {
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #eee;
}

/* Wisselende rij-kleur voor leesbaarheid */
tbody tr:nth-child(even) {
    background-color: #fafafa;
}

/* Hover effect voor rijen */
tbody tr:hover {
    background-color: #f0f8ff;
}

/* Titel styling */
h3 {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-family: Arial, sans-serif;
    font-size: 0.95rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-right: 0.5rem;
    transition: filter 0.2s ease, transform 0.1s ease;
}

.btn-back {
    background-color: #6b7280;
    color: white;
    margin-bottom: 1rem;
    text-decoration: none;
}

.btn-edit {
    background-color: #4c7df5;
    color: white;
    text-decoration: none;
}

.btn-delete {
    background-color: #f56565;
    color: white;
}

.btn:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}

.btn:active {
    filter: brightness(0.9);
    transform: translateY(0);
}

.btn:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}

.category-action {
    display: flex;
    gap: 0.5rem;
}
</style>