import { ref, computed } from 'vue';
import { getRequest, putRequest, deleteRequest, postRequest } from '../http/index'
import type { Ref, ComputedRef } from 'vue';

export const storeModuleFactory = <T extends { id: number | string }>(moduleName: string) => {
    const state = ref({
        items: {} as Record<string | number, T>,
        isLoading: false,
        error: null as string | null
    });

    const getters = {
        all: computed(() => Object.values(state.value.items)),
        byId: (id: number | string) => computed(() => state.value.items[id]),
        isLoading: computed(() => state.value.isLoading),
        error: computed(() => state.value.error)
    };

    const setters = {
        setAll: (items: T[]) => {
            state.value.items = items.reduce((acc, item) => {
                acc[item.id] = Object.freeze(item);
                return acc;
            }, {} as Record<string | number, T>);
        },
        setItem: (item: T) => {
            state.value.items[item.id] = Object.freeze(item);
        },
        deleteItem: (id: number | string) => {
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
                state.value.error = error instanceof Error ? error.message : 'Request failed';
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },        
        create: async (item: Omit<T, 'id'>) => {
            state.value.isLoading = true;
            try {
                const { data } = await postRequest<T>(moduleName, item);
                if (data) setters.setItem(data);
                return data;
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : 'Create failed';
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },
        update: async (id: number | string, item: Partial<T>) => {
            state.value.isLoading = true;
            try {
                const { data } = await putRequest<T>(`${moduleName}/${id}`, item);
                if (data) setters.setItem(data);
                return data;
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : 'Update failed';
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        },
        delete: async (id: number | string) => {
            state.value.isLoading = true;
            try {
                await deleteRequest(`${moduleName}/${id}`);
                setters.deleteItem(id);
            } catch (error) {
                state.value.error = error instanceof Error ? error.message : 'Delete failed';
                throw error;
            } finally {
                state.value.isLoading = false;
            }
        }
    };


    return { getters, setters, actions };
};