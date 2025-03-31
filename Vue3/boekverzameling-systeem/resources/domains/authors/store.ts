import { ref, computed } from 'vue';
import axios from 'axios';
import  { Author } from '../types';


// State
const authors = ref<Author[]>([]);


// Getters
export const getAllAuthors = computed(() => authors.value)
export const getAuthorById = (id: number) => {
    return computed(() => authors.value.find(author => author.id === id));
}


// Actions
export const fetchAuthors = async (): Promise<void> => {
    const response = await axios.get<Author[]>('/api/authors');
    if(!response.data) return
    authors.value = response.data
};

export const createAuthor = async (newAuthor: Author) => {
    const response = await axios.post<Author[]>(`/api/authors', newAuthor`);
    if(!response.data) return
    authors.value = response.data;
}

export const updateAuthor = async (id: Number, updatedAuthor: Author) => {
    const response = await axios.put<Author[]>(`/api/authors/${id}`, updatedAuthor);
    if(!response.data) return
    authors.value = response.data;
}

export const deleteAuthor = async (id:number) => {
    const response = await axios.delete<Author[]>(`/api/authors/${id}`);
    authors.value = authors.value.filter(author => author.id !== id);     
}

