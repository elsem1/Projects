<template>
    <div class="login-form">
        <ErrorMessage />

        <form @submit.prevent="login">
            <div>
                <label>Email:</label>
                <input v-model="email" type="email" placeholder="Email" />
                <ErrorForm name="email" />
            </div>

            <div>
                <label>Password</label>
                <input v-model="password" type="password" placeholder="Wachtwoord" />
                <ErrorForm name="password" />
            </div>
            <button type="submit" class="submit">Inloggen</button>
        </form>
    </div>
</template>

<script setup lang="ts">
import { getMessage } from "../../../services/error";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";
import { ref, defineProps, defineEmits } from "vue";
import axios from "axios";

const props = defineProps({})

const email = ref<string>('');
const password = ref<string>('');



const login = async (): Promise<void> => {
        
    await axios.get("/sanctum/csrf-cookie");
    const { data } = await axios.post<{ token: string }>('/api/login', {
    email: email.value,
    password: password.value,
    });
};



</script>

<style scoped></style>
