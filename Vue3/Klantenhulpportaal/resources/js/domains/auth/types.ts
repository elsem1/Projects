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

export interface UserLogin {
    email: string;
    password: string;
    remember: boolean;
}