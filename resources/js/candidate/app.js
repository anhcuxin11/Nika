/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

import Vue from 'vue';
import { Form } from 'vform';
window.Form = Form;

import { ZiggyVue } from '@ziggy';
import { Ziggy } from '../ziggy';

/* Notifications */
import { notify } from './utils';
Vue.prototype.$notify = notify;
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

/* Has error v-form */
import { HasError } from 'vform/src/components/bootstrap4';

Vue.use(ZiggyVue, Ziggy);

import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(VueLoading);

const CANDIDATE_URL = "http://localhost:8000";
window.candidateUrl = CANDIDATE_URL;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-form-error', HasError);
Vue.component('select-job', require('./components/SelectJob.js').default); // home
Vue.component('job-requirement', require('./components/JobRequirementComponent.js').default);
Vue.component('job-requirement-modal', require('./components/JobRequirementModalComponent.js').default);
Vue.component('resume-edit', require('./components/resume/ResumeEditComponent.js').default);
Vue.component('resume-edit-job', require('./components/resume/ResumeJobEditComponent.js').default);
Vue.component('resume-edit-job-modal', require('./components/resume/ResumeJobEditModalComponent.js').default);
Vue.component('show-message', require('./components/ShowMessage.js').default);
Vue.component('quick-serach', require('./components/QuickSearch.js').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
