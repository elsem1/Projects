<template>
    <div class="register">
        <Form @submit="register" />
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import Form from "../components/RegisterForm.vue"
import { initCsrf, postRequest } from "../../../services/http";
import { UserRegister } from "../types";
import { router } from "../../../services/router";



const register = async (credentials: UserRegister) => {
    await initCsrf();
    await postRequest('/register', credentials);
    router.push('/tickets')
}

</script>