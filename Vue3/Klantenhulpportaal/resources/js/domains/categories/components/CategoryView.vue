<template>
    <div class="category-view">
        <RouterLink :to="{ name: 'categories.create' }" class="btn-create">
            Niewe categorie toevoegen
        </RouterLink>

        <h3>Categorieën</h3>

        <table v-if="categories.length > 0">
            <thead>
                <tr>
                    <th>Naam</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="category in categoriesSortedByName" :key="category.id">
                    <tr>
                        <td>{{ category.name }}</td>                       
                    </tr>
                    
                    <div class="category-action">
                        <RouterLink
                            :to="{ name: 'category.edit' }"
                            class="btn-edit">
                            Wijzig
                        </RouterLink>
                        <button class="btn btn-delete" @click="deleteCategory(category.id)">Delete</button>
                    </div>                    
                </template>

            </tbody>
        </table>        
    </div>

</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { Category } from '../types';
import { sortBy } from '../../../services/helpers/sortHelper';
import { categoryStore } from '../store';
import { useRoute } from 'vue-router';

const props = defineProps<{
    categories: Category[];
}>();

const route = useRoute();
const categoryId = computed(() => Number(route.params.id));


const deleteCategory = async (categoryId: number) => {
    if (confirm("Do you want to delete this note?")) {        
        categoryStore.actions.delete(categoryId);
    };
}

const categoriesSortedByName = computed<Readonly<Category>[]>(() =>
    sortBy(
        props.categories,
        (category: Category) => category.name,
        false
    )
);


</script>

<style scoped>
.notes-view {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

.no-notes {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #666;
    font-style: italic;
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
tbody tr.note-row:nth-child(4n-3) {
    background-color: #fafafa;
}

/* Hover effect voor klikbare rijen */
tbody tr.note-row:hover {
    background-color: #f0f8ff;
    cursor: pointer;
}

/* Titel styling */
h3 {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Note content styling */
.note-content-row {
    background-color: #f9f9f9 !important;
}

.note-content {
    background-color: #f9f9f9;
    padding: 1rem 0.75rem;
    white-space: wrap;
    font-size: 0.85rem;
    line-height: 1.4;
    border-left: 3px solid #ddd;
}


.expand-indicator {
    text-align: center;
    width: 30px;
    font-size: 0.8rem;
    color: #666;
}

.note-row .expand-indicator {
    transition: transform 0.2s ease;
}


.btn {
    display: inline-block;    
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* Create button */
.btn-create {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-bottom: 1rem;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-create:hover {
    background-color: #218838;
    transform: translateY(-1px);
}

.btn-create:active {
    background-color: #1e7e34;
    transform: translateY(0);
}

/* Delete button */
.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #c82333;
}

/* Edit button */
.btn-edit {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #007acc;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-edit:hover {
    background-color: #005fa3;
    transform: translateY(-1px);
}

.btn-edit:active {
    background-color: #004f8a;
    transform: translateY(0);
}

/* Button hover en focus effects */
.btn:hover, .btn-create:hover, .btn-edit:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}

.btn:active, .btn-create:active, .btn-edit:active {
    filter: brightness(0.9);
    transform: translateY(0);
}

.btn:focus, .btn-create:focus, .btn-edit:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}
</style>