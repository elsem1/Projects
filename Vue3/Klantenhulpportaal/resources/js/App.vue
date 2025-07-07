<template>
    <nav>
        <RouterLink to="/">Home | </RouterLink>
        <RouterLink to="/tickets">Tickets</RouterLink>
    </nav>

    <Layout />
</template>

<script setup lang="ts">
import Layout from '../js/layouts/DefaultLayout.vue'
</script>
