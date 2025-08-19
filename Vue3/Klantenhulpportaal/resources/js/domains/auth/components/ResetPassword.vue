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
                <input v-model="passwordReset.password" type="password" required
                    placeholder="Type your password again" />
                <ErrorForm name="password_confirmation" />
                <input v-model="passwordReset.token" type="hidden" required value="{{ $token }}" /> <button
                    type="submit" class="submit">Reset password</button>
            </div>
        </form>
    </div>

</template>

<script setup lang="ts">
import { ref, defineEmits } from "vue";
import { UserReset } from "../types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";

const emit = defineEmits<{
    (event: 'submit', payload: UserReset): void;
}>();

const passwordReset = ref<UserReset>({
    password: '',
    token: '',

});

const resetPassword = () => emit('submit', passwordReset.value);

</script>