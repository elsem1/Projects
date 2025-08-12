<template>
    <div class="loggedout">
        <Form @submit="login" />
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import Form from "../components/LoginForm.vue"
import { initCsrf, postRequest } from "../../../services/http";
import { UserLogin } from "../types";
import { router } from "../../../services/router";



const login = async (credentials: UserLogin) => {
    await initCsrf();
    await postRequest('/login', credentials);
    router.push('/')
}

</script>