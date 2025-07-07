<template>
    <ErrorMessage />
    <div class="login-form">
        <form @submit.prevent="login">
            <div>
                <label>Email: </label>
                <input v-model="userLogin.email" type="email" placeholder="putyouremail@here.com" />
                <ErrorForm name="email" />
            </div>

            <div>
                <label>Password: </label>
                <input v-model="userLogin.password" type="password" placeholder="password123" />
            </div>
            <label>
                <input v-model="userLogin.remember" type="checkbox" />
                Rememeber Me
            </label>            
            <button type="submit" class="submit">Inloggen</button>            
        </form>
    </div>
</template>

<script setup lang="ts">

import { ref, defineEmits } from "vue";
import { UserLogin } from "../types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";


const emit = defineEmits<{
    (event: 'submit', payload: UserLogin): void;
}>();

const userLogin = ref<UserLogin>({
    email: '',
    password: '',
    remember: false
});

const login = () => emit('submit', userLogin.value);

</script>