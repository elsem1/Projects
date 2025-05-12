<template>
    <div>
        <h2>Reviews for this book</h2>    
        
        <div v-for="review in bookReviews" :key="review.id">
            <p>{{ review.review }}</p>
            <p>Rating: {{ review.rating }}/5</p>
            <p>by {{ authorStore.getters.byId(review.user_id).value?.name }} 
                <button @click="loadReviewForEditing(review)">Bewerk</button>
                <button @click="handleDelete(review.id)">Verwijder</button>
            </p>
        </div>
        
        <Form 
            :bookId="bookId"
            :editingReview="currentReview"
            @submit="handleSubmit"
            @cancel-edit="cancelEdit" 
        />
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import Form from '../components/ReviewForm.vue';
import { reviewStore } from '../store';
import type { Review } from '../../types';
import { useRouter, useRoute } from 'vue-router';
import { authorStore } from '../../authors/store';

const router = useRouter();
const route = useRoute();

// Typed refs
const currentReview = ref<Review | null>(null);
const bookId = computed<number>(() => Number(route.params.id));

// Methods with types
const loadReviewForEditing = (review: Review): void => {
    currentReview.value = { ...review };
};

const cancelEdit = (): void => {
    currentReview.value = null;
};

const handleDelete = async (id: number): Promise<void> => {
    try {
        await reviewStore.actions.delete(id);
    } catch (error) {
        console.error('Failed to delete review:', error);
    }
};

const handleSubmit = async (data: Review) => {
    if (currentReview.value?.id) {
            await reviewStore.actions.update(currentReview.value.id, data);
            currentReview.value = null;
        } else {
            await reviewStore.actions.create(data);
            router.push({ name: 'book.view' });
        }
    
};

// Initialize
onMounted(async () => {
    try {
        await reviewStore.actions.getAll();
    } catch (error) {
        console.error('Failed to load reviews:', error);
    }
});

// Computed with explicit type
const bookReviews = computed<Review[]>(() => {
    return reviewStore.getters.all.value.filter((review: Review) => 
        review.book_id === bookId.value
    );
});
</script>

<style scoped>

</style>