<template>
    <div class="overview">
        <h1>Hello Books!</h1>

        <!-- <thead>
            <th>Books</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year of publication</th>
            <th>Edition</th>
            <th>Publisher</th>
        </thead>
        <tbody>
            <tr v-for="book in books" :key="book.id">
                <td v-for="(value, key) in book" :key="key">
                    <template v-if="key === 'title'">
                        {{ value }}
                    </template>
                    <template v-if="key === 'author'">
                        {{ value }}
                    </template>
                </td>
            </tr>
        </tbody> -->

    </div>
</template>

<script setup>
import { fetchBooks } from '../store'
import { getAllBooks } from '../store'

const books = getAllBooks;
fetchBooks()
</script>
