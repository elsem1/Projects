<template>
    
        <h1>Hello Authors!</h1>
        
            <table>
                <thead>
                    <tr>
                        <th>Name of the Author</th>
                        <th>Date of Birth</th>
                        <th>Number of books written</th>
                    </tr>

                </thead>
                <tbody>
                    <tr v-for="author in authors" :key="author.id">
                        <td>{{ author.name }}</td>
                        <td>{{ author.age }}</td>
                        <td><!-- <td>Iets in de controller maken om het aantal boeken van de auteur te weergeven</td> -->
                        </td>
                        <td>
                            <RouterLink :to="{ name: 'authors.edit', params: { id: author.id } }">Bewerk </RouterLink>
                            <button @click="deleteAuthor(author.id)">Verwijder</button>
                        </td>

                    </tr>
                </tbody>
            </table>
    
</template>

<script setup>
import { onMounted } from 'vue';
import { fetchAuthors, getAllAuthors, deleteAuthor } from '../store'

const authors = getAllAuthors;

fetchAuthors()


</script>

<style scoped></style>
