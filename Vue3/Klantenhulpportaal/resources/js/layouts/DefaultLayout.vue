<template>
    <div class="page-wrapper">
        <header>
            <h1 class="page-title">Klantenhulpportaal</h1>
        </header>
        <nav>
            <div v-if="loggedIn">
                <button class="logout" @click="logout">Logout</button>
            </div>
        </nav>

        <main class="main-content">

            <router-view />
        </main>
        <footer class="footer">
            &copy; 2025 EZTickets
        </footer>
    </div>
</template>

<script lang="ts" setup>
import { getRequest, postRequest } from "../services/http/index";
import { ref, onMounted } from "vue";
import { router } from "../services/router"

const loggedIn = ref(false);

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

onMounted(() => {
    checkLogIn();
});

</script>

<style>
.page-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: #f0f2f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

header {
    background-color: #0052cc;
    color: white;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
}

.page-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.8rem;
}

.main-content {
    flex: 1;
    padding: 2rem;
}

.footer {
    text-align: center;
    padding: 1rem;
    color: #666;
    font-size: 0.9rem;
}
</style>
