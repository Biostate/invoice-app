export const getInvoices = (page = 1) => {
    return window.axios.get(`/api/invoices?page=${page}`);
};

export const getInvoice = (id) => {
    return window.axios.get(`/api/invoices/${id}`);
}
