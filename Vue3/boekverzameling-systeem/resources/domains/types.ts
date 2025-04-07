export interface Book {
   id: number;
   author_id: number;
   title: string;
   publisher: string;
   year: string;
   genre: string;
   edition: number;
   created_at: string;
   updated_at: string;
}

export interface BookFormData extends Omit<Book, 'id' | 'created_at' | 'updated_at'> {}

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

export interface AuthorFormData extends Omit<Author, 'id' | 'created_at' | 'updated_at'> {}

export interface ApiError {
   response?: {
     status: number;
     data: any;
   };
   message: string;
   config: any;
 }