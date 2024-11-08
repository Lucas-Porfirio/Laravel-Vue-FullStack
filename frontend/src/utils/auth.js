import axios from "../axios";

const isAuthenticated = async () => {
    return await axios
        .get("/user", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        })
        .then(() => true)
        .catch(() => false);
};

export { isAuthenticated };
