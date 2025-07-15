<template>
    <div v-if="ticket">
        <title>Ticket Detail</title>

        <section>
            <h2>{{ ticket.title }}</h2>

            <ul>
                <li><strong>Ticket id:</strong> {{ ticket.id }}</li>
                <li><strong>Categorieën:</strong>
                    <span v-for="(category, index) in ticket.categories" :key="category.id">
                        {{ category.name }}<span v-if="index < ticket.categories.length - 1">, </span>
                    </span>
                </li>
                <li><strong>Status:</strong> {{ ticket.status_name }}</li>
                <li><strong>Aangemaakt door:</strong> {{ ticket.creator.first_name }} {{
                    ticket.creator.last_name }}</li>
                <li><strong>Aangemaakt op:</strong> {{ ticket.created_at }}</li>
                <li><strong>Laatste update op:</strong> {{ ticket.updated_at }}</li>
                <li><strong>Toegewezen aan:</strong> {{ ticket.handler?.first_name ?? '-' }} {{
                    ticket.handler?.last_name ?? '' }}</li>
                <li><strong>Uitleg:</strong> {{ ticket.content }}</li>

            </ul>
        </section>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
import { ticketStore } from '../store';
import { computed, onMounted } from 'vue';


const route = useRoute();
const ticketId = computed(() => Number(route.params.id));

onMounted(() => {
    ticketStore.actions.getById(ticketId.value);
});
const ticket = ticketStore.getters.byId(ticketId.value);




</script>
<style scoped>
div {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

section {
    margin-top: 1rem;
    font-size: 0.9rem;
}

h2 {
    margin-bottom: 1rem;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 0.5rem;
}

strong {
    width: 140px;
    display: inline-block;
    color: #555;
}
</style>