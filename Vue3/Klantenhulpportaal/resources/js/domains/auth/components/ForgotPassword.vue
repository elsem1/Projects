<template>
    <ErrorMessage />
    <h3>Forgot Password</h3>
    <p>Fill in your password to receive an email for resetting your password.</p>
    <div class="reset-password">
        <form @submit.prevent="forgotPassword">
            <div>
                <label>Email adress:</label>
                <input v-model="userForgot.email" type="email" required placeholder="youremail@ifotgot.com" />
                <ErrorForm name="email" />
                <button type="submit" class="submit">Send mail</button>
            </div>
        </form>
    </div>


</template>


<script setup lang="ts">
import ErrorForm from '../../../services/error/ErrorForm.vue';
import ErrorMessage from '../../../services/error/ErrorMessage.vue';
import { UserForgot } from '../types';
import { ref, defineEmits } from 'vue';

const emit = defineEmits<{
    (event: 'submit', payload: UserForgot): void;

}>();

const userForgot = ref<UserForgot>({
    'email': '',
});

const forgotPassword = () => emit('submit', userForgot.value);

</script>