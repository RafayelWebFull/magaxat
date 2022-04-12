import axios from "axios";

export default axios.create({
    baseURL: "https://www.magaxat.com/api/",
    // baseURL: "https://seriousapp.test/api/",
    headers: {
        "Access-Control-Allow-Origin": "*",
        authorization: `Bearer ${
            window.uuxyz ? window.atob(window.uuxyz.uuxyzt) : null
            // window.Laravel ? window.Laravel.user.api_token : null
        }`,
    },
});
