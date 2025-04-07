import { ref, computed } from 'vue';
import type { Ref, ComputedRef } from 'vue';
import { Book, Genre, BookFormData } from '../types';
import { deleteRequest, getRequest, postRequest, putRequest } from '../../js/services/http/index';


type BookState = {
    books: Ref<Book[]>;
    genres: Ref<Genre[]>;
    isLoading: Ref<boolean>;
    error: Ref<string | null>;
};

// State
const state: BookState = {
    books: ref<Book[]>([]),
    genres: ref<Genre[]>([]),
    isLoading: ref(false),
    error: ref<string | null>(null),
};


// Getters
export const getAllBooks: ComputedRef<Book[]> = computed(() => state.books.value);
export const getBookById = (id: number): ComputedRef<Book | undefined> => 
    computed(() => state.books.value.find(book => book.id === id));
export const getGenres: ComputedRef<Genre[]> = computed(() => state.genres.value);
export const getLoadingState: ComputedRef<boolean> = computed(() => state.isLoading.value);
export const getError: ComputedRef<string | null> = computed(() => state.error.value);

// Helper functions
const modifyBook = (id: number, updatedBook: Book | null = null): void => {
    const index = state.books.value.findIndex(book => book.id === id);
    if (index !== -1) {
        updatedBook 
        ? state.books.value.splice(index, 1, updatedBook) // Update het book
        : state.books.value.splice(index, 1); // Verwijdert het boek
    }
};


// Actions
export const fetchBooks = async (): Promise<void> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
    const response = await getRequest<Book[]>('/books');
    state.books.value = response.data;
    } catch (err) {
    state.error.value = err instanceof Error ? err.message : 'Failed to fetch books';
    throw err;
    } finally {
    state.isLoading.value = false;
    }
};

export const createBook = async (bookData: BookFormData): Promise<Book> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
    const response = await postRequest<Book>('/books', bookData);
    state.books.value.push(response.data);
    return response.data;
    } catch (err) {
    state.error.value = err instanceof Error ? err.message : 'Failed to create book';
    throw err;
    } finally {
    state.isLoading.value = false;
    }
};

    // Update functie die helper functie gebruikt
export const updateBook = async (id: number, bookData: BookFormData): Promise<Book> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
        const response = await putRequest<Book>(`/books/${id}`, bookData);
        modifyBook(id, response.data);
        return response.data;
    } catch (err) {
        state.error.value = err instanceof Error ? err.message : 'Failed to update book';
        throw err;
    } finally {
        state.isLoading.value = false;
    }
};

    // Delete functie die helper functie gebruikt
export const deleteBook = async (id: number): Promise<void> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
    await deleteRequest(`/books/${id}`);
    modifyBook(id); // Verwijdert het boek wanneer er geen tweede parameter is
    } catch (err) {
    state.error.value = err instanceof Error ? err.message : 'Failed to delete book';
    throw err;
    } finally {
    state.isLoading.value = false;
    }
};

export const fetchGenres = async (): Promise<void> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
    const response = await getRequest<Genre[]>('/genres');
    state.genres.value = response.data;
    } catch (err) {
    state.error.value = err instanceof Error ? err.message : 'Failed to fetch genres';
    throw err;
    } finally {
    state.isLoading.value = false;
    }
};
