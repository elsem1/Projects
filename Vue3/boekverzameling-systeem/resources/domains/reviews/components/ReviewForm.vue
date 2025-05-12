<template>
    
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">

        <h1>{{ editingReview ? 'Bewerk Review' : 'Schrijf een nieuwe review!'}}</h1>
        <div>
            <label>Review:</label>
            <input v-model="form.review" type="text" rows="4" />
            <ErrorForm name="review" />
        </div>
        
        <div>
            <label>Rating:</label>
            <input v-model="form.rating" type="range" min="0" max="5" steps="1" />
            <ErrorForm name="rating" />
        </div>
         <button type="submit">{{ editingReview ? 'Update' : 'Opslaan' }}</button>
        <button class="submit">Opslaan</button>        

    </form>

</template>

<script setup>
import { ref, defineEmits } from 'vue';
import { getMessage } from '../../../js/services/error';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';
import ErrorForm from '../../../js/services/error/ErrorForm.vue';

const props = defineProps({ 
    review: Object,
    bookId: Number
});
const emit = defineEmits(['submit']);

const form = ref({
    book_id: props.bookId,
    review: '',
    rating: 0
});



const handleSubmit = () => {
    emit('submit', {
        ...form.value,
        rating: Number(form.value.rating)
});
    form.value.review = '';
    form.value.rating = 3;
};
</script>

<style scoped>
</style>
