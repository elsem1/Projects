<template>
    <div v-if="ticket">
        <title>Ticket Formulier</title>

        <section>

            <form @submit.prevent="submitForm">
                <ul>
                    <li>
                        <label for="title"><strong>Titel:</strong></label>
                        <input id="title" v-model="form.title" type="text" required />
                    </li>

                    <li>
                        <label><strong>Categorieën:</strong></label>
                        <select v-model="form.categories" multiple>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </li>

                    <li>
                        <label for="status"><strong>Status:</strong></label>
                        <select id="status" v-model="form.status_id" required>
                            <option v-for="status in status" :key="status.id" :value="status.id">
                                {{ status.name }}
                            </option>
                        </select>
                    </li>

                    <li>
                        <label for="content"><strong>Uitleg:</strong></label>
                        <textarea id="content" v-model="form.content" rows="5" required></textarea>
                    </li>

                    <li>
                        <button type="submit">Opslaan</button>
                    </li>
                </ul>
            </form>
        </section>
    </div>
</template>

<script setup lang="ts">
import { computed, reactive, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { ticketStore } from "../store";
import { CategoryStore } from "../../categories/store";
import { StatusStore } from "../../status/store";
import type { Category, Ticket, TicketUpdate } from "../types";
import { TicketStatus } from "../../status/types";

const route = useRoute();
const router = useRouter();
const ticketId = Number(route.params.id);
const categories = ref<Category[]>([]);
const status = ref<TicketStatus[]>([]);

const ticket = ticketStore.getters.byId(ticketId);

const form = reactive(<TicketUpdate>{
    title: "",
    categories: [],
    status_id: 1,
    content: "",
});

onMounted(async () => {
    await ticketStore.actions.getById(ticketId);
    const catData = await CategoryStore.actions.getAll();
    const statData = await StatusStore.actions.getAll();

    categories.value = CategoryStore.getters.all.value;
    status.value = StatusStore.getters.all.value;

    if (ticket.value) {
        form.title = ticket.value.title;
        form.categories = ticket.value.categories; //.map(c => c.id);
        form.status_id = ticket.value.status_id;
        form.content = ticket.value.content;
    }
});

async function submitForm() {
    try {
        await ticketStore.actions.update(ticketId, {
            title: form.title,
            categories: form.categories,
            status_id: form.status_id,
            content: form.content,
        });

        router.push(`/tickets/${ticketId}`);
    } catch (error) {
        console.error("Fout bij opslaan:", error);
    }
}

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
    max-width: 500px;
}

li {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

label {
    width: 140px;
    color: #555;
    font-weight: bold;
    display: inline-block;
}

input[type="text"],
select,
textarea {
    flex: 1;
    padding: 0.4rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.9rem;
    font-family: inherit;
}

button {
    padding: 0.6rem 1.2rem;
    background-color: #007bcc;
    border: none;
    border-radius: 4px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

button:hover {
    background-color: #005fa3;
}
</style>