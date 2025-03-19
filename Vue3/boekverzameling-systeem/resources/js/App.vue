<script setup>
import {RouterLink} from 'vue-router';
import bookOverview from '../domains/books/pages/Overview.vue';
</script>

<template>
    <div id="nav">
        <nav> |
            <RouterLink :to="{ name: 'home'}">Home</RouterLink> |
            <RouterLink :to="{ name: 'books.create'}">Toevoegen</RouterLink> |
            <RouterLink :to="{ name: 'authors.overview' }">Authors</RouterLink> |
            <RouterLink :to="{ name: 'reviews.overview' }">Reviews</RouterLink> |
        </nav>

        <RouterView />
    </div>

</template>

<style scoped></style>
