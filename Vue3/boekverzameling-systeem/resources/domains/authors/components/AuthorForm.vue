<template>
    <ErrorMessage />
    <!-- <div v-if="getMessage">
        {{ getMessage }}
    </div> -->
    <form @submit.prevent="handleSubmit">

        <div>
            <label>Naam van de Auteur:</label>
            <input v-model="authorData.name" type="text" />
            <ErrorForm name="name" />
        </div>

        <div>
            <label>Geboortedatum:</label>
            <input v-model="authorData.age" type="text" placeholder="dd-mm-yyyy" pattern="\d{2}-\d{2}-\d{4}">
            <ErrorForm name="age" />
        </div>

        <button class="submit">Opslaan</button>
    </form>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from 'vue';
import ErrorForm from '../../../js/services/error/ErrorForm.vue';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';

const props = defineProps({ author: Object });

const emit = defineEmits(['submit']);

const authorData = ref({ ...props.author });

const handleSubmit = () => emit('submit', authorData.value);
</script>