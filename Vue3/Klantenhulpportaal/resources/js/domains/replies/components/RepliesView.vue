<template>
    <div class="replies-view">
        <RouterLink :to="{ name: 'replies.create', params: { ticketId: $route.params.id, } }" class="btn-create">
            Niewe reactie schrijven
        </RouterLink>

        <h3>Replies</h3>

        <table v-if="replies.length > 0">
            <thead>
                <tr>
                    <th>Door</th>
                    <th>Geschreven op</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template v-for="reply in repliesSortedByDate" :key="reply.id">
                    <tr @click="toggleExpand(reply.id)" class="reply-row">
                        <td>{{ reply.user?.name?.full_name || `${reply.user?.name?.first_name}
                            ${reply.user?.name?.last_name}` }}</td>
                        <td>{{ formatDate(reply.created_at) }}</td>
                        <td class="expand-indicator">
                            {{ expandedReplyId === reply.id ? '▼' : '▶' }}
                        </td>
                    </tr>
                    <tr v-if="expandedReplyId === reply.id" :key="`expanded-${reply.id}`" class="reply-content-row">
                        <td colspan="3" class="reply-content">
                            <div class="reply-content">
                                {{ reply.content }}
                            </div>
                            <div class="reply-action">
                                <RouterLink
                                    :to="{ name: 'replies.edit', params: { ticketId: route.params.id, replyId: reply.id } }"
                                    class="btn-edit">
                                    Wijzig
                                </RouterLink>
                                <button class="btn btn-delete" @click="deletereply(reply.id)">Delete</button>
                            </div>
                        </td>
                    </tr>

                </template>

            </tbody>
        </table>

        <div v-else class="no-replies">
            <p>Geen berichten beschikbaar voor dit ticket.</p>
        </div>
    </div>

</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { Reply } from '../types';
import { sortBy } from '../../../services/helpers/sortHelper';
import { replyStore } from '../store';
import { useRoute } from 'vue-router';

const props = defineProps<{
    replies: Reply[];
}>();

const route = useRoute();
const expandedReplyId = ref<number | null>(null);
const ticketId = computed(() => Number(route.params.id));


const repliesSortedByDate = computed<Readonly<Reply>[]>(() =>
    sortBy(
        props.replies,
        (reply: Reply) => reply.created_at,
        false
    )
);

const toggleExpand = (id: number) => {
    expandedReplyId.value = expandedReplyId.value === id ? null : id;
};

const deletereply = async (replyToDelete: number) => {
    if (confirm("Do you want to delete this reply?")) {
        console.log(ticketId.value, replyToDelete);
        replyStore.extraActions.deleteForReply(ticketId.value, replyToDelete);
    };
}
const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleString('nl-NL', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    });
};


</script>

<style scoped>
.replies-view {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

.no-replies {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #666;
    font-style: italic;
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
tbody tr.reply-row:nth-child(4n-3) {
    background-color: #fafafa;
}

/* Hover effect voor klikbare rijen */
tbody tr.reply-row:hover {
    background-color: #f0f8ff;
    cursor: pointer;
}

/* Titel styling */
h3 {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Reply content styling */
.reply-content-row {
    background-color: #f9f9f9 !important;
}

.reply-content {
    background-color: #f9f9f9;
    padding: 1rem 0.75rem;
    white-space: wrap;
    font-size: 0.85rem;
    line-height: 1.4;
    border-left: 3px solid #007acc;
    margin-bottom: 0.5rem;
}

/* Reply action buttons container */
.reply-action {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
}

/* Expand indicator */
.expand-indicator {
    text-align: center;
    width: 30px;
    font-size: 0.8rem;
    color: #666;
}

.reply-row .expand-indicator {
    transition: transform 0.2s ease;
}

/* Basis button styling */
.btn {
    display: inline-block;    
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* Create button */
.btn-create {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-bottom: 1rem;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-create:hover {
    background-color: #218838;
    transform: translateY(-1px);
}

.btn-create:active {
    background-color: #1e7e34;
    transform: translateY(0);
}

/* Delete button */
.btn-delete {
    background-color: #dc3545;
}

.btn-delete:hover {
    background-color: #c82333;
}

/* Edit button */
.btn-edit {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #007acc;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-edit:hover {
    background-color: #005fa3;
    transform: translateY(-1px);
}

.btn-edit:active {
    background-color: #004f8a;
    transform: translateY(0);
}

/* Button hover en focus effects */
.btn:hover, .btn-create:hover, .btn-edit:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}

.btn:active, .btn-create:active, .btn-edit:active {
    filter: brightness(0.9);
    transform: translateY(0);
}

.btn:focus, .btn-create:focus, .btn-edit:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}

</style>