<template>
    <div class="login-form">
        <form @submit.prevent="login">
            <div>
                <label>Email: </label>
                <input v-model="userLogin.email" type="email" placeholder="Email" />
            </div>

            <div>
                <label>Password: </label>
                <input v-model="userLogin.password" type="password" placeholder="Wachtwoord" />
            </div>
            <button type="submit" class="submit">Inloggen</button>
            
        </form>
    </div>
</template>

<script setup lang="ts">

import { ref, defineEmits } from "vue";
import { userLogin } from "../../type";

const emit = defineEmits(['submit']);

const userLogin = ref({
    email: '',
    password: '',
});

const login = () => emit('submit', userLogin.value);


</script>

<style scoped></style>
