import { REPLY_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Reply, ReplyForm } from "./types";
import { computed } from "vue";
import { deleteRequest, getRequest, postRequest, putRequest } from "../../services/http";


const createReplyStore = () => {
    const replyStore = storeModuleFactory<Reply>(REPLY_DOMAIN_NAME);
    const extraGetters = {
        byTicketId: (ticketId: number) => computed(() => {
            return replyStore.getters.all.value.filter(
            (reply: Reply) => reply.ticket_id=== ticketId)
        })
    };
    
    const extraActions = {        
    async getByTicketId(ticketId: number) {
        try {
            const response = await getRequest(`tickets/${ticketId}/replies`);
            replyStore.setters.setAll(response.data);
        } catch (error) {
            console.error('Error fetching replies for ticket:', error);
            throw error;
        }
    },

    async updateForReply(ticketId: number, replyId: number, data: Partial<Reply>) {
        const { data: updatedReply } = await putRequest(`tickets/${ticketId}/replies/${replyId}`, data);
        if (updatedReply) {
            replyStore.setters.setById(updatedReply);
        }
    },

    async createForReply(ticketId: number, data: ReplyForm) {
        const { data: newReply } = await postRequest(`tickets/${ticketId}/replies`, data);
        if (newReply) {
            replyStore.setters.setById(newReply);
        }
    },

    async deleteForReply(ticketId: number, replyId: number) {
        await deleteRequest(`tickets/${ticketId}/Replies/${replyId}`);
        replyStore.setters.deleteById(replyId);
    }

};


    return {
        ...replyStore,
        extraGetters,
        extraActions,       
        }
    };


export const replyStore = createReplyStore();


