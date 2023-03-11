export const getInvoices = (page = 1) => {
    return window.axios.get(`/api/invoices?page=${page}`);
};

export const getInvoice = (id) => {
    return window.axios.get(`/api/invoices/${id}`);
}

export const storeInvoice = (formData) => {
    return window.axios.post(`/api/invoices`, formData);
}

export const updateInvoice = (id, formData) => {
    return window.axios.post(`/api/invoices/${id}`, formData);
}

export const deleteInvoice = (id) => {
    return window.axios.delete(`/api/invoices/${id}`);
}
