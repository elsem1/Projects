<template>
    <nav class="navbar">

        <div class="nav-links">
            <RouterLink to="/">Home | </RouterLink>
            <RouterLink to="/tickets">Tickets |</RouterLink>
            <RouterLink to="/categories" v-if="isAdmin">Categoreën |</RouterLink>
            <RouterLink to="/users" v-if="isAdmin">Users |</RouterLink>
            <RouterLink to="/register" v-if="!loggedIn">Registreer</RouterLink>
        </div>
        <div class="logout" v-if="loggedIn">
            <button @click="logout">Logout</button>
        </div>
    </nav>
    <Layout />
</template>

<script setup lang="ts">
import Layout from '../js/layouts/DefaultLayout.vue'
import { getRequest, postRequest } from '../js/services/http';
import { ref, onMounted, computed } from "vue";
import { router } from '../js/services/router'


const isAdmin = ref(false);
const loggedIn = ref(false);

const checkAdminStatus = async () => {
    const response = await getRequest('/me');
    isAdmin.value = response?.data?.is_admin ?? false;
}
const checkLogIn = async () => {
    try {
        const response = await getRequest('/me');
        loggedIn.value = !!response?.data?.id;
    } catch (error) {
        loggedIn.value = false;
    }
};

const logout = async () => {
    await postRequest('/logout');
    loggedIn.value = false;
    await checkLogIn();
    router.push('/');
};

onMounted(() => {
    checkAdminStatus();
    checkLogIn();
});
</script>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #ddd;
}

.nav-links {
    display: flex;
    gap: 5px;
}

.logout button {
    padding: 8px 12px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.logout button:hover {
    background-color: #c82333;
}
</style>