<template>
    <div class="page-wrapper">
        <header>
            <div class="header-content">
                <button v-if="showBackButton" @click="goBack" class="back-button">
                    ← Terug
                </button>
                <h1 class="page-title">Klantenhulpportaal</h1>
            </div>
        </header>
       
        <main class="main-content">
            <router-view />
        </main>
        <footer class="footer">
            &copy; 2025 EZTickets
        </footer>
    </div>
</template>

<script lang="ts" setup>
import { computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const router = useRouter();
const route = useRoute();

const showBackButton = computed(() => {    
    return route.path !== '/';
});

const goBack = () => {
    
    if (window.history.state.back) {
        router.go(-1);
    } else {
        router.push('/');
    }
};
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
    box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}

.back-button {
    position: absolute;
    left: -6rem;
    background: transparent;
    border: none;
    color: white;
    font-size: 1rem;
    cursor: pointer;
    padding: 0.5rem 6rem;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.back-button:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.page-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.8rem;
    text-align: center;
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