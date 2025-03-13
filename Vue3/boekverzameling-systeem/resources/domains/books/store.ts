import { ref, computed } from 'vue';
import axios from 'axios';

// State
interface Book {
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

const books = ref<Book[]>([]);

export const fetchBooks = async () => {
    const response = await axios.get<Book[]>('/api/books');
    if(!response.data) return
    books.value = response.data
};

// Getters
export const getAllBooks = computed(() => books.value)


// Actions
