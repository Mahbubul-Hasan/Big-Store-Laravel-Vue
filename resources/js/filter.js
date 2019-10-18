import Vue from "vue";

// Short Length----------------------------------------
Vue.filter('shortLength', function (text, length, suffix) {
    return text.substring(0, length) + suffix;
});

// Currency------------------------------------------------
Vue.filter('currency', function (value) {
    return 'BDT ' + parseFloat(value).toFixed(2);
});

// Time------------------------------------------------
Vue.filter('time', function (value) {
    return moment(value).format('MMMM Do YYYY, h:mm a');
});
