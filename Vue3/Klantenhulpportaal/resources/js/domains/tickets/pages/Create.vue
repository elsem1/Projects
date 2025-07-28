<template>
    <div class="create">
        <h1>Nieuwe ticket aanmaken</h1>
        <Form :ticket="ticket" @submit="handleSubmit" />

    </div>
</template>

<script setup lang="ts">
import { New } from '../../../services/store/types';
import { ref, computed } from 'vue';
import Form from '../components/TicketForm.vue';
import { useRouter } from 'vue-router';
import { TicketStore } from '../store';
import { Ticket, User } from '../types';

const router = useRouter();

const ticket = ref<Ticket>({
    title: "",
    category_ids: [],
    status_id: 0,
    content: "",
    id: 1,    
    status_name: "Open",    
    creator: 1,        
    handler: 1, 
    created_at: "",
    created_at_raw: "",
    updated_at: "",
    updated_at_raw: "",
});

const handleSubmit = async (data: Ticket) => {
    await TicketStore.actions.create(data);
    router.push({ name: 'tickets.overview' });
}


</script>