

export type Note = {
    id: number;
    ticket_id: number; 
    user_id: number;
    user: { 
        id: number;
        name: string 
    };
    content: string;
    created_at: string;
    updated_at: string;
};