import { ref, computed } from 'vue';
import { storeModuleFactory } from '../../js/services/store';
import { Book, Genre, BookFormData } from '../types';
import { deleteRequest, getRequest, postRequest, putRequest } from '../../js/services/http/index';


// Initialiseert de store module voor boeken met genres 
export const createBookStore = () => {
    const bookStore = storeModuleFactory<Book, BookFormData>('books');
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
        genreState,
        genreActions,
        genreGetters
    };
};

const bookStore = createBookStore();

// Haalt de lijst van boeken op bij het laden van component
bookStore.actions.getAll();

