<template>
    <div class="category-container">
        <RouterLink :to="{ name: 'categories.create' }" class="btn btn-create">
            Nieuwe categorie toevoegen
        </RouterLink>

        <h3>Categorieën</h3>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Naam</th>                        
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in sortedCategories" :key="category.id">
                        <td>{{ category.name }}</td>                        
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
    </div>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { Category } from '../types';
import { categoryStore } from '../store';
import { sortBy } from '../../../services/helpers/sortHelper';

const categories = computed(() => categoryStore.getters.all.value);

const sortedCategories = computed(() => 
    sortBy(categories.value, (category: Category) => category.name, false)
);

const deleteCategory = async (categoryId: number) => {
    if (confirm("Weet je zeker dat je deze categorie wilt verwijderen?")) {        
        await categoryStore.actions.delete(categoryId);
    }
};

onMounted(async () => {
    await categoryStore.actions.getAll();    
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

.btn-create {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background-color: #44d631;
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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