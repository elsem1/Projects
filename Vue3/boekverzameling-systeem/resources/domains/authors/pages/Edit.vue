<template>
    <div class="edit">
        <h1>Autheur bewerken</h1>
        <Form v-if="author" :author="author" @submit="handleSubmit" />
    </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';
import Form from '../components/AuthorForm.vue';
import { useRouter, useRoute } from 'vue-router';
import { updateAuthor, fetchAuthors, getAuthorById, getAllAuthors } from '../store';
import { Author } from '../../types';

const router = useRouter();
const route = useRoute();
const allAuthors = getAllAuthors;
const author = getAuthorById(Number(route.params.id));

// Haal auteurs op tijdens component mounting, niet bij elke re-render
onMounted(async () => {
    // Alleen ophalen als we nog geen auteurs hebben
    if (allAuthors.value.length === 0) {
        await fetchAuthors();
    }
});

const handleSubmit = async (data: Author) => {
    await updateAuthor(Number(route.params.id), data);
    router.push({ name: 'authors.overview' });
}
</script>