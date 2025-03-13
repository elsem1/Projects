<script setup>
import {RouterLink} from 'vue-router';
import bookOverview from '../domains/books/pages/Overview.vue';
</script>

<template>
    <div id="nav">
        <nav> |
            <RouterLink to="/">Home</RouterLink> |
            <RouterLink to="/create">Toevoegen</RouterLink> |
        </nav>

        <RouterView />
    </div>

</template>

<style scoped></style>
