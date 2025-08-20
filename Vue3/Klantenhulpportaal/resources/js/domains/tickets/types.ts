import { statusPriority } from ".";
import { User } from "../auth/types";
import { Note } from "../notes/types";
import { Reply } from "../replies/types";
import { Category } from "../categories/types";


export interface Ticket {
    id: number;
    title: string;
    categories: number[]; 
    category_details: Category[];   
    content: string;
    status_name: keyof typeof statusPriority;
    status_id: number;
    creator: User;
    handler?: User;
    notes?: Note[];
    replies?: Reply[];
    created_at: string;
    created_at_raw: string;
    updated_at: string;
    updated_at_raw?: string;
}

export interface TicketForm {
    title: string;
    content: string;
    status_id: number;
    categories: number[];
}



export interface Status {
    id: number,
    name: string,
}

