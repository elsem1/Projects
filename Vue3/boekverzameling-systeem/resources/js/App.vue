<script setup lang="ts">
import { RouterLink } from 'vue-router';


</script>

<template>
    <div id="nav">
        <nav>
            <RouterLink :to="{ name: 'home' }">Home</RouterLink> |
            <RouterLink :to="{ name: 'books.create' }">Nieuw boek toevoegen</RouterLink> |
            <RouterLink :to="{ name: 'authors.overview' }">Authors</RouterLink> |
            <RouterLink :to="{ name: 'authors.create' }">Nieuwe auteur toevoegen</RouterLink> |
            
        </nav>

        <RouterView />
    </div>

</template>

<style scoped></style>
