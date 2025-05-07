<template>
    <div>
        <h2>Reviews for this book</h2>    
        
        
            <div v-for="review in bookReviews" :key="review.id">
                <p>{{ review.review }}</p>
                <p>Rating: {{ review.rating }}/5</p>
                <p>by {{ authorStore.getters.byId(review.user_id).value?.name }}</p>
                </div>
            </div>           
        
    <Form  @submit="handleSubmit" />
    

</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import Form from '../components/ReviewForm.vue';
import { reviewStore } from '../store'
import { Review } from '../../types'
import { useRouter, useRoute } from 'vue-router';
import { authorStore } from '../../authors/store';


const router = useRouter();
const route = useRoute();
const bookId = computed(() => Number(route.params.id));


reviewStore.actions.getAll();
const bookReviews = computed(() => reviewStore.getters.all.value.filter((review: any) => review.book_id === bookId.value));


const handleSubmit = async (data: Review) => {
    await reviewStore.actions.create(data);
    router.push({ name: 'book.view' });
}
    
</script>

<style scoped>
</style>
