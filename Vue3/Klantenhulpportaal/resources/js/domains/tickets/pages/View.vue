<template>
    <div v-if="ticket">
        <h3>Ticket Detail</h3>
        <section>
            <h2>{{ ticket.title }}</h2>
            <ul>
                <li><strong>Ticket id:</strong> {{ ticket.id }}</li>
                <li><strong>Categorieën:</strong>
                    <span v-for="(category, index) in ticket.category_details" :key="category.id">
                        {{ category.name }}<span v-if="index < ticket.categories.length - 1">, </span>
                    </span>
                </li>
                <li><strong>Status:</strong> {{ ticket.status_name }}</li>
                <li><strong>Aangemaakt door:</strong> {{ ticket.creator.first_name }}
                    {{ ticket.creator.last_name }}</li>
                <li><strong>Aangemaakt op:</strong> {{ formatDate(ticket.created_at) }}</li>
                <li><strong>Laatste update op:</strong> {{ formatDate(ticket.updated_at) }}</li>
                <li><strong>Uitleg:</strong> {{ ticket.content }}</li>

                <li><strong>Toegewezen aan:</strong>
                    <div v-if="!showAdminSelect">
                        <button @click="chooseHandler" v-if="isAdmin" class="btn-assign">
                            {{ ticket.handler?.first_name ?? 'Niet toegewezen' }}
                            {{ ticket.handler?.last_name ?? '' }}
                        </button>
                        <span v-else>
                            {{ ticket.handler?.first_name ?? 'Niet toegewezen' }}
                            {{ ticket.handler?.last_name ?? '' }}
                        </span>
                    </div>

                    <div v-else class="admin-select-container">
                        <select v-model="selectedAdminId" class="admin-select">
                            <option value="">-- Selecteer admin --</option>
                            <option v-for="admin in admins" :key="admin.id" :value="admin.id">
                                {{ admin.first_name }} {{ admin.last_name }}
                            </option>
                        </select>
                        <button @click="assignAdmin" class="btn btn-save" :disabled="!selectedAdminId">
                            Toewijzen
                        </button>
                        <button @click="cancelAssign" class="btn btn-cancel">
                            Annuleren
                        </button>
                    </div>
                </li>
            </ul>
        </section>


        <RouterLink :to="{ name: 'tickets.edit', params: { id: ticket.id } }" class="btn-edit">
            Wijzig ticket
        </RouterLink>

        <div v-if="isAdmin" class="notes mt-8">
            <NotesView :notes="ticket.notes || []" />
        </div>
        <div class="replies mt-8">
            <RepliesView :replies="ticket.replies || []" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
import { ticketStore } from '../store';
import { adminStore } from '../../auth/store';
import { computed, onMounted, ref } from 'vue';
import NotesView from '../../notes/components/NotesView.vue';
import RepliesView from '../../replies/components/RepliesView.vue';
import { formatRelativeTime } from '../../../services/helpers/dateHelper';
import { getRequest } from '../../../services/http';

const route = useRoute();
const ticketId = computed(() => Number(route.params.id));
const ticket = ticketStore.getters.byId(ticketId.value);

const showAdminSelect = ref(false);
const selectedAdminId = ref<number | string>('');
const isAdmin = ref(false);
const admins = computed(() => adminStore.adminGetters.admins.value);

const chooseHandler = async () => {
    if (!isAdmin.value) return

    showAdminSelect.value = true
    await adminStore.adminActions.getAllAdmins();

    if (ticket.value?.handler?.id) {
        selectedAdminId.value = ticket.value.handler.id;
    }
};

const checkAdminStatus = async () => {
    const response = await getRequest('/me');
    isAdmin.value = response?.data?.is_admin ?? false;
};

const assignAdmin = async () => {
    if (!selectedAdminId.value) return;

    await adminStore.adminActions.assignTicketToAdmin(
        ticket.value.id,
        Number(selectedAdminId.value)
    );

    await ticketStore.actions.getById(ticket.value.id);
    showAdminSelect.value = false
    selectedAdminId.value = ''
};

const cancelAssign = () => {
    showAdminSelect.value = false
    selectedAdminId.value = ''
}

const formatDate = formatRelativeTime;

onMounted(async () => {
    await ticketStore.actions.getById(ticketId.value);
    await adminStore.adminActions.getAllAdmins();
    checkAdminStatus();
});

</script>
<style scoped>
div {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

section {
    margin-top: 1rem;
    font-size: 0.9rem;
}

h2 {
    margin-bottom: 1rem;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 0.5rem;
}

strong {
    width: 140px;
    display: inline-block;
    color: #555;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-family: Arial, sans-serif;
    font-size: 0.95rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-left: 1rem;
    transition: filter 0.2s ease, transform 0.1s ease;
}


.btn-save {
    background-color: #007acc;
    color: #fff;
}

.btn-cancel {
    background-color: #f05353;
    color: #333;
    margin-left: 0.5rem;
}

.btn-assign {
    cursor: pointer;
}


.btn:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}


.btn:active {
    filter: brightness(0.9);
    transform: translateY(0);
}


.btn:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}
</style>