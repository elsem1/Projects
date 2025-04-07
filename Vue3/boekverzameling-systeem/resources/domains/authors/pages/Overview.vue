<template>
    
        <h1>Hello Authors!</h1>
        
            <table>
                <thead>
                    <tr>
                        <th>Name of the Author</th>
                        <th>Date of Birth  </th>
                        <th>Books written</th>
                        <th>Acties</th>
                    </tr>

                </thead>
                <tbody>
                    <tr v-for="author in authors" :key="author.id">
                        <td>{{ author.name }}</td>
                        <td>{{ author.age }}</td>
                        <td>{{ author.books_count }}</td>
                        <td>
                            <RouterLink :to="{ name: 'authors.edit', params: { id: author.id } }">Bewerk </RouterLink>
                            <button @click="deleteAuthor(author.id)">Verwijder</button>
                        </td>

                    </tr>
                </tbody>
            </table>
    
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { fetchAuthors, getAllAuthors, deleteAuthor } from '../store'

const authors = getAllAuthors;

fetchAuthors()


</script>

<style scoped></style>
