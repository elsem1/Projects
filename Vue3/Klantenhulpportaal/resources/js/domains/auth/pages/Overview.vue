<template>

    <Form @submit="login" />
    <div v-if="loggedIn">
        <button class="logout" @click="logout">Logout</button>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
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
    await getRequest('/me');
    // if () hier was ik bezig om iets te bedenken dat kan kijken of de user is ingelogd
    loggedIn.value = true;
};

const logout = async () => {
    await postRequest('/logout');
    loggedIn.value = false;
    router.push('/');
}

onMounted(() => {
    checkLogIn();
});

</script>