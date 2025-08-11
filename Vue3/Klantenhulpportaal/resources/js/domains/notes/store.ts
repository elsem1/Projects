import { NOTE_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Note } from "./types";
import { computed } from "vue";
import { putRequest } from "../../services/http";


const createNoteStore = () => {
    const NoteStore = storeModuleFactory<Note>(NOTE_DOMAIN_NAME);
    const extraGetters = {
        byTicketId: (ticketId: number) => computed(() => {
            return NoteStore.getters.all.value.filter(
            (note:Note) => note.ticket_id=== ticketId)
        })
    };
    
    const extraActions = {
    async getByTicketId(ticketId: number) {
        try {
            await NoteStore.actions.getAll();
        } catch (error) {
            console.error('Error fetching notes for ticket:', error);
            throw error;
        }
    },

    async updateForTicket(ticketId: number, noteId: number, data: Partial<Note>) {
        const { data: updatedNote } = await putRequest(`tickets/${ticketId}/notes/${noteId}`, data);
        if (updatedNote) {
            NoteStore.setters.setById(updatedNote);
        }
    }
};


    return {
        ...NoteStore,
        extraGetters,
        extraActions,       
        }
    };


export const NoteStore = createNoteStore();


