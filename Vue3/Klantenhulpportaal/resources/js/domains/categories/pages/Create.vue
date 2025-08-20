<template>
    <div class="create">
        <h1>Note toevoegen</h1>
        <Form :note="note" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { noteStore } from '../store';
import { ticketStore } from '../../tickets/store';
import { NoteForm } from '../types';
import Form from '../components/CategoryForm.vue';



const router = useRouter();
const route = useRoute();
const note = ref<NoteForm>({
    content: '',
});


const ticketId = computed(() => Number(route.params.ticketId));
ticketStore.actions.getById(ticketId.value);


const handleSubmit = async (data: NoteForm) => {
    await noteStore.extraActions.createForNote(ticketId.value, data);
    router.push({ name: 'tickets.view', params: { id: ticketId.value } });
};


</script>
