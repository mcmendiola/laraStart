
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var VueCookie = require('vue-cookie');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform'

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});



window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'
Vue.use(VueRouter)



let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/User.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/test', component: require('./components/test.vue').default },
    { path: '/sqltest', component: require('./components/SQLTest.vue').default },
    { path: '/showreport', component: require('./components/ReportTest.vue').default },
    { path: '/masterlist', component: require('./components/Masterlist.vue').default },
    { path: '/dropdownlist', component: require('./components/DropdownList.vue').default }
    
  ]


import VueProgressBar from 'vue-progressbar'  


Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

  const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
  })


Vue.filter('upText', function(text){
    if (!text) return ''
    text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
  return moment(created).format('L');
});


window.Fire =  new Vue();

Vue.use(VueCookie);   


//import Datatable from 'vue2-datatable-component'
//Vue.use(Datatable) // done!


import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)

// set language to EN
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

locale.use(lang)



// import DataTables and DataTablesServer separately
import { DataTables, DataTablesServer } from 'vue-data-tables'
Vue.use(DataTables)
Vue.use(DataTablesServer)

// import DataTables and DataTablesServer together
import VueDataTables from 'vue-data-tables'
Vue.use(VueDataTables)


 
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
    el: '#app', 
    router,
    data: {
      attributeA: 'valueA',
      attributeB: 'valueB',
      attributeC: ''
    }
    
});

app.attributeC = Vue.cookie.set('id', '0', 1)



