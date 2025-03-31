<template>
    <form @submit.prevent="handleSubmit">


        <label>Titel:</label>
        <input v-model="form.title" type="text" required />

        <label>Samenvatting:</label>
        <textarea v-model="form.summary" required></textarea>

        <label>Auteur:</label>
        <select v-model="form.author_id">
            <option v-for="author in authors" :key="author.id" :value="author.id">
                {{ author.name }}
            </option>
        </select>

        <label>Publisher:</label>
        <input v-model="form.publisher" type="text" required />

        <label>Jaar van uitgifte:</label>
        <input v-model="form.year" type="number" min="1900" max="2025" required />

        <label>Genre:</label>
        <select v-model="form.genre" required>
            <option v-for="genre in getGenres" :key="genre.id" :value="genre.name">
                {{ genre.name }}
            </option>
        </select>

        <label>Edition:</label>
        <input v-model="form.edition" type="number" min="1" max="10" required />

        <button class="submit">Opslaan</button>
    </form>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { fetchAuthors, getAllAuthors } from '../../authors/store';
import { fetchGenres, getGenres } from '../store';



fetchAuthors();
fetchGenres();

const authors = getAllAuthors;

const props = defineProps({ book: Object });

const emit = defineEmits(['submit']);

const form = ref({ ...props.book });

const handleSubmit = () => emit('submit', form.value);
</script>