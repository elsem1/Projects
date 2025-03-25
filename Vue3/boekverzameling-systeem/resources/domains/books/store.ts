import { ref, computed } from 'vue';
import axios from 'axios';
import { Book, Genre } from '../books/types';

// State
const books = ref<Book[]>([]);
const genres = ref<Genre[]>([]);


// Getters
export const getAllBooks = computed(() => books.value)
export const getBookById = (id: number) => computed(() => books.value.find(book => book.id === id))
export const getGenres = computed(() => genres.value)


// Actions
export const fetchBooks = async (): Promise<void> => {
    const response = await axios.get<Book[]>('/api/books');
    if(!response.data) return
    books.value = response.data
};

export const createBook = async (newBook: Book) => {
    const response = await axios.post<Book[]>('/api/books', newBook);
    if(!response.data) return
    books.value = response.data;
}

export const fetchGenres = async (): Promise<void> => {
    const response = await axios.get<Genre[]>('/api/genres');
    if (!response.data) return
    genres.value = response.data
}
