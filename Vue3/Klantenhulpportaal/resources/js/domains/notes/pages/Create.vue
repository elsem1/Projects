<template>
    <div class="create">
        <h1>Note toevoegen</h1>
        <Form :note="note" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { NoteStore } from '../store';
import { TicketStore } from '../../tickets/store';
import { Note, NoteForm } from '../types';
import Form from '../components/NoteForm.vue';
import http from '../../../services/http';


const router = useRouter();
const route = useRoute();
const note = ref<NoteForm>({
    content: '',
});

const ticketId = computed(() => Number(route.params.ticketId));
TicketStore.actions.getById(ticketId.value);

const handleSubmit = async (data: NoteForm) => {
    await NoteStore.extraActions.createForNote(ticketId.value, data);
    router.push({ name: 'ticket.overview' });
}


</script>