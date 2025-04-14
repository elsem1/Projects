<template>
    
        <h1>Hello Books!</h1>

        
            <table>
                <thead>
                    <tr>
                        <th>Books</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Publication year</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" :key="book.id">
                        <td>{{ book.title }}</td>
                        <td>{{ authorStore.getters.byId(book.author_id).value?.name }}</td>
                        <td>{{ book.genre }}</td>
                        <td>{{ book.year }}</td>
                        <td>{{ book.edition }}</td>
                        <td>{{ book.publisher }}</td>
                        <td>
                            <RouterLink :to="{ name: 'books.edit', params: { id: book.id } }">Bewerk  </RouterLink>
                            <button @click="bookStore.actions.delete(book.id)">Verwijder</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        

    
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue';
import { bookStore } from '../store'
import { authorStore } from '../../authors/store';


const books = computed(() => bookStore.getters.all.value)
const authors = computed(() => authorStore.getters.all.value)


</script>
