import axios, { AxiosRequestConfig, AxiosResponse } from 'axios';

const http = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    }
});

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
  
  export default http;