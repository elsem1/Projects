<template>
    
    <Form />
    
</template>

<script setup lang="ts">
import Form from "../components/LoginForm.vue";
import type { User } from "../../type";

const login = async (): Promise<void> => {
        
    await axios.get("/sanctum/csrf-cookie");
    const { data } = await axios.post<{ token: string }>('/api/login', {
    email: email.value,
    password: password.value,
    });
};
</script>

<style scoped></style>
