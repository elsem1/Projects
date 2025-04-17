<template>

    <ErrorMessage />

    <form @submit.prevent="handleSubmit">

        <div>
            <label>Titel:</label>
            <input v-model="form.title" type="text" />
            <ErrorForm name="title" />
        </div>

        <div>
            <label>Samenvatting:</label>
            <textarea v-model="form.summary" />
            <ErrorForm name="summary" />
        </div>

        <div>
            <label>Auteur:</label>
            <select v-model="form.author">
                <option v-for="author in authors" :key="author.id" :value="author.id">
                    {{ author.name }}
                </option>
            </select>
            <ErrorForm name="author" />
        </div>

        <div>
            <label>Publisher:</label>
            <input v-model="form.publisher" type="text" />
            <ErrorForm name="publisher" />
        </div>

        <div>
            <label>Jaar van uitgifte:</label>
            <input v-model="form.year" type="number" min="1900" max="2025" />
            <ErrorForm name="year" />
        </div>

        <div>
            <label>Genre:</label>
            <select v-model="form.genre">
                <option v-for="genre in genreData" :key="genre.id" >
                    {{ genre.name }}
                </option>
            </select>
            <ErrorForm name="genre" />
        </div>

        <div>
            <label>Edition:</label>
            <input v-model="form.edition" type="number" min="1" max="10" />
        </div>
        <ErrorForm name="edition" />

        <button class="submit">Opslaan</button>
    </form>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { authorStore } from '../../authors/store';
import { bookStore } from '../store';
import { getMessage } from '../../../js/services/error';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';
import ErrorForm from '../../../js/services/error/ErrorForm.vue';


const props = defineProps({ book: Object });

const genreData = bookStore.genreGetters.genres;
const authors = authorStore.getters.all;

const emit = defineEmits(['submit']);
const form = ref({ ...props.book });

const handleSubmit = () => emit('submit', form.value);
</script>