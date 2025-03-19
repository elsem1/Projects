import { ref, computed } from 'vue';
import axios from 'axios';

// State
interface Author {
   id: number;
   name: string;
   age: string;
   created_at: string;
   updated_at: string;
}

const authors = ref<Author[]>([]);


// Getters
export const getAllAuthors = computed(() => authors.value)
export const getAuthorById = (id: number) => computed(() => authors.value.find(author => author.id === id))


// Actions
export const fetchAuthors = async (): Promise<void> => {
    try {
        const response = await axios.get<Author[]>('/api/authors');
        if(response.data) {
        authors.value = response.data
        }
    } catch (error) {
        console.error('Fout bij het ophalen van de autheurs', error);
    }
};