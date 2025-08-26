<template>
    <div class="edit">
        <h1>Gebruiker bewerken</h1>
        <div v-if="loading">Loading...</div>
        <Form v-else-if="userForm" :user="userForm" @submit="handleSubmit" />
        <div v-else-if="error" class="error">{{ error }}</div>
        <div v-else class="not-found">Gebruiker niet gevonden</div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { userStore } from '../store';
import { UserForm } from '../types';
import Form from '../components/UserForm.vue';

const router = useRouter();
const route = useRoute();
const loading = ref(true);
const error = ref<string | null>(null);


const userId = computed(() => Number(route.params.userId));

// Haal user data op voor het formulier
const user = computed(() => userStore.getters.byId(userId.value).value);

// Prepare form data
const userForm = computed(() => {
    if (!user.value) return null;
    return {
        first_name: user.value.first_name,
        last_name: user.value.last_name,
        email: user.value.email,
        phone_number: user.value.phone_number,
        is_admin: user.value.is_admin,
    };
});

onMounted(async () => {
    try {
        loading.value = true;
        error.value = null;
        await userStore.actions.getById(userId.value);

        // Wacht even om zeker te zijn dat de store is bijgewerkt
        setTimeout(() => {
            loading.value = false;
        }, 100);
    } catch (err) {
        error.value = 'Fout bij laden user';
        console.error('Error loading user:', err);
        loading.value = false;
    }
});

const handleSubmit = async (data: UserForm) => {
    try {
        await userStore.actions.update(userId.value, data);
        router.push({ name: 'users.overview' });
    } catch (err) {
        error.value = 'Fout bij bijwerken user';
        console.error('Update error:', err);
    }
}
</script>

<style scoped>
.user-container {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

h1 {
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.btn-back {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: #6b7280;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 1rem;
    transition: filter 0.2s ease;
}

.btn-back:hover {
    filter: brightness(1.1);
}
</style>