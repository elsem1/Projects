<template>
     <h1>Hello Authors!</h1>

     <thead>
            <th>Name of the Author</th>
            <th>Date of Birth</th>
            <th>Number of books written</th>
            
        </thead>
        <tbody>
            <tr v-for="author in authors" :key="author.id">
                <td>{{ author.name }}</td>
                <td>{{ author.age }}</td>              
                <!-- <td>Iets in de controller maken om het aantal boeken van de auteur te weergeven</td> -->
                
            </tr>


        </tbody>

</template>

<script setup>
import { fetchAuthors, getAllAuthors } from '../store'

const authors = getAllAuthors;

fetchAuthors()

</script>

<style scoped>
</style>
