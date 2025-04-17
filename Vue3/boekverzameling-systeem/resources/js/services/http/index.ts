import axios, { AxiosRequestConfig, AxiosResponse } from 'axios';
import { destroyErrors, destroyMessage } from '../error';
import { setErrorBag, setMessage } from '../error';

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

  http.interceptors.request.use(
    config => {
      destroyErrors(); // Wist oude fouten voordat een nieuw verzoek wordt uitgevoerd
      destroyMessage(); // Wist oude messages voordat een nieuw verzoek wordt uitgevoerd
      return config
    },
    error => Promise.reject(error)
  );

  http.interceptors.response.use(
    response => response,
    error => {
      if(error.response && error.response.status === 422) {
        setErrorBag(error.response.data.errors); // Slaat validatiefouten op in de error bag
        setMessage(error.response.data.message); // Slaat de algemene foutmelding op
      }
      return Promise.reject(error);
    }
  );
  
  export default http;