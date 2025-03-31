<template>
    <div class="create">
        <h1>Een nieuwe auteur toevoegen!</h1>
        <Form :author="author" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/AuthorForm.vue';
import { useRouter } from 'vue-router';
import { createAuthor } from '../store';
import { Author } from '../../types';

const router = useRouter();

const author = ref({
    name: '',
    age: '',
    
});

const handleSubmit = async (data: Author) => {
    await createAuthor(data);
    router.push({ name: 'author.overview' });
}

</script>
