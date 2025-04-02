import { ref, computed } from 'vue';
import axios from 'axios';
import { Book, Genre } from '../types';

// State
const books = ref<Book[]>([]);
const genres = ref<Genre[]>([]);
const isLoading = ref(false);
const error = ref<string | null>(null);


// Getters
export const getAllBooks = computed(() => books.value)
export const getBookById = (id: number) => computed(() => books.value.find(book => book.id == id));
export const getGenres = computed(() => genres.value)
export const getLoadingState = computed(() => isLoading.value);
export const getError = computed(() => error.value);


// Helper functions
export const modifyBook = (id: number, updatedBook: Book | null = null) => {
    const index = books.value.findIndex(book => book.id === id);
    if (index !== -1) {
        if (updatedBook) {
            books.value.splice(index, 1, updatedBook); // Update het book
        } else {
            books.value.splice(index, 1); // Verwijdert het boek
        }
    }
};

// Actions
export const fetchBooks = async (): Promise<void> => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.get<Book[]>('/api/books');
        books.value = response.data;
        console.log('Books state updated (fetchBooks)');
    } catch (err) {
        console.error('Error fetching books:', err);
        error.value = 'Failed to fetch books';
    } finally {
        isLoading.value = false;
    }    
};

export const createBook = async (newBook: Book): Promise<Book | null> => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.post<Book>(`/api/books', newBook`);
        books.value.push(response.data);
        console.log('Books state updated (createBook)');
        return response.data;
    } catch (err) {
        console.error('Error creating book:', err);
        error.value = 'Failed to create book';
        return null;
    } finally {
        isLoading.value = false;
    }
};
    // Update functie die helper functie gebruikt
export const updateBook = async (id: number, updatedBook: Book): Promise<Book | null> => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.put<Book>(`/api/books/${id}`, updatedBook);
        modifyBook(id, response.data);
        console.log('Books state updated (updateBook)');
        return response.data;
        } catch (err) {
            console.error('Error updating book:', err);
            error.value = 'Failed to update book';
            return null;
        } finally {
            isLoading.value = false;
        }
};

    // Delete functie die helper functie gebruikt
export const deleteBook = async (id:number): Promise<boolean> => {
    isLoading.value = true;
    error.value = null;

    try {
        await axios.delete(`/api/books/${id}`);
        modifyBook(id); // Verwijdert book wanneer er geen tweede parameter is
        console.log('Book removed from state (deleteBook)');
        return true;
    }  catch (err) {
        console.error('Error deleting book:', err);
        error.value = 'Failed to delete author';
        return false;
    } finally {
        isLoading.value = false;
    }
};

export const fetchGenres = async (): Promise<void> => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.get<Genre[]>('/api/genres');
        genres.value = response.data;
        console.log('Genres state updated (fetchGenres)');
    } catch (err) {
        console.error('Error fetching  genres:', err);
        error.value= 'Failed to fetch genres';
    } finally {
        isLoading.value = false;
    } 
};
