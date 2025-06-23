<template>
    
    <Form @submit="login"/>   
    <button @click="meRequest" class="meRequest">/me</button>
        
</template>

<script setup lang="ts">
import { ref } from "vue";
import Form from "../components/LoginForm.vue";
import axios from "axios";
import { userLogin } from "../../type";

const login = async (credentials: userLogin) => {    
    await axios.post('/api/login', credentials);
};

const meRequest = async () => {
    await axios.get('/api/me');       
};
</script>

<style scoped></style>
