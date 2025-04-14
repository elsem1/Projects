<template>
    <div class="edit">
        <h2>Boek bewerken</h2>
        <Form v-if="book" :book="book" @submit="handleSubmit" />
        
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import Form from '../components/BookForm.vue';
import { useRouter, useRoute } from 'vue-router';
import { bookStore } from '../store';
import { Book } from '../../types';

const router = useRouter();
const route = useRoute(); 

const books = bookStore.getters.all;

const book = computed(() => bookStore.getters.byId(Number(route.params.id)).value);

const handleSubmit = async (data: Book) => {
    await bookStore.actions.update(Number(route.params.id), data);
    router.push({ name: 'books.overview' });
}

</script>
