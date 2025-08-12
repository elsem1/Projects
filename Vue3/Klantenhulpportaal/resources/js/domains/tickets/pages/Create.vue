<template>
    <div class="create">
        <h1>Nieuwe ticket aanmaken</h1>
        <Form :ticket="ticket" @submit="handleSubmit" />

    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import Form from '../components/TicketForm.vue';
import { useRouter } from 'vue-router';
import { TicketStore } from '../store';
import { TicketForm, Ticket } from '../types';


const router = useRouter();

const ticket = ref<TicketForm>({
    title: '',
    content: '',
    status_id: 1,
    categories: [],
});

const handleSubmit = async (data: TicketForm) => {
    await TicketStore.actions.create(data as unknown as Ticket);
    router.push({ name: 'tickets.overview' });
};


</script>