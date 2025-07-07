<template>

    <Form @submit="login" />
    
</template>

<script setup lang="ts">
import { ref } from "vue";
import Form from "../components/LoginForm.vue"
import { getRequest, initCsrf, postRequest } from "../../../services/http";
import { UserLogin } from "../types";
import { router } from "../../../services/router";

const loggedIn = ref(false);

const login = async (credentials: UserLogin) => {
    await initCsrf();
    await postRequest('/login', credentials);
    loggedIn.value = true;
    router.push('/')
}

const checkLogIn = async () => {
    const response = await getRequest('/me');
    if (
    loggedIn.value = !!response?.data?.id
    ) { loggedIn.value = true        
    } else {
        loggedIn.value = false
    }
};

const logout = async () => {
    await postRequest('/logout');
    loggedIn.value = false;
    router.push('/');
}



</script>