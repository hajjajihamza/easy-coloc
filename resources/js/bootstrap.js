import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Global Loader Logic
let activeRequests = 0;
const loader = document.getElementById('global-loader');

const showLoader = () => {
    activeRequests++;
    if (loader && activeRequests === 1) {
        loader.classList.remove('hidden');
    }
};

const hideLoader = () => {
    activeRequests = Math.max(0, activeRequests - 1);
    if (loader && activeRequests === 0) {
        loader.classList.add('hidden');
    }
};

window.axios.interceptors.request.use(config => {
    showLoader();
    return config;
}, error => {
    hideLoader();
    return Promise.reject(error);
});

window.axios.interceptors.response.use(response => {
    hideLoader();
    return response;
}, error => {
    hideLoader();
    return Promise.reject(error);
});
