import { Ref } from "vue";

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

export interface ApiResponse<T> {
    data: T;
    success: boolean;
    message?: string;
}

export interface ApiError {
    response?: {
        status: number;
        data: any;
    };
    message: string;
    config: any;
}

export type State<T extends { id: number }> = Ref<{
    [id: number]: Readonly<T>;
}>;
export type New<T extends { id: number }> = Omit<T, "id">;
export type Updatable<T extends { id: number }> = New<T> & {
    id?: number;
};
