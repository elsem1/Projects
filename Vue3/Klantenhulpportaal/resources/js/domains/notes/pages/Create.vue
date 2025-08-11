<template>
    <div class="create">
        <h1>Note toevoegen</h1>
        <Form :note="note" @submit="handleSubmit" />        
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { NoteStore } from '../store';
import { Note, NoteForm } from '../types';
import Form from '../components/NoteForm.vue';

const router = useRouter();

const note = ref<NoteForm>({
    content: '',
});

const handleSubmit = async (data:NoteForm) => {
    await NoteStore.actions.create(data as unknown as Note)
    router.push({ name: 'ticket.overview' });
}


</script>