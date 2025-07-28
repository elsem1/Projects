<template>
    <div class="edit">
        <h2>Ticket bewerken</h2>
        <Form v-if="ticket" :ticket="ticket" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { computed, onMounted } from 'vue';
import Form from '../components/TicketForm.vue'
import { useRoute, useRouter } from 'vue-router';
import { TicketStore } from '../store';
import { Ticket } from '../types'

const router = useRouter();
const route = useRoute();



const ticket = computed (() => TicketStore.getters.byId(Number(route.params.id)).value);

const handleSubmit = async (data: Ticket) => {
    await TicketStore.actions.update(Number(route.params.id), data);
    router.push({ name: 'tickets.overview' });
}

const ticketId = computed(() => Number(route.params.id));
TicketStore.actions.getById(ticketId.value);



</script>
