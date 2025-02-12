<script setup></script>

<template>
    <div id="nav">
        <nav>
            <RouterLink to="/">Home</RouterLink>
            |
            <RouterLink to="/create">Create</RouterLink>
            |
            <RouterLink to="/overview">Overview</RouterLink>
            |
        </nav>
        <RouterView />
    </div>
</template>

<style scoped></style>
