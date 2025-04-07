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
                        <td>{{ getAuthorById(book.author_id).value?.name }}</td>
                        <td>{{ book.genre }}</td>
                        <td>{{ book.year }}</td>
                        <td>{{ book.edition }}</td>
                        <td>{{ book.publisher }}</td>
                        <td>
                            <RouterLink :to="{ name: 'books.edit', params: { id: book.id } }">Bewerk  </RouterLink>
                            <button @click="deleteBook(book.id)">Verwijder</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        

    
</template>

<script setup lang="ts">

import { getAllBooks, fetchBooks, deleteBook } from '../store'
import { fetchAuthors, getAuthorById } from '../../authors/store'
import { onMounted } from 'vue';

const books = getAllBooks;

fetchBooks()
fetchAuthors()

</script>
