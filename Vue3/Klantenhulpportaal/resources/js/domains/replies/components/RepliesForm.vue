<template>
    <ErrorMessage />

    <div v-if="reply">
        <section>
            <form @submit.prevent="handleSubmit">
                <label for="content"><strong>Bericht:</strong></label>
                <textarea id="content" v-model="form.content" rows="5" required />
                <ErrorForm name="content" />

                <RouterLink :to="{ name: 'tickets.view', params: { id: $route.params.ticketId } }"
                    class="btn btn-cancel">
                    Cancel
                </RouterLink>

                <button class="btn btn-submit" type="submit">Opslaan</button>
            </form>
        </section>
    </div>
</template>


<script setup lang="ts">
import ErrorMessage from '../../../services/error/ErrorMessage.vue';
import ErrorForm from '../../../services/error/ErrorForm.vue';
import { reactive, defineProps, defineEmits, onMounted } from 'vue';
import { ReplyForm } from '../types';

const emit = defineEmits(['submit']);

const props = defineProps<{
    reply: {
        content: string;
    };
    ticketId?: number;
}>();

const form = reactive<ReplyForm>({
    ...props.reply
});

const handleSubmit = () => emit('submit', form);
</script>