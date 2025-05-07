<template>
    
    <ErrorMessage />

    <form @submit.prevent="handleSubmit">

        <h1>Write a new review!</h1>
        <div>
            <label>Review:</label>
            <input v-model="form.review" type="text" />
            <ErrorForm name="review" />
        </div>

        <div>
            <label>Rating:</label>
            <input v-model="form.rating" type="range" min="0" max="5" />
            <ErrorForm name="rating" />
        </div>

        <button class="submit">Opslaan</button>        

    </form>

</template>

<script setup>
import { ref, defineEmits } from 'vue';
import { getMessage } from '../../../js/services/error';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';
import ErrorForm from '../../../js/services/error/ErrorForm.vue';

const props = defineProps({ review: Object });
const emit = defineEmits(['submit']);

const form = ref({
    review: '',
    rating: 0
});

const reviewData = ref({ ...props.review });



const handleSubmit = () => {
    emit('submit', reviewData.value);
    form.value = { review: '', rating: 0 }; 
};
</script>

<style scoped>
</style>
