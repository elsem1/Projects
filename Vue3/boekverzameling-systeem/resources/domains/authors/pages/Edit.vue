<template>
    <div class="edit">
        <h1>Autheur bewerken</h1>
        <Form v-if="author" :author="author" @submit="handleSubmit" />
    </div>
</template>
<script setup lang="ts">
import Form from '../components/AuthorForm.vue';
import { useRouter, useRoute } from 'vue-router';
import { authorStore } from '../store';
import { Author } from '../../types';

const router = useRouter();
const route = useRoute();
const allAuthors = authorStore.getters.all;
const author = authorStore.getters.byId(Number(route.params.id));

const handleSubmit = async (data: Author) => {
    await authorStore.actions.update(Number(route.params.id), data);
    router.push({ name: 'authors.overview' });
}
</script>