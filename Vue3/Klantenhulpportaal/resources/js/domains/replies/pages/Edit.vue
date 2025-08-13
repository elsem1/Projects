<template>
    <div class="edit">
        <h1>Bericht bewerken</h1>
        <Form v-if="reply" :reply="reply" :ticket-id="ticketId" @submit="handleSubmit" />
        <div v-else>Berichten worden geladen...</div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { replyStore } from '../store';
import { ReplyForm, Reply } from '../types';
import Form from '../components/RepliesForm.vue';
import { ticketStore } from '../../tickets/store';



const router = useRouter();
const route = useRoute();

const ticketId = computed(() => Number(route.params.ticketId));
const replyId = computed(() => Number(route.params.replyId));
ticketStore.actions.getById(ticketId.value);

const reply = computed(() => {
    const ticket = ticketStore.getters.byId(ticketId.value).value;
    if (!ticket || !ticket.replies) return null;
    return ticket.replies.find(reply => reply.id === replyId.value) || null;
});

onMounted(async () => {
    ticketStore.actions.getById(ticketId.value);
})

const handleSubmit = async (data: Reply) => {
    try {
        await replyStore.extraActions.updateForReply(ticketId.value, replyId.value, data);
        router.push({ name: 'tickets.view', params: { id: ticketId.value } });
    } catch (error) {
        console.error('Update error:', error);
    }
}


</script>