
import store from '@/store'
import axios, { AxiosInstance, AxiosResponse } from 'axios';

interface Headers {
    [x: string]: string | number
}

let baseService = class BaseService {    
    baseURL: any = process.env.VUE_APP_BASE_URL
    headers: object = Headers
    $http: AxiosInstance    
    constructor() {        

        this.headers = {
            'Content-Type': 'application/json',        
        }       

        this.$http = axios.create({
            timeout: 1600000
        });

        this.$http.interceptors.request.use((config: any) => {
            return config
        })

        this.$http.interceptors.response.use((response: any) => {
            return response
        })
    }



    getHeaders(additionalHeaders = {}, multipart = false) {        
        
        let defaultHeaders = this.headers;        

        return {
            ...defaultHeaders,
            ...additionalHeaders
        }
    }
    

    prepareUrl(url: string, params: any) {
        for (let index in params) {
            let identifier = ':' + index;
            url = url.replace(identifier, params[index]);
        }
        return url;
    }

    getQueryString(params: { [x: string]: string | number | boolean; }) {
        return (
            Object
                .keys(params)
                .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
                .join('&')
        )
    }

    post(uri: string, data: {}, additionalHeaders = {}) {
        return this.$http.post(uri, data, {
            headers: this.getHeaders(additionalHeaders),
        })
    }

    put(uri: any, data: any, additionalHeaders = {}) {
        return this.$http.put(uri, data, {
            headers: this.getHeaders(additionalHeaders),
        })
    }

    patch(uri: any, data: any, additionalHeaders = {}) {
        return this.$http.patch(uri, data, {
            headers: this.getHeaders(additionalHeaders),
        })
    }

    remove(uri: any, data: any, additionalHeaders = {}) {
        return this.$http(uri, {
            method: 'DELETE',
            headers: this.getHeaders(additionalHeaders), 
            data: data
        })
    }

    get(uri: string, data = {}, additionalHeaders = {}) {
        if (Object.keys(data).length > 0) {
            uri = `${uri}?${this.getQueryString(data)}`
        }

        return this.$http.get(uri, {
            headers: this.getHeaders(additionalHeaders),
        })
    }

    mcxGet(uri: string, data = {}, additionalHeaders = {}) {
        if (Object.keys(data).length > 0) {
            uri = `${uri}?${this.getQueryString(data)}`
        }

        return this.$http(uri, {
            method: 'GET',
            headers: {
                'Accept-Ranges': 'bytes',
                'Content-Type': 'application/json',
                'Connection': 'keep-alive'
            },
        })
    }
};

export default baseService
