import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';
import type {RequestMiddleware, ResponseErrorMiddleware, ResponseMiddleware} from './types';


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
const requestMiddleware: RequestMiddleware[] = [];
const responseMiddleware: ResponseMiddleware[] = [];
const responseErrorMiddleware: ResponseErrorMiddleware[] = [];


http.interceptors.request.use(request => {
    for (const middleware of requestMiddleware) middleware(request);

    return request;
});

http.interceptors.response.use(
    response => {
        for (const middleware of responseMiddleware) middleware(response);

        return response;
    },
    // eslint-disable-next-line promise/prefer-await-to-callbacks
    error => {
        if (!error.response) return Promise.reject(error);
        for (const middleware of responseErrorMiddleware) middleware(error);

        return Promise.reject(error);
    },
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

export const registerRequestMiddleware = (middlewareFunc: RequestMiddleware) => requestMiddleware.push(middlewareFunc);
export const registerResponseMiddleware = (middlewareFunc: ResponseMiddleware) =>
    responseMiddleware.push(middlewareFunc);
export const registerResponseErrorMiddleware = (middlewareFunc: ResponseErrorMiddleware) =>
    responseErrorMiddleware.push(middlewareFunc);



export { initCsrf };
export default http;