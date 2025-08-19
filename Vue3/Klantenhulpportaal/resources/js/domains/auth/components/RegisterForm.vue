<template>
    <ErrorMessage />
    <div class="register-form">
        <form @submit.prevent="register">
            <div>
                <label>Voornaam: </label>
                <input id="first_name" v-model="form.first_name" type="text" placeholder="Voornaam" />
                <ErrorForm name="first_name" />
            </div>
            <div>
                <label>Achternaam: </label>
                <input id="last_name" v-model="form.last_name" type="text" placeholder="Achternaam" />
                <ErrorForm name="last_name" />
            </div>
            <div>
                <label>Telefoonnummer: </label>
                <input id="phone_number" v-model="form.phone_number" type="tel" placeholder="0612345678" />
                <ErrorForm name="phone_number" />
            </div>
            <div>
                <label>Emailadres: </label>
                <input id="email" v-model="form.email" type="email" placeholder="putyouremail@here.com" />
                <ErrorForm name="email" />
            </div>
            <div>
                <label>Emailadres check: </label>
                <input id="email_confirmation" v-model="form.email_confirmation" type="email" placeholder="email@confirmation.com" />
                <ErrorForm name="email_confirmation" />
            </div>
            <div>
                <label>Password: </label>
                <input v-model="form.password" type="password" placeholder="password123" />
            </div>                        
            <button type="submit" class="submit">Inschrijven</button>            
        </form>
    </div>
</template>

<script setup lang="ts">

import { ref, defineEmits } from "vue";
import { UserRegister } from "../types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";


const emit = defineEmits<{
    (event: 'submit', payload: UserRegister): void;
}>();

const form = ref<UserRegister>({
    first_name: '',
    last_name: '',
    phone_number: '',
    email: '',
    email_confirmation: '',
    password: '',
    
});

const register = () => emit('submit', form.value);

</script>