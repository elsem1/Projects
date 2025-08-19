export interface User {
    id: number;
    first_name: string;
    last_name: string;
    email: string;    
    email_verified_at?: string;
    is_admin: boolean;
    phone_number: string;     
    created_at?: string;
    updated_at?: string;
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

export interface UserForgot {
    email: string;
}

export interface UserReset {
    password: string;
    token: string;
}


export interface UserLogin {
    email: string;
    password: string;
    remember: boolean;
}

export interface UserPreview {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    is_admin: boolean;
    phone_number: string;
}

export interface CurrentUser extends UserPreview {
    email_verified_at?: string;
    created_at?: string;
    updated_at?: string;
}