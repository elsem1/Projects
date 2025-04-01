<template>
    <form @submit.prevent="handleSubmit">

        <label>Naam van de Auteur:</label>
        <input v-model="authorData.name" type="text" required />

        <label>Geboortedatum:</label>
        <input v-model="authorData.age" type="text" required placeholder="dd-mm-yyyy" pattern="\d{2}-\d{2}-\d{4}">

        <button class="submit">Opslaan</button>
    </form>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { fetchAuthors } from '../../authors/store';

fetchAuthors();

const props = defineProps({ author: Object });

const emit = defineEmits(['submit']);

const authorData = ref({ ...props.author });

const handleSubmit = () => emit('submit', authorData.value);
</script>