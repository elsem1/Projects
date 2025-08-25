<template>
    <div class="user-container">        
        <h3>Alle Gebruikers</h3>
        <div v-if="!user" class="loading">
            Gebruiker niet gevonden of aan het laden...
        </div>
        <table v-else>
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>E-mail Adres</th>
                    <th>Telefoonnummer</th>
                </tr>
            </thead>
            <tbody>                
                <tr v-for="user in usersSortedByName" :key="user.id">
                    <td>{{ user.first_name }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone_number }}</td>
                    
                    <td class="user-action">
                        <RouterLink
                            :to="{ name: 'users.edit', params: { userId: user.id } }"
                            class="btn btn-edit">
                            Wijzig
                        </RouterLink>
                        <button class="btn btn-delete" @click="deleteUser(user.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { userStore } from '../store';
import { User } from '../types';
import { sortBy } from '../../../services/helpers/sortHelper';

const route = useRoute();
const userId = computed(() => Number(route.params.userId)).value;

const users = computed(() => {
    return userStore.getters.all.value;
});

const deleteUser = async (id: number) => {
    try {
        await userStore.actions.delete(id);        
    } catch (error) {
        console.error('Error deleting user:', error);
    }
};

const usersSortedByName = computed<Readonly<User>[]>(() =>
    sortBy(
        users.value,
        (user: User) => user.first_name,            
        false 
    )
);

onMounted(async () => {
    await userStore.actions.getAll();
});
</script>