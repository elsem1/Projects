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


// Getters
export const getAllBooks = computed(() => books.value)
export const getBookById = (id: number) => computed(() => books.value.find(book => book.id === id))


// Actions
export const fetchBooks = async () => {
    const response = await axios.get('/api/books');
    if(!response.data) return
    books.value = response.data
};
