import { ref, computed } from 'vue';
import type { Ref, ComputedRef } from 'vue';
import { Author, AuthorFormData } from '../types';
import { deleteRequest, getRequest, postRequest, putRequest } from '../../js/services/http/index';

type AuthorState = {
    authors: Ref<Author[]>;
    isLoading: Ref<boolean>;
    error: Ref<string | null>;
};

// State
const state: AuthorState = {
    authors: ref<Author[]>([]),
    isLoading: ref(false),
    error: ref<string | null>(null),
};

// Getters
export const getAllAuthors: ComputedRef<Author[]> = computed(() => state.authors.value);
export const getAuthorById = (id: number): ComputedRef<Author | undefined> => 
    computed(() => state.authors.value.find(author => author.id === id));
export const getLoadingState: ComputedRef<boolean> = computed(() => state.isLoading.value);
export const getError: ComputedRef<string | null> = computed(() => state.error.value);

// Helper functions
const modifyAuthor = (id: number, updatedAuthor: Author | null = null): void => {
    const index = state.authors.value.findIndex(author => author.id === id);
    if (index !== -1) {
        updatedAuthor 
        ? state.authors.value.splice(index, 1, updatedAuthor) // Update de auteur
        : state.authors.value.splice(index, 1); // Verwijderd de auteur
    }
};

// Actions
export const fetchAuthors = async (): Promise<void> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
        const response = await getRequest<Author[]>('/authors');
        state.authors.value = response.data;
    } catch (err) {
        state.error.value = err instanceof Error ? err.message : 'Failed to fetch authors';
        throw err; 
    } finally {
        state.isLoading.value = false;
    }
};

export const createAuthor = async (authorData: AuthorFormData): Promise<Author> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
        const response = await postRequest<Author>('/authors', authorData);
        state.authors.value.push(response.data);
        return response.data;
    } catch (err) {
        state.error.value = err instanceof Error ? err.message : 'Failed to create author';
        throw err;
    } finally {
        state.isLoading.value = false;
    }
};

export const updateAuthor = async (id: number, authorData: AuthorFormData): Promise<Author> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
        const response = await putRequest<Author>(`/authors/${id}`, authorData);
        modifyAuthor(id, response.data);
        return response.data;
    } catch (err) {
        state.error.value = err instanceof Error ? err.message : 'Failed to update author';
        throw err;
    } finally {
        state.isLoading.value = false;
    }
};

export const deleteAuthor = async (id: number): Promise<void> => {
    state.isLoading.value = true;
    state.error.value = null;

    try {
        await deleteRequest(`/authors/${id}`);
        modifyAuthor(id);
    } catch (err) {
        state.error.value = err instanceof Error ? err.message : 'Failed to delete author';
        throw err;
    } finally {
        state.isLoading.value = false;
    }
};