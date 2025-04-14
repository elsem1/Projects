import { ref, computed } from 'vue';
import { getRequest, putRequest, deleteRequest, postRequest } from '../http/index'
import { New, State, Updatable} from '../../../domains/types'


const singularNames: Record<string, string> = {
    books: "book",
    authors: "author",
};

export const storeModuleFactory = <T extends { id: number }>(moduleName: string) => {
    const state = ref({
        items: {} as Record<string | number, T>,
        isLoading: false,
        error: null as string | null
    });

    const getters = {
        all: computed(() => Object.values(state.value.items)),
        byId: (id: number) => computed(() => state.value.items[id]),
        isLoading: computed(() => state.value.isLoading),
        error: computed(() => state.value.error)
    };

    const setters = {
        setAll: (items: T[]) => {
            const newItems = {} as Record<string | number, T>;
            for (const item of items) {
                newItems[item.id] = Object.freeze(item);
            }
            state.value.items = newItems;
        },
        setById: (item: T) => {
            state.value.items[item.id] = Object.freeze(item);
        },
        deleteById: (id: T['id']) => {
            delete state.value.items[id];
        }        
    };

    const actions = {
        getAll: async () => {
            state.value.isLoading = true;
            state.value.error = null;
            try {
                const { data } = await getRequest<T[]>(moduleName);
                if (data) setters.setAll(data);
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : `Request getAll ${moduleName} failed`;
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },
        getById: async (id: number) => {
            state.value.isLoading = true;
            state.value.error = null;
            try {
                const {data} = await getRequest(`${moduleName}/${id}`);
                if (data) setters.setById(data);                    
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : `Request getById ${singularNames[moduleName]} failed`;
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },       
        create: async (newItem: New<T>) => {
            state.value.isLoading = true;
            try {
                const { data } = await postRequest<T>(moduleName, newItem);
                if (data) setters.setById(data);
                return data;
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : `Failed to create ${singularNames[moduleName]}`;
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },
        update: async (id: number, item: Updatable<T>) => {
            state.value.isLoading = true;
            try {
                const { data } = await putRequest<T>(`${moduleName}/${id}`, item);
                if (data) setters.setById(data);
                return data;
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : `Failed to update ${singularNames[moduleName]}`;
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },
        delete: async (id: number) => {
            state.value.isLoading = true;
            try {
                await deleteRequest(`${moduleName}/${id}`);
                setters.deleteById(id);
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : `Failed to delete ${singularNames[moduleName]}`;
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        }
    };


    return { getters, setters, actions };
};