import { ref, computed } from 'vue';
import { storeModuleFactory } from '../../js/services/store';
import { Book, Genre } from '../types';
import { getRequest } from '../../js/services/http';


// Initialiseert de store module voor boeken met genres 
const createBookStore = () => {
    const bookStore = storeModuleFactory<Book>('books');
    const genreState = ref<{
        genres: Genre[];
        isLoading: boolean;
        error: string | null;
    }>({
        genres: [],
        isLoading: false,
        error: null
    });

    const genreActions = {
        fetchGenres: async () => {
            genreState.value.isLoading = true;
            genreState.value.error = null;
            try {
                const { data } = await getRequest<Genre[]>('/genres');
                genreState.value.genres = data || [];
            } catch (error) {
                genreState.value.error = error instanceof Error ? error.message : 'Failed to fetch genres';
                throw error;
            } finally {
                genreState.value.isLoading = false;
            }
        }
    };

    const genreGetters = {
        genres: computed(() => genreState.value.genres),
        genresLoading: computed(() => genreState.value.isLoading),
        genresError: computed(() => genreState.value.error)
    };

    return {
        ...bookStore,        
        genreActions,
        genreGetters
    };
};

export const bookStore = createBookStore();




