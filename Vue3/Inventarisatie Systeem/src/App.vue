<script setup>
import { RouterLink } from 'vue-router';

</script>

<template>
    <div id="nav">
        <nav>
            <RouterLink to="/">Home</RouterLink>
            |
            <RouterLink to="/create">Toevoegen</RouterLink>
            |
            <RouterLink to="/bestellen">Bestel</RouterLink>
            |

        </nav>
        <RouterView />
    </div>
</template>

<style scoped></style>
