import axios from "axios";

const api = axios.create({
  baseURL: process.env.VUE_APP_ROOT_API,
  timeout: 5000,
  headers: {
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest",
  },
});

api.interceptors.request.use(
  (config) => {
    // store.dispatch("flashMessage/clearMessages");
    const token = localStorage.getItem("access");
    if (token) {
      config.headers.Authorization = "JWT " + token;
      return config;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

api.interceptors.response.use(
  (response) => {
    /*
    if (store.state.message.keep_info) {
      store.dispatch("flashMessage/setSuccessMessage", {
        message: store.state.message.keep_info,
      });
      store.dispatch("flashMessage/clearKeepInfoMessage");
    }
    */
    return response;
  },
  (error) => {
    console.log("error.resposnse=", error.response);
    return Promise.reject(error);
  }
);

export default api;
