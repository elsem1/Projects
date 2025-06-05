<template>
    <div class="book-detail">
        <div v-if="book.value" class="book-content">
            <h1 class="book-title">{{ book.value.title }}</h1>
            <p class="book-author">by {{ book.value.author?.name }}</p>
            
            <div class="book-meta">
                <p>
                    <span class="meta-label">Published:</span> 
                    {{ book.value.publisher }}, {{ book.value.year }}
                </p>
                <p v-if="book.value.edition">
                    <span class="meta-label">Edition:</span> 
                    {{ book.value.edition }}<sup>{{ getEditionSuffix(book.value.edition) }}</sup>
                </p>
                <p>
                    <span class="meta-label">Genre:</span> 
                    {{ book.value.genre }}
                </p>
            </div>
            
            <div class="book-summary">
                <h2 class="summary-title">Summary</h2>
                <p class="summary-text">{{ book.value.summary }}</p>
            </div>
            
            <Box :bookId="bookId" class="reviews-section" />
        </div>
        
        <div v-else class="loading">
            <p>Loading book details...</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { bookStore } from '../store'
import { useRoute } from 'vue-router';
import { computed, onMounted } from 'vue';
import Box from '../../reviews/components/ReviewBox.vue';

const route = useRoute();
const bookId = computed(() => Number(route.params.id));
const book = computed(() => bookStore.getters.byId(bookId.value));

const getEditionSuffix = (edition: number) => {
    if (edition === 1) return 'st';
    if (edition === 2) return 'nd';
    if (edition === 3) return 'rd';
    return 'th';
};

onMounted(async () => {
    await bookStore.actions.getAll();
});
</script>

<style scoped>
.book-detail {
    font-family: sans-serif;
    line-height: 1.5;
}

.book-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.book-author {
    font-style: italic;
    margin-bottom: 1rem;
}

.book-meta p {
    margin: 0.25rem 0;
}

.meta-label {
    font-weight: bold;
}

.summary-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin: 1rem 0 0.5rem 0;
}

.summary-text {
    margin: 0;
}

.loading {
    font-style: italic;
}
</style>