<template>
    <ErrorMessage />
    <div v-if="ticket">
        <title>Ticket Formulier</title>
        <section>
            <form @submit.prevent="handleSubmit">
                <ul>
                    <li>
                        <label for="title"><strong>Titel:</strong></label>
                        <input id="title" v-model="form.title" type="text" required />
                        <ErrorForm name="title" />
                    </li>

                    <li>
                        <label><strong>Categorieën:</strong></label>
                        <select v-model="form.categories" multiple>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <ErrorForm name="category" />
                    </li>

                    <li>
                        <label for="status_id"><strong>Status:</strong></label>
                        <select id="status" v-model="form.status_id" :disabled="Boolean(!isAdmin)" required>
                            <option v-for="status in status" :key="status.id" :value="status.id">
                                {{ status.name }}
                            </option>
                        </select>
                        <ErrorForm name="status" />
                    </li>

                    <li>
                        <label for="content"><strong>Uitleg:</strong></label>
                        <textarea id="content" v-model="form.content" rows="5" required />
                        <ErrorForm name="content" />
                    </li>
                </ul>
                <RouterLink :to="{ name: 'tickets.overview' }" class="btn btn-cancel">
                    Cancel
                </RouterLink>
                <button class="btn btn-submit" type="submit">Opslaan</button>

            </form>
        </section>
    </div>
</template>

<script setup lang="ts">
import { reactive, defineProps, defineEmits, ref, onMounted } from 'vue'
import { statusStore } from '../../status/store';
import { categoryStore } from '../../categories/store';
import ErrorMessage from '../../../services/error/ErrorMessage.vue';
import ErrorForm from '../../../services/error/ErrorForm.vue';
import { TicketForm, Status } from '../types';
import { getRequest } from '../../../services/http';

const props = defineProps<{
    ticket: {
        title: string;
        content: string;
        categories: number[];
        status_id: number;
        status?: Status;
    }
}>();


const categories = categoryStore.getters.all;
const status = statusStore.getters.all;
categoryStore.actions.getAll();
statusStore.actions.getAll();
const isAdmin = ref(false);

const checkAdminStatus = async () => {
    try {
        const response = await getRequest('/me');
        isAdmin.value = !!response?.data?.is_admin;
    } catch (error) {
        isAdmin.value = false;
    }
};

const emit = defineEmits(['submit']);

const form = reactive<TicketForm>({
    ...props.ticket,
    categories: props.ticket.categories || [],
    status_id: props.ticket.status_id,
});

const handleSubmit = () => emit('submit', form);

onMounted(() => {
    checkAdminStatus();
});



</script>

<style scoped>
div {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

section {
    margin-top: 1rem;
    font-size: 0.9rem;
}

h2 {
    margin-bottom: 1rem;
}

ul {
    list-style: none;
    padding: 0;
    max-width: 500px;
}

li {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

label {
    width: 140px;
    color: #555;
    font-weight: bold;
    display: inline-block;
}

input[type="text"],
select,
textarea {
    flex: 1;
    padding: 0.4rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.9rem;
    font-family: inherit;
}

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

select:disabled {
    background-color: #f5f5f5;
    color: #999;
    cursor: not-allowed;
}
</style>