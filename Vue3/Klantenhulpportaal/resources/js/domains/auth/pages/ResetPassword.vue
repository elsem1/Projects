<template>
    <ErrorMessage />
    <h3>Reset Password</h3>
    <p>Create a new password.</p>
    <div class="reset-password">
        <form @submit.prevent="resetPassword">
            <div>
                <label>New Password:</label>
                <input v-model="passwordReset.password" type="password" required placeholder="Password123" />
                <ErrorForm name="password" />
                <label>Confirm your password: </label>
                <input v-model="passwordReset.password_confirmation" type="password" required
                    placeholder="Type your password again" />
                <ErrorForm name="password_confirmation" />               
                
                <button type="submit" class="submit">Reset password</button>
            </div>
        </form>
    </div>

</template>

<script setup lang="ts">
import { reactive, defineEmits } from "vue";
import { UserReset } from "../types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";
import { useRoute, useRouter } from "vue-router";
import { postRequest } from "../../../services/http";

const router = useRouter();
const route = useRoute();
const passwordReset = reactive<UserReset>({
    token: route.params.token as string, 
    email: route.query.email as string,
    password: '',
    password_confirmation: '',
});


const resetPassword = async () => {
    await postRequest('/reset-password', passwordReset);
    await postRequest('/login', {
      email: passwordReset.email,
      password: passwordReset.password,
    });
    router.push('/');
}

</script>