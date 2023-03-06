export const login = async (email, password) => {
    await window.axios.get('/sanctum/csrf-cookie');

    return window.axios.post('/api/login', {
        email: email,
        password: password,
    });
}

export const getUser = async () => {
    return await window.axios.get('/api/user');
}
