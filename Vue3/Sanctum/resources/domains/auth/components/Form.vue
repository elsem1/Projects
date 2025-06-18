<template>
    <div class="login-form">
        <ErrorMessage />

        <form @submit.prevent="handleSubmit">
            <div>
                <label>Email:</label>
                <input v-model="credentials.email" type="email" />
                <ErrorForm name="email" />
            </div>

            <div>
                <label>Password</label>
                <input v-model="credentials.password" type="password" />
                <ErrorForm name="password" />
            </div>
            <button class="submit">Opslaan</button>
        </form>
    </div>
</template>

<script setup lang="ts">
import { getMessage } from "../../../js/services/error";
import ErrorMessage from "../../../js/services/error/ErrorMessage.vue";
import ErrorForm from "../../../js/services/error/ErrorForm.vue";
import { ref, defineProps, defineEmits } from "vue";

const credentials = ref({
    email: "",
    password: "",
});

const handleSubmit = async () => {
    await axios.get("/sanctum/csrf-cookie");
    // maak post request met login data naar backend
    emit("submit", form.value);
};
</script>

<style scoped></style>
