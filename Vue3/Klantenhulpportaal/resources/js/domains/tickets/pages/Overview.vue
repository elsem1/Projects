<template>
    <div>
        <title>Tickets Overzicht</title>

        <RouterLink :to="{ name: 'tickets.create' }" class="btn btn-create">
            + Nieuwe Ticket
        </RouterLink>


        <table id="tickets">
            <thead>
                <tr>
                    <th>Ticket id</th>
                    <th>Ticket titel</th>
                    <th>Categorieën</th>
                    <th>Status</th>
                    <th>Aangemaakt door</th>
                    <th>Aangemaakt op</th>
                    <th>Laatste update op</th>
                    <th>Toegewezen aan</th>
                </tr>
            </thead>
            <tbody>


                <tr v-for="ticket in ticketsSortedByDate" :key="ticket.id" @click="goToTicket(ticket.id)"
                    style="cursor: pointer;">

                    <td>{{ ticket.id }}</td>
                    <td>{{ ticket.title }}</td>
                    <td>
                        <span v-for="category in ticket.category_details" :key="category.id">
                            {{ category.name }}
                            <span v-if="!isLast(ticket.category_details, category)">, </span>
                        </span>
                    </td>
                    <td>{{ ticket.status_name }}</td>
                    <td>{{ ticket.creator.first_name }} {{ ticket.creator.last_name }}</td>
                    <td>{{ formatDate(ticket.created_at) }}</td>
                    <td>{{ formatDate(ticket.updated_at) }}</td>
                    <td>{{ ticket.handler?.first_name }} {{ ticket.handler?.last_name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { ticketStore } from '../store';
import { Category, Ticket } from '../types'
import { sortBy } from '../../../services/helpers/sortHelper';
import { statusPriority } from '..';
import { useRouter } from 'vue-router';
import { formatRelativeTime } from '../../../services/helpers/dateHelper';

const router = useRouter();
const tickets = ticketStore.getters.all;
onMounted(async () => {
    ticketStore.actions.getAll();
});

const formatDate = formatRelativeTime

function isLast(categories: Category[], category: Category) {
    return categories[categories.length - 1].id === category.id;
}
function goToTicket(id: number) {
    router.push({ name: 'tickets.view', params: { id } });
}

const ticketsSortedByDate = computed<Readonly<Ticket>[]>(() =>
    sortBy(
        tickets.value,
        (t: Ticket) => [
            statusPriority[t.status_name] ?? 99, // 1 = actief, 99 = afgesloten, kijkt eerst naar priority (allees tickets die nog in behandeling zijn)
            t.created_at_raw                   // sorteert daarna op chronologische volgorde, oudste eerst
        ] as const,
        false // ascending = oplopend: 1 komt voor 99
    )
);


</script>
<style scoped>
/* Container padding */
div {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;

}

/* Tabel basisstijl */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.9rem;
}

/* Headerstijl */
thead th {
    background-color: #f4f4f4;
    text-align: left;
    padding: 0.5rem 0.75rem;
    border-bottom: 2px solid #ddd;
}

/* Cell padding en border */
tbody td {
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #eee;
}

/* Wisselende rij-kleur voor leesbaarheid */
tbody tr:nth-child(even) {
    background-color: #fafafa;
}

/* Hover effect voor rijen */
tbody tr:hover {
    background-color: #f0f8ff;
}

/* Titel styling */
title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
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

.btn-create {
    position: absolute;
    top: 11rem;
    right: 4rem;
    background-color: #44d631;
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
