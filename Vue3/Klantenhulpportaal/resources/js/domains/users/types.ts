export interface User {
    id: number,
    first_name: string,
    last_name: string,
    email: string,
    phone_number: string,
    is_admin: boolean; 
}

export interface UserForm {
    first_name: string;
    last_name: string;
    email: string;
    phone_number: string;
    is_admin: boolean;
}

export interface UserRegister {
    first_name: string;
    last_name: string;
    email: string;    
    email_confirmation?: string;
    password: string;
    phone_number: string;
    is_admin: number;
}