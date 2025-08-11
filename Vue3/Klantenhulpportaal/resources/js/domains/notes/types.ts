

export interface Note {
    id: number;
    content: string;
    ticket_id: number;
    user_id: number;
    user: {
        id: number;
        name: {
            first_name: string;
            last_name: string;
            full_name: string;
        };
    };
    created_at: string;
    updated_at: string;
}

export interface NoteForm {
    content: string;
}