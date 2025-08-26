<template>
    <ErrorMessage />
    <div class="register-form">
        <form @submit.prevent="register">
            <div>
                <label>Voornaam: </label>
                <input id="first_name" v-model="userRegister.first_name" type="text" placeholder="Voornaam" />
                <ErrorForm name="first_name" />
            </div>
            <div>
                <label>Achternaam: </label>
                <input id="last_name" v-model="userRegister.last_name" type="text" placeholder="Achternaam" />
                <ErrorForm name="last_name" />
            </div>
            <div>
                <label>Telefoonnummer: </label>
                <input id="phone_number" v-model="userRegister.phone_number" type="tel" placeholder="0612345678" />
                <ErrorForm name="phone_number" />
            </div>
            <div>
                <label>Emailadres: </label>
                <input id="email" v-model="userRegister.email" type="email" placeholder="putyouremail@here.com" />
                <ErrorForm name="email" />
            </div>
            <div>
                <label>Emailadres check: </label>
                <input id="email_confirmation" v-model="userRegister.email_confirmation" type="email"
                    placeholder="email@confirmation.com" />
                <ErrorForm name="email_confirmation" />
            </div>
            <div>
                <label>Password: </label>
                <input v-model="userRegister.password" type="password" placeholder="password123" />
            </div>
            <div>
                <input id="is_admin" v-model="userRegister.is_admin" type="hidden" value="0" />
            </div>
            <button type="submit" class="submit">Inschrijven</button>
        </form>
    </div>
</template>

<script setup lang="ts">

import { ref, defineEmits } from "vue";
import { UserRegister } from "../../users/types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";


const emit = defineEmits<{
    (event: 'submit', payload: UserRegister): void;
}>();

const userRegister = ref<UserRegister>({
    first_name: '',
    last_name: '',
    phone_number: '',
    email: '',
    email_confirmation: '',
    password: '',
    is_admin: 0,

});

const register = () => emit('submit', userRegister.value);

</script>