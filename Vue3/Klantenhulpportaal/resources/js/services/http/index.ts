import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';
import { setErrorBag, setMessage, destroyErrors, destroyMessage } from '../error';
import router from '../router'

const http: AxiosInstance = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    withCredentials: true,
    timeout: 5000,
});

const initCsrf = async () => {
    try {
        await http.get('/sanctum/csrf-cookie');
    } catch (error) {
        console.error('CSRF-token ophalen mislukt:', error);
    }
};

http.interceptors.request.use(
    config => {
        destroyErrors(); // Wis oude foutmeldingen
        destroyMessage(); // Wis oude berichten
        return config;
    },
    error => Promise.reject(error)
);

http.interceptors.response.use(
    response => response, // Laat succesvolle responses door
    error => {
        const statusCode = error.response?.status;

        // Variabelen voor foutmeldingen en acties
        let message = 'Er is een fout opgetreden.';
        let action = () => {};

        // Switch op basis van statuscode
        switch (statusCode) {
            case 401: // Unauthorized
            message = 'Je bent niet ingelogd. Redirect naar login.';
            action = () => router.push({ name: 'login' });
            break;

        case 403: // Forbidden
            message = 'Je hebt geen toegang tot deze actie.';
            action = () => router.push({ name: 'forbidden' });
            break;

        case 404: // Not Found
            message = 'De gevraagde resource is niet gevonden.';
            action = () => router.push({ name: 'not-found' });
            break;

        case 422: // Unprocessable Entity
            message = error.response.data.message || 'Validatiefout.';
            setErrorBag(error.response.data.errors); // Sla validatiefouten op
            break;

        case 500: // Internal Server Error
            message = 'Er is een interne serverfout opgetreden.';
            action = () => console.error('Serverfout: neem contact op met support.');
            break;

        default: // Andere fouten
            message = 'Onverwachte fout. Probeer het later opnieuw.';
            break;
        }

        // Stel foutmelding in en voer de actie uit
        setMessage(message);
        action();

        // Gooi de fout verder door voor specifieke afhandeling elders
        return Promise.reject(error);
    }
);

export const getRequest = <T = any>(
    endpoint: string,
    config?: AxiosRequestConfig
    ): Promise<AxiosResponse<T>> => http.get<T>(endpoint, config);

export const postRequest = <T = any, D = any>(
    endpoint: string,
    data?: D,
    config?: AxiosRequestConfig
    ): Promise<AxiosResponse<T>> => http.post<T>(endpoint, data, config);

export const putRequest = <T = any, D = any>(
    endpoint: string,
    data?: D,
    config?: AxiosRequestConfig
    ): Promise<AxiosResponse<T>> => http.put<T>(endpoint, data, config);

export const deleteRequest = <T = any>(
    endpoint: string,
    config?: AxiosRequestConfig
    ): Promise<AxiosResponse<T>> => http.delete<T>(endpoint, config);


export { initCsrf };
export default http;