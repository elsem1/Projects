<template>
    <div class="review-box">
        <h2 class="title">Reviews for this book</h2>   
        
        <div v-if="bookReviews.length === 0" class="empty">
            <p>No reviews yet for this book.</p>
        </div>
        
        <div v-else class="reviews">
            <div v-for="review in bookReviews" :key="review.id" class="review">
                <div class="content">
                    <p class="text"><strong>Review:</strong> {{ review.review }}</p>
                    <p class="rating"><strong>Rating:</strong> {{ review.rating }}/5 ⭐</p>
                    <p class="author"><strong>By:</strong> {{ review.user?.name || `User ${review.user_id}` }}</p>
                </div>
                <div class="actions">
                    <button @click="loadReviewForEditing(review)" class="btn edit">Bewerk</button>
                    <button @click="handleDelete(review.id)" class="btn delete">Verwijder</button>
                </div>
            </div>
        </div>
        
        <div class="form-container">
            <Form
                :bookId="bookId"
                :editingReview="currentReview"
                :isEditing="isEditing"
                @submit="handleSubmit"
                @cancel-edit="cancelEdit"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import Form from '../components/ReviewForm.vue';
import { reviewStore } from '../store';
import type { Review } from '../../types';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

const currentReview = ref<Review | undefined>(undefined);
const isEditing = ref(false);

const bookId = computed<number>(() => Number(route.params.id));

const loadReviewForEditing = (review: Review): void => {
    // FIX: Stel currentReview in op de geselecteerde review
    currentReview.value = review;
    isEditing.value = true;
};

const cancelEdit = (): void => {
    currentReview.value = undefined;
    isEditing.value = false;
};

const handleDelete = async (id: number): Promise<void> => {
    try {
        await reviewStore.actions.delete(id);
    } catch (error) {
        console.error('Failed to delete review:', error);
    }
};

const handleSubmit = async (data: Review) => {
    try {
        if (isEditing.value && currentReview.value?.id) {
            await reviewStore.actions.update(currentReview.value.id, data);
        } else {
            await reviewStore.actions.create(data);
            // FIX: Verwijder automatische redirect na het maken van een review
            // router.push({ name: 'book.view' });
        }
        cancelEdit();
    } catch (error) {
        console.error('Failed to submit review:', error);
    }
};

const bookReviews = computed<Review[]>(() => {
    const allReviews = reviewStore.getters.all.value || [];
    console.log('All reviews:', allReviews);
    console.log('Current bookId:', bookId.value);
    const filtered = allReviews.filter((review: Review) =>
        review.book_id === bookId.value
    );
    console.log('Filtered reviews for this book:', filtered);
    return filtered;
});

// Loading state
const isLoading = ref(true);

// Laad reviews bij component mount
onMounted(async () => {
    try {
        console.log('Loading reviews...');
        await reviewStore.actions.getAll();
        console.log('Reviews loaded successfully');
        console.log('Sample review data:', reviewStore.getters.all.value[0]);
    } catch (error) {
        console.error('Failed to load data:', error);
    } finally {
        isLoading.value = false;
    }
});
</script>

<style scoped>
.review-box {
    max-width: 800px;
    margin: 0;
    padding: 1rem;
    font-family: sans-serif;
}

.title {
    font-size: 1.3rem;   
    font-weight: normal;
}

.loading,
.empty {    
    text-align: center;
    color: #666;
}

.reviews {
    margin: rem 0;
}

.review {
    padding: 0.2rem 0;
    border-bottom: 1px solid #eee;
}

.review:last-child {
    border-bottom: none;
}

.content {
    margin-bottom: 1rem;
}

.content p {
    margin: 0.1rem 0;
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.2rem 0.4rem;
    border: 1px solid #ddd;
    background: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn:hover {
    background: #f8f8f8;
}

.form-container {
    margin-top: 1rem;
    padding: 1rem 0;
    border-top: 1px solid #eee;
}
</style>