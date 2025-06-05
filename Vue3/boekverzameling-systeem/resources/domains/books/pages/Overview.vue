<template>
    <div class="books-overview">
        <h1 class="page-title">Hello Books!</h1>

        <ErrorMessage />
        <table class="books-table">
            <thead>
                <tr>
                    <th>Books</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication year</th>
                    <th>Edition</th>
                    <th>Publisher</th>
                    <th>Actions</th>
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
                    <td class="actions">
                        <RouterLink :to="{ name: 'books.edit', params: { id: book.id } }">Edit</RouterLink>                        
                        <button @click="confirmDeletion(book.id)">Delete</button>
                        <RouterLink :to="{ name: 'books.view', params: { id: book.id } }">View</RouterLink>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { bookStore } from '../store'
import { authorStore } from '../../authors/store';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';

onMounted(() => {
    bookStore.actions.getAll();
    bookStore.genreActions.fetchGenres();
    authorStore.actions.getAll();
});
const books = bookStore.getters.all

const confirmDeletion = async (book: { id: number, title: string }) => {
    if (confirm('Weet je zeker dat je het boek `${book.title}` wilt verwijderen?')) {
        bookStore.actions.delete(book.id);
    }
};
</script>

<style scoped>
.books-overview {
    font-family: sans-serif;
    line-height: 1;
}

.page-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.books-table {
    width: 100%;
    border-collapse: collapse;
}

.books-table th {
    text-align: left;
    font-weight: bold;
    padding: 0.5rem;
    border-bottom: 1px solid #ddd;
}

.books-table td {
    padding: 0.5rem;
    border-bottom: 1px solid #ddd;
}

.books-table tr:last-child td {
    border-bottom: none;
}

.actions {
    white-space: nowrap;
}

.actions a, .actions button {
    margin-right: 0.5rem;
    text-decoration: none;
    background: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
    font-size: inherit;
    padding: 0;
}

.actions a:last-child, .actions button:last-child {
    margin-right: 0;
}
</style>