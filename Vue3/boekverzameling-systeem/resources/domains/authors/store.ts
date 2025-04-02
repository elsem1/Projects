import { ref, computed } from 'vue';
import axios from 'axios';
import { Author } from '../types';

// State
const authors = ref<Author[]>([]);
const isLoading = ref(false);
const error = ref<string | null>(null);

// Getters
export const getAllAuthors = computed(() => authors.value);
export const getAuthorById = (id: number) => computed(() => authors.value.find(author => author.id === id));
export const getLoadingState = computed(() => isLoading.value);
export const getError = computed(() => error.value);

// Helper functions
export const modifyAuthor = (id: number, updatedAuthor: Author | null = null) => {
    const index = authors.value.findIndex(author => author.id === id);
    if (index !== -1) {
        if (updatedAuthor) {
            authors.value.splice(index, 1, updatedAuthor); // Update de auteur
        } else {
            authors.value.splice(index, 1); // Verwijdert de auteur
        }
    }
};

// Actions
export const fetchAuthors = async (): Promise<void> => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.get<Author[]>('/api/authors');
        authors.value = response.data;
        console.log('Authors state updated (fetchAuthors)');
    } catch (err) {
        console.error('Error fetching authors:', err);
        error.value = 'Failed to fetch authors';
    } finally {
        isLoading.value = false;
    }
};

export const createAuthor = async (newAuthor: Author): Promise<Author | null> => {
isLoading.value = true;
error.value = null;

    try {
        const response = await axios.post<Author>(`/api/authors`, newAuthor);
        authors.value.push(response.data);
        console.log('Authors state updated (createAuthor)');
        return response.data;
    } catch (err) {
        console.error('Error creating author:', err);
        error.value = 'Failed to create author';
        return null;
    } finally {
        isLoading.value = false;
    }
};

    // Update functie die helper function gebruikt
export const updateAuthor = async (id: number, updatedAuthor: Author): Promise<Author | null> => {
isLoading.value = true;
error.value = null;

    try {
        const response = await axios.put<Author>(`/api/authors/${id}`, updatedAuthor);
        modifyAuthor(id, response.data);
        console.log('Authors state updated (updateAuthor)');
        return response.data;
    } catch (err) {
        console.error('Error updating author:', err);
        error.value = 'Failed to update author';
        return null;
    } finally {
        isLoading.value = false;
    }
};

    // Delete functie die helper function gebruikt
export const deleteAuthor = async (id: number): Promise<boolean> => {
isLoading.value = true;
error.value = null;

    try {
        await axios.delete(`/api/authors/${id}`);
        modifyAuthor(id); // Geen tweede parameter betekent verwijderen
        console.log('Author removed from state (deleteAuthor)');
        return true;
    } catch (err) {
        console.error('Error deleting author:', err);
        error.value = 'Failed to delete author';
        return false;
    } finally {
        isLoading.value = false;
    }
};