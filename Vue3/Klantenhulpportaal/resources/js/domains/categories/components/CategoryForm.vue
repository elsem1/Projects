<template>
    <div class="category-form">
        <ErrorMessage v-if="errorMessage" :message="errorMessage" />
        
        <section class="form-section">
            <form @submit.prevent="handleSubmit" class="form">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <strong>Categorie naam:</strong>
                    </label>
                    <input id="name" v-model="categoryForm.name" type="text" class="form-input" required />                    
                    <ErrorForm name="name" />
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">
                        <strong>Beschrijving:</strong>
                    </label>
                    <textarea 
                        id="description" 
                        v-model="categoryForm.description" 
                        class="form-textarea"
                        rows="4"
                    ></textarea>
                    <ErrorForm name="description" />
                </div>

                <div class="form-actions">
                    <RouterLink 
                        :to="{ name: 'categories.overview' }"
                        class="btn btn-cancel">
                        Annuleren
                    </RouterLink>
                    <button class="btn btn-submit" type="submit">Opslaan</button>
                </div>
            </form>
        </section>
    </div>
</template>

<script setup lang="ts">
import ErrorMessage from '../../../services/error/ErrorMessage.vue';
import ErrorForm from '../../../services/error/ErrorForm.vue';
import { reactive, defineProps, defineEmits, ref } from 'vue';
import { CategoryForm } from '../types';

const emit = defineEmits(['submit']);
const errorMessage = ref<string | null>(null);

const props = defineProps<{
    category: {
        name: string;
        description: string;
    };
}>();

const categoryForm = reactive<CategoryForm>({
    name: props.category.name || '',
    description: props.category.description || '',
});

const handleSubmit = () => {
    if (!categoryForm.name.trim()) {
        errorMessage.value = 'Categorie naam is verplicht';
        return;
    }
    errorMessage.value = null;
    emit('submit', categoryForm);
};
</script>

<style scoped>
.category-form {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

.form-section {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.form {
    max-width: 600px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #374151;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 6px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s ease;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: #4c7df5;
    box-shadow: 0 0 0 3px rgba(76, 125, 245, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    font-family: Arial, sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-cancel {
    background-color: #6b7280;
    color: white;
}

.btn-cancel:hover {
    background-color: #4b5563;
    transform: translateY(-1px);
}

.btn-submit {
    background-color: #44d631;
    color: white;
}

.btn-submit:hover {
    background-color: #3bc027;
    transform: translateY(-1px);
}

.btn:active {
    transform: translateY(0);
}

.btn:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}

/* Responsive design */
@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>