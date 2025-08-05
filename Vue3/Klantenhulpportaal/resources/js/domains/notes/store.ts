import { NOTE_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Note } from "./types";
import { computed } from "vue";


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
        }
    };

    return {
        ...NoteStore,
        extraGetters,
        extraActions,       
        }
    };


export const NoteStore = createNoteStore();


