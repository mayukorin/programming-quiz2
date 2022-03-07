import axios from "axios";
import store from "../store/index";


const api = axios.create({
  baseURL: process.env.MIX_VUE_APP_ROOT_API,
  timeout: 50000,
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
      console.log("tokenあり");
      config.headers.Authorization = "bearer " + token;
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
    /*
    console.log("error.resposnse=", error.response);
    const status = error.response ? error.response.status : 500;
    let messages;
    if (status === 400) {
      messages = [].concat.apply([], Object.values(error.response.data["message"]));
      console.log(error.response.data);
      console.log(messages);
    } 
    console.log(messages);
    */
    console.log("error.resposnse=", error.response);
    const status = error.response ? error.response.status : 500;
    let messages;
    if (status === 400) {
      messages = [].concat.apply([], Object.values(error.response.data));
      console.log(error.response.data);
      console.log(messages);
      store.dispatch("flashMessage/setWarningMessages", { messages: messages });
    } else if (status === 403) {
      messages = [].concat.apply([], ["権限がありません．"]);
      store.dispatch("flashMessage/setErrorMessage", { messages: messages });
    } else if (status === 401) {
      const token = localStorage.getItem("access");
      let error_messages;
      if (token != null) {
        error_messages = "ログインの有効期限切れです．";
      } else {
        error_messages =
          "パスワード・メールアドレスに誤りがあるか，登録されていません．";
      }
      messages = [].concat.apply([], [error_messages]);
      store.dispatch("auth/signout");
      console.log("メッセージセット");
      store.dispatch("flashMessage/setErrorMessage", { messages: messages });
    } else if (status === 404) {
      messages = [].concat.apply([], Object.values(error.response.data));
      console.log(error.response.data);
      console.log(messages);
      store.dispatch("flashMessage/setWarningMessages", { messages: messages });
    } else {
      messages = [].concat.apply([], ["想定外のエラーです．"]);
      store.dispatch("flashMessage/setErrorMessage", { messages: messages });
    }
    console.log(messages);
    return Promise.reject(error);
  }
);

export default api;
