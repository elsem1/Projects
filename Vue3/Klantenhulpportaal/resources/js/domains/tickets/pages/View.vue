<template>
    <div v-if="ticket">
        <h3>Ticket Detail</h3>

        <section>
            <h2>{{ ticket.title }}</h2>

            <ul>
                <li><strong>Ticket id:</strong> {{ ticket.id }}</li>

                <li><strong>Categorieën:</strong>
                    <span v-for="(category, index) in ticket.category_details" :key="category.id">
                        {{ category.name }}<span v-if="index < ticket.categories.length - 1">, </span>
                    </span>
                </li>

                <li><strong>Status:</strong> {{ ticket.status_name }}</li>
                <li><strong>Aangemaakt door:</strong> {{ ticket.creator.first_name }}
                    {{ ticket.creator.last_name }}</li>
                <li><strong>Aangemaakt op:</strong> {{ ticket.created_at }}</li>
                <li><strong>Laatste update op:</strong> {{ ticket.updated_at }}</li>
                <li><strong>Toegewezen aan:</strong> {{ ticket.handler?.first_name ?? '-' }}
                    {{ ticket.handler?.last_name ?? '' }}</li>
                <li><strong>Uitleg:</strong> {{ ticket.content }}</li>

            </ul>
        </section>
        <RouterLink :to="{ name: 'tickets.edit', params: { id: ticket.id } }" class="btn-edit">
            Wijzig
        </RouterLink>
    </div>
    <div class="notes mt-8">
        <NotesView :notes="notes" />
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
import { TicketStore } from '../store';
import { computed, onMounted, ref } from 'vue';
import NotesView from '../../notes/components/NotesView.vue';
import { NoteStore } from '../../notes/store';



const route = useRoute();
const ticketId = computed(() => Number(route.params.id));

const ticket = TicketStore.getters.byId(ticketId.value);
const notes = computed(() => ticket?.notes || [])

onMounted(async () => {
    await TicketStore.actions.getById(ticketId.value);

});





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

.btn-edit {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #007acc;
    /* Zachte blauwe kleur */
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-edit:hover {
    background-color: #005fa3;
    /* Donkerder blauw bij hover */
    transform: translateY(-1px);
}

.btn-edit:active {
    background-color: #004f8a;
    /* Nog donkerder bij klik */
    transform: translateY(0);
}

.btn-edit:focus {
    outline: 2px solid #80bfff;
    /* Subtiele focus ring */
    outline-offset: 2px;
}
</style>