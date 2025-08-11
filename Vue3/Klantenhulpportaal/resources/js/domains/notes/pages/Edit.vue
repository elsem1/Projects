<template>
    <div class="edit">
        <h1>Note bewerken</h1>        
        <Form v-if="note" :note="note" :ticket-id="ticketId" @submit="handleSubmit" />
        <div v-else>Note wordt geladen...</div>   
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { NoteStore } from '../store';
import { Note, NoteForm } from '../types';
import Form from '../components/NoteForm.vue';
import { TicketStore } from '../../tickets/store';
import http from '../../../services/http';

const router = useRouter();
const route = useRoute();

const ticketId = computed(() => Number(route.params.ticketId));
const noteId = computed(() => Number(route.params.noteId));
TicketStore.actions.getById(ticketId.value);

const note = computed(() => {
    const ticket = TicketStore.getters.byId(ticketId.value).value;
    if (!ticket || !ticket.notes) return null;
    return ticket.notes.find(note => note.id === noteId.value) || null;
});

onMounted(async () => {
    TicketStore.actions.getById(ticketId.value);
})

const handleSubmit = async (data: Note) => {
    try {
        await http.put(
            `/tickets/${ticketId.value}/notes/${noteId.value}`, 
            data
        );
        router.push({ 
            name: 'tickets.view', 
            params: { id: ticketId.value } 
        });
    } catch (error) {
        console.error('Update error:', error);        
    }
}


</script>
