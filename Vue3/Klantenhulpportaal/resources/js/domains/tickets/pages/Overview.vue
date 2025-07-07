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
                <tr v-for="ticket in tickets" :key="ticket.id">
                    <td>{{ ticket.id }}</td>
                    <td>
                        <span v-for="category in ticket.categories" :key="category.id">
                            {{ category.name }}
                        <span v-if="!isLast(ticket.categories, category)">, </span>
                        </span>
                    </td>
                    <td>{{ ticket.status }}</td>
                    <td>{{ ticket.created_by }}</td>
                    <td>{{ ticket.created_at }}</td>
                    <td>{{ ticket.updated_at }}</td>
                    <td>{{ ticket.handled_by }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup lang="ts">
import { ticketStore } from '../store';
import { Category } from '../types'


function isLast(categories: Category[], category: Category) {
    return categories[categories.length - 1].id === category.id;
}

const tickets = ticketStore.getters.all;

ticketStore.actions.getAll();

</script>
<style>
</style>