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
import { noteStore } from '../store';
import { Note, NoteForm } from '../types';
import Form from '../components/CategoryForm.vue';
import { ticketStore } from '../../tickets/store';



const router = useRouter();
const route = useRoute();

const ticketId = computed(() => Number(route.params.ticketId));
const noteId = computed(() => Number(route.params.noteId));
ticketStore.actions.getById(ticketId.value);

const note = computed(() => {
    const ticket = ticketStore.getters.byId(ticketId.value).value;
    if (!ticket || !ticket.notes) return null;
    return ticket.notes.find(note => note.id === noteId.value) || null;
});

onMounted(async () => {
    ticketStore.actions.getById(ticketId.value);
})

const handleSubmit = async (data: Note) => {
    try {
        await noteStore.extraActions.updateForNote(ticketId.value, noteId.value, data);
        router.push({ name: 'tickets.view', params: { id: ticketId.value } });
    } catch (error) {
        console.error('Update error:', error);
    }
}


</script>
