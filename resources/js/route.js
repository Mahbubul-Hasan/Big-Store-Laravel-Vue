export const routes = [
    { path: "/", component: require("./components/front/HomeComponent.vue").default },
    { path: "/singleProduct/:id", component: require("./components/front/SingleProductComponent.vue").default },
    { path: "/categoryProducts/:id", component: require("./components/front/HomeComponent.vue").default },
    { path: "/cart", component: require("./components/front/CartComponent.vue").default },
    { path: "/checkout", component: require("./components/front/CheckoutComponent.vue").default},



    { path: "/admin/home", component: require("./components/admin/HomeComponent.vue").default },
    { path: "/admin/category", component: require("./components/admin/CategoryComponent.vue").default },
    { path: "/admin/product", component: require("./components/admin/ProductComponent.vue").default },
    { path: "/admin/order", component: require("./components/admin/OrderComponent.vue").default },
];
