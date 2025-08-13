<template>
    <div class="create">
        <h1>Bericht toevoegen</h1>
        <Form :reply="reply" @submit="handleSubmit" />
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { replyStore } from '../store';
import { ticketStore } from '../../tickets/store';
import { ReplyForm } from '../types';
import Form from '../components/RepliesForm.vue';



const router = useRouter();
const route = useRoute();
const reply = ref<ReplyForm>({
    content: '',
});


const ticketId = computed(() => Number(route.params.ticketId));
ticketStore.actions.getById(ticketId.value);


const handleSubmit = async (data: ReplyForm) => {
    await replyStore.extraActions.createForReply(ticketId.value, data);
    router.push({ name: 'tickets.view', params: { id: ticketId.value } });
};


</script>