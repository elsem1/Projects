<template>
    <div class="page-wrapper">
        <header>
            <h1 class="page-title">Klantenhulpportaal</h1>
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
