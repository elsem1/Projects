<template>
    <div class="create">
        <h1>Nieuwe ticket aanmaken</h1>
        <Form :ticket="ticket" @submit="handleSubmit" />

    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/TicketForm.vue';
import { useRouter } from 'vue-router';
import { ticketStore } from '../store';
import { Ticket } from '../types';

const router = useRouter();

const ticket = ref<{
    title: string;
    categories: number[]; 
    status_id: number;
    content: string;
}>({
    title: "",
    categories: [],
    status_id: 1,
    content: "",
});

const handleSubmit = async (data: Ticket) => {
    await ticketStore.actions.create(data);
    router.push({ name: 'tickets.overview' });
}

</script>