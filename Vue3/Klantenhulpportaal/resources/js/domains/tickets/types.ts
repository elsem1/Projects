export interface Ticket {
    id: number,
    title: string,
    categories: Category[],
    content: string,
    status: number,
    created_by: number,
    handled_by?: number,
    created_at: string,
    updated_at?: string,
}

export interface Category {
    id: number,
    name: string,    
}