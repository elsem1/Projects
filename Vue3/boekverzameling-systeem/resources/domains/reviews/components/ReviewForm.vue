<template>
    <div class="review-form">
        <ErrorMessage />
        <form @submit.prevent="handleSubmit" class="form">
            <h1 class="title">{{ isEditing ? 'Bewerk Review' : 'Schrijf een nieuwe review!'}}</h1>
            
            <div class="form-group">
                <label class="label">Review:</label>
                <textarea 
                    v-model="form.review" 
                    class="textarea" 
                    rows="4"
                />
                <ErrorForm name="review" />
            </div>
            
            <div class="form-group">
                <label class="label">Rating:</label>
                <input 
                    v-model="form.rating" 
                    class="range-input" 
                    type="range" 
                    min="0" 
                    max="5" 
                    step="1" 
                />
                <div class="rating-value">Rating: {{ form.rating }}/5</div>
                <ErrorForm name="rating" />
            </div>
            
            <div class="actions">
                <button type="submit" class="btn submit">
                    {{ isEditing ? 'Update' : 'Opslaan' }}
                </button>
                <button 
                    v-if="isEditing" 
                    type="button" 
                    class="btn cancel"
                    @click="handleCancel"
                >
                    Annuleren
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import ErrorMessage from '../../../js/services/error/ErrorMessage.vue';
import ErrorForm from '../../../js/services/error/ErrorForm.vue';

const props = defineProps({
    bookId: {
        type: Number,
        required: true
    },
    editingReview: {
        type: Object,
        default: undefined
    },
    isEditing: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['submit', 'cancel-edit']);

const form = ref({
    book_id: props.bookId,
    review: '',
    rating: 3,
});

// Watch voor veranderingen in editingReview prop
watch(() => props.editingReview, (newReview) => {
    if (props.isEditing && newReview) {
        form.value = {
            book_id: props.bookId,
            review: newReview.review,
            rating: newReview.rating
        };
    }
}, { immediate: true });

// Watch voor isEditing om form te resetten wanneer editing stopt
watch(() => props.isEditing, (isEditing) => {
    if (!isEditing) {
        form.value = {
            book_id: props.bookId,
            review: '',
            rating: 3
        };
    }
});

onMounted(() => {
    if (props.isEditing && props.editingReview) {
        form.value = {
            book_id: props.bookId,
            review: props.editingReview.review,
            rating: props.editingReview.rating
        };
    } else {
        form.value = {
            book_id: props.bookId,
            review: '',
            rating: 3
        };
    }
});

const handleSubmit = () => {
    emit('submit', {
        ...form.value,
        rating: Number(form.value.rating)
    });
   
    if (!props.isEditing) {
        form.value.review = '';
        form.value.rating = 3;
    }
};

const handleCancel = () => {
    emit('cancel-edit');
};
</script>

<style scoped>
.review-form {
    width: 100%;
    max-width: 600px;
    font-family: sans-serif;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.title {
    font-size: 1.3rem;
    margin: 0;
    font-weight: normal;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.label {
    font-weight: 500;
}

.textarea {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-family: inherit;
    resize: vertical;
    min-height: 100px;
}

.range-input {
    width: 100%;
    margin: 0;
}

.rating-value {
    font-size: 0.9rem;
    color: #666;
}

.actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: 1px solid #ddd;
    background: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.2s ease;
}

.btn:hover {
    background: #f8f8f8;
}

.submit {
    border-color: #333;
    background: #333;
    color: white;
}

.submit:hover {
    background: #444;
}

.cancel {
    border-color: #ddd;
}
</style>