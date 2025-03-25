<template>
    <div class="create">
        <h1>Nieuw boek toevoegen</h1>
        <Form :book="book" @submit="handleSubmit" />

    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { useRouter } from 'vue-router';
import { createBook } from '../store';
import { Book } from '../types';

const router = useRouter();

const book = ref({
    title: '',
    publisher: '',
    year: '',
    genre: '',
    edition: '',
    summary: '',
});

const handleSubmit = async (data: Book) => {
    await createBook(data);
    router.push({ name: 'books.overview' });
}

</script>
