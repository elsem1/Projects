import { NOTE_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Note, NoteForm } from "./types";
import { computed } from "vue";
import { deleteRequest, getRequest, postRequest, putRequest } from "../../services/http";


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
            const response = await getRequest(`tickets/${ticketId}/notes`);
            NoteStore.setters.setAll(response.data);
        } catch (error) {
            console.error('Error fetching notes for ticket:', error);
            throw error;
        }
    },

    async updateForNote(ticketId: number, noteId: number, data: Partial<Note>) {
        const { data: updatedNote } = await putRequest(`tickets/${ticketId}/notes/${noteId}`, data);
        if (updatedNote) {
            NoteStore.setters.setById(updatedNote);
        }
    },

    async createForNote(ticketId: number, data: NoteForm) {
        const { data: newNote } = await postRequest(`tickets/${ticketId}/notes`, data);
        if (newNote) {
            NoteStore.setters.setById(newNote);
        }
    },

    async deleteForNote(ticketId: number, noteId: number) {
        await deleteRequest(`tickets/${ticketId}/notes/${noteId}`);
        NoteStore.setters.deleteById(noteId);
    }

};


    return {
        ...NoteStore,
        extraGetters,
        extraActions,       
        }
    };


export const NoteStore = createNoteStore();


