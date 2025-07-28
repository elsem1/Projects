<template>
    <div>
        <title>Tickets Overzicht</title>

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
                        <span v-for="category in categories" :key="category.id">
                            {{ category.name }}
                            <span v-if="!isLast(categories, category)">, </span>
                        </span>
                    </td>
                    <td>{{ ticket.status_name }}</td>
                    <td>{{ ticket.creator.first_name }} {{ ticket.creator.last_name }}</td>
                    <td>{{ ticket.created_at }}</td>
                    <td>{{ ticket.updated_at }}</td>
                    <td>{{ ticket.handler?.first_name }} {{ ticket.handler?.last_name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup lang="ts">
import { computed } from 'vue';
import { TicketStore } from '../store';
import { Category, Ticket } from '../types'
import { sortBy } from '../../../services/helpers/sortHelper';
import { statusPriority } from '..';
import { useRouter } from 'vue-router';
import { CategoryStore } from '../../categories/store';


const router = useRouter();

const tickets = TicketStore.getters.all;
const categories = CategoryStore.getters.all;
TicketStore.actions.getAll();


function isLast(categories: Category[], category: Category) {
    return categories[categories.length - 1].id === category.id;
}
function goToTicket(id: number) {
    router.push({ name: 'tickets.view', params: { id } });
}

const ticketsSortedByDate = computed<Readonly<Ticket>[]>(() => 
    sortBy(tickets.value, t =>
        `${statusPriority[t.status_name]}-${t.created_at_raw}`) // Kijkt eerst naar priority (allees tickets die nog in behandeling zijn)
);                                                              // sorteert daarna op chronologische volgorde, oudste eerst

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
</style>
