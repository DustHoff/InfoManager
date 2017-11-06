
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('import-job', require('./components/triggerImportJob.vue'));
Vue.component('job-list', require('./components/joblist.vue'));
Vue.component('viewjob', require('./components/viewjob.vue'));
Vue.component('date-timepicker', require('./components/date-timepicker.vue'));
Vue.component('tags-input', require('./components/tags-input.vue'));
Vue.component('calendar', require('./components/calendar.vue'));
Vue.component('autocomplete-input', require('./components/autocomplete-input.vue'));

/**
 * localization function for vue js
 * @param string
 */
Vue.prototype.i18n = string => _.get(window.i18n, string);
Vue.prototype.$eventBus = new Vue();


const app = new Vue({
    el: '#app'
});