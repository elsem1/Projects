<template>

    <h2>{{ book.value.title }} by {{ book.value.author?.name }} </h2>

    <p>
        Published by {{ book.value.publisher }} in {{ book.value.year }},
        {{ book.value.edition }}<span v-if="book.value.edition === 1">st</span>
        <span v-else-if="book.value.edition === 2">nd</span>
        <span v-else-if="book.value.edition === 3">rd</span>
        <span v-else-if="book.value.edition">th</span>
        <span> edition</span>
    </p>
    <p>It falls under the {{ book.value.genre }} genre</p>
    <p>Here's a summary:</p>
    <p>{{ book.value.summary }}</p>
    <Box :bookId="Number(route.params.id)"/>




</template>

<script setup lang="ts">
import { bookStore } from '../store'
import { Book } from '../../types';
import { useRoute, useRouter } from 'vue-router';
import { computed } from 'vue';
import Box from '../../reviews/components/ReviewBox.vue';

const route = useRoute();
const routes = useRouter();
const book = computed(() => bookStore.getters.byId(Number(route.params.id)));


bookStore.actions.getAll()

</script>