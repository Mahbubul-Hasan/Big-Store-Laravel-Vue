/* eslint-disable import/first */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

// VueRouter-------------------------------------------------
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Vuex-------------------------------------------------
import Vuex from "vuex";
Vue.use(Vuex);

import storeData from "./vueX";
const store = new Vuex.Store(storeData);

// V-Form------------------------------------------------
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Progressbar------------------------------------------------
import VueProgressBar from "vue-progressbar";

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "2px"
});

// Sweet Alert 2------------------------------------------------
import Swal from 'sweetalert2'
window.Swal = Swal;


// Moment JS------------------------------------------------
import moment from 'moment'
window.moment = moment;


// Filter------------------------------------------------
import { filter } from "./filter";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import { routes } from "./route";

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    routes, // short for `routes: routes`
    // mode: "history",
});

const app = new Vue({
    el: "#app",
    router,
    store
});
