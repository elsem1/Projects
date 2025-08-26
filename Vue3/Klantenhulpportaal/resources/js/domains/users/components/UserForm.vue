<template>
    <ErrorMessage />
    <div class="register-form">
        <form @submit.prevent="updateUser">
            <div>
                <label>Voornaam: </label>
                <input id="first_name" v-model="userForm.first_name" type="text" placeholder="Voornaam" />
                <ErrorForm name="first_name" />
            </div>
            <div>
                <label>Achternaam: </label>
                <input id="last_name" v-model="userForm.last_name" type="text" placeholder="Achternaam" />
                <ErrorForm name="last_name" />
            </div>
            <div>
                <label>Telefoonnummer: </label>
                <input id="phone_number" v-model="userForm.phone_number" type="tel" placeholder="0612345678" />
                <ErrorForm name="phone_number" />
            </div>
            <div>
                <label>Emailadres: </label>
                <input id="email" v-model="userForm.email" type="email" placeholder="putyouremail@here.com" />
                <ErrorForm name="email" />
            </div>
            <div>
                <label>Is Admin: </label>
                <input id="is_admin" v-model="userForm.is_admin" type="checkbox" value="0" />
            </div>
            <button type="submit" class="submit">Updaten</button>
        </form>
    </div>
</template>

<script setup lang="ts">

import { ref, defineEmits } from "vue";
import { UserForm } from "../types";
import ErrorMessage from "../../../services/error/ErrorMessage.vue";
import ErrorForm from "../../../services/error/ErrorForm.vue";

const props = defineProps<{
    user?: UserForm;
}>();

const emit = defineEmits<{
    (event: 'submit', payload: UserForm): void;
}>();

const userForm = ref<UserForm>({
    first_name: '',
    last_name: '',
    phone_number: '',
    email: '',
    is_admin: false,
    ...props.user

});

const updateUser = () => emit('submit', userForm.value);

</script>