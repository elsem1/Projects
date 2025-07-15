import { statusPriority } from ".";

export interface Ticket {
    id: number;
    title: string;
    categories: Category[];
    content: string;
    status_name: keyof typeof statusPriority;
    status_id: number
    creator: User;          
    handler?: User | null; 
    created_at: string;
    created_at_raw: string;
    updated_at?: string;
    updated_at_raw?: string;
}

export type TicketUpdate = {
    title: string,
    categories: Category[],
    status_id: number,
    content: string,
}

export interface Category {
    id: number,
    name: string,    
}

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    email_verified_at?: string;
    is_admin: boolean;
    phone_number: string;
    password: string;
    remember_token: string;
    created_at?: string;
    updated_at?: string;
}