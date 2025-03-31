<template>
    <form @submit.prevent="handleSubmit">
        
        <label>Naam van de Auteur:</label>
        <input v-model="form.name" type="text" required />

        <label>Geboortedatum:</label>
        <input v-model="form.age" type="date" required placeholder="dd-mm-yyyy" pattern="\d{2}-\d{2}-\d{4}">        

        <button class="submit">Opslaan</button>
    </form>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { fetchAuthors, getAllAuthors } from '../../authors/store';

fetchAuthors();

const authors = getAllAuthors;

const props = defineProps({ author: Object });

const emit = defineEmits(['submit']);

const form = ref({ ...props.author });

const handleSubmit = () => emit('submit', form.value);
</script>