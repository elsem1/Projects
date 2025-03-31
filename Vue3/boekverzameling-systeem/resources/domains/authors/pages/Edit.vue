<template>
    <div class="edit">
        <h1>Autheur bewerken</h1>
        <Form v-if="author" :author="author" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import Form from '../components/AuthorForm.vue';
import { useRouter, useRoute } from 'vue-router';
import { updateAuthor, fetchAuthors, getAuthorById } from '../store';
import { Author } from '../../types';

const router = useRouter();
const route = useRoute();

fetchAuthors();

const author = computed(() => getAuthorById(Number(route.params.id)).value);

console.log(author)

const handleSubmit = async (data: Author) => {
    await updateAuthor(Number(route.params.id), data);
    router.push({ name: 'author.overview' });
}

</script>
