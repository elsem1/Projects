<template>
    <ErrorMessage />

    <div>
        <section>
            <form @submit.prevent="handleSubmit">
                <label for="name"><strong>Categorie naam:</strong></label>
                <input id="name" v-model="categoryForm.name" type="text" rows="5" required />
                <ErrorForm name="name" />

                <RouterLink :to="{ name: 'tickets.view', params: { id: $route.params.ticketId } }"
                    class="btn btn-cancel">
                    Cancel
                </RouterLink>

                <button class="btn btn-submit" type="submit">Opslaan</button>
            </form>
        </section>
    </div>
</template>


<script setup lang="ts">
import ErrorMessage from '../../../services/error/ErrorMessage.vue';
import ErrorForm from '../../../services/error/ErrorForm.vue';
import { reactive, defineProps, defineEmits } from 'vue';
import { CategoryForm } from '../types';

const emit = defineEmits(['submit']);

const props = defineProps<{
    category: {
        name: string;
        description: string,
    };
    
}>();

const categoryForm = reactive<CategoryForm>({
    ...props.category
});

const handleSubmit = () => emit('submit', categoryForm);
</script>

<style scoped>
.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-family: Arial, sans-serif;
    font-size: 0.95rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-left: 1rem;
    transition: filter 0.2s ease, transform 0.1s ease;
}


.btn-submit {
    background-color: #007acc;
    color: #fff;
}

.btn-cancel {
    background-color: #f05353;
    color: #333;
    margin-left: 0.5rem;
}


.btn:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}


.btn:active {
    filter: brightness(0.9);
    transform: translateY(0);
}


.btn:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}
</style>