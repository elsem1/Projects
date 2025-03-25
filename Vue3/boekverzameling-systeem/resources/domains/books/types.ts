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

export interface Genre {
    id: number;
    name: string;
}