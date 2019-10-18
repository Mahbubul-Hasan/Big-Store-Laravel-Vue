export default {
    state: {
        categories: [],
        offerProducts: [],
        popularProducts: [],
        products: [],
        singleProduct: [],
        relatedProducts: [],
        cartProducts: [],
        orders: [],
    },

    getters: {
        getCategories(state) {
            return state.categories;
        },
        getOfferProducts(state) {
            return state.offerProducts;
        },
        getPopularProducts(state) {
            return state.popularProducts;
        },
        getProducts(state) {
            return state.products;
        },
        getSingleProduct(state) {
            return state.singleProduct
        },
        getRelatedProducts(state) {
            return state.relatedProducts
        },
        getCartProducts(state) {
            return state.cartProducts
        },
        getOrders(state) {
            return state.orders
        },
    },

    actions: {
        categories(context) {
            axios.get("/categories").then(({data}) => {
                context.commit("categories", data);
            });
        },

        products(context) {
            axios.get("/products")
                .then(({data}) => {
                    context.commit("offerProducts", data.offerProducts);
                    context.commit("popularProducts", data.popularProducts);
                    context.commit("products", data.products);
                })
        },

        singleProduct(context, id) {
            axios.get("/singleProduct/" + id)
                .then(({data}) => {
                    context.commit("singleProduct", data)
                })
        },

        relatedProducts(context, id) {
            axios.get("/relatedProducts/" + id)
                .then(({data}) => {
                    context.commit("relatedProducts", data)
                })
        },

        categoryProducts(context, id) {
            axios.get("/categoryProducts/" + id)
                .then(({data}) => {
                    context.commit("products", data);
                })
        },

        cartProducts(context) {
            axios.get("/cartProducts")
                .then(({data}) => {
                    context.commit("cartProducts", data);
                })
        },


        adminCategory(context) {
            axios.get("/admin/categories").then(({data}) => {
                context.commit("categories", data);
            });
        },
        adminProduct(context) {
            axios.get("/admin/products").then(({data}) => {
                context.commit("products", data);
            });
        },
        adminOrder(context) {
            axios.get("/admin/orders").then(({data}) => {
                context.commit("orders", data);
            });
        },
    },

    mutations: {
        categories(state, data) {
            return state.categories = data;
        },
        offerProducts(state, data) {
            return state.offerProducts = data;
        },
        popularProducts(state, data) {
            return state.popularProducts = data;
        },
        products(state, data) {
            return state.products = data;
        },
        singleProduct(state, data) {
            return state.singleProduct = data
        },
        relatedProducts(state, data) {
            return state.relatedProducts = data
        },
        cartProducts(state, data) {
            return state.cartProducts = data
        },
        orders(state, data) {
            return state.orders = data
        },
    },
}

