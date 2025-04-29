import { Ref } from 'vue';

export interface Book {
  id: number;
  author_id: number;
  author?: Author;
  title: string;
  publisher: string;
  year: string;
  genre: string;
  edition: number;
  summary: string;
  created_at: string; 
  updated_at: string;
}

export interface Genre {
    id: number;
    name: string;
}

export interface Author {
  id: number;
  name: string;
  age: string;
  created_at: string;
  updated_at: string;
  books_count?: number;
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

export type State<T extends {id: number}> = Ref<{[id: number]: Readonly<T>}>;
export type New<T extends {id: number}> = Omit<T, 'id'>;
export type Updatable<T extends {id: number}> = New<T> & {
  id?: number;
};