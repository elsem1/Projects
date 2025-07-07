import { computed, ref } from 'vue';
import {registerRequestMiddleware, registerResponseErrorMiddleware} from '../http';
import {registerAfterMiddleware} from '../router/index';

interface ErrorBag {
    [property: string]: string[];
}

const errorBag = ref<ErrorBag>({});
const message = ref('');

export const getErrorBag = computed(() => errorBag.value);
export const getMessage = computed (() => message.value);

export const getErrorByProperty = (property: string) => computed(() => errorBag.value[property]);
export const setErrorByProperty = (property: string, error: string[]) => (errorBag.value[property] = error);

export const setErrorBag = (bag: ErrorBag) => (errorBag.value = bag);
export const setMessage = (newMessage: string) => {
    message.value = newMessage || 'Er is een fout opgetreden.';
};

export const destroyErrors = () => (errorBag.value = {});

registerAfterMiddleware(destroyErrors);
registerRequestMiddleware(destroyErrors);
registerResponseErrorMiddleware(({response}) => {
    if (!response || !response.data?.errors) return;
    setErrorBag(response.data.errors);
});

