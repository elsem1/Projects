<template>
    <div class="loggedOut">
        <LoginForm @submit="login" />
    </div>
    <div class="forgotPassword">
        <ForgotPassword @submit="forgotPassword" />
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import LoginForm from "../components/LoginForm.vue";
import ForgotPassword from "../components/ForgotPassword.vue";
import { initCsrf, postRequest } from "../../../services/http";
import { UserLogin, UserForgot } from "../types";
import { router } from "../../../services/router";



const login = async (credentials: UserLogin) => {
    await initCsrf();
    await postRequest('/login', credentials);
    router.push('/')
}

const forgotPassword = async (userForgot: UserForgot) => {
    await postRequest('/forgot-password', userForgot);
}


</script>