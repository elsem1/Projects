<template>
    <div class="loggedout" v-if="showLogin">
    <Form @submit="login" />
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import Form from "../components/LoginForm.vue"
import { getRequest, initCsrf, postRequest } from "../../../services/http";
import { UserLogin } from "../types";
import { router } from "../../../services/router";

const showLogin = ref(true);

const login = async (credentials: UserLogin) => {
    await initCsrf();
    await postRequest('/login', credentials);
    showLogin.value = false;
    router.push('/')
}

const checkLogin = async () => {
    try {
        const response = await getRequest("/me");        
        showLogin.value = !response?.data?.id;
    } catch (error) {        
        showLogin.value = true;
    }
};
onMounted(() => {
    checkLogin();
})




</script>