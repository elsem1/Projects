export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    password: string;
    remember_token: string;
    created_at?: string;
    updated_at?: string;
    is_admin: boolean;
}

export interface userLogin {
    email: String;
    password: String;
}


