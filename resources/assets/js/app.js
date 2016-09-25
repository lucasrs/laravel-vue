
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));

const ExampleComponent = require('./components/Example.vue');
const LoginComponent = require('./components/Login.vue');
const AppComponent = require('./components/App.vue');
const BillPayListComponent = require('./components/BillPayList.vue');
const BillPayCreateComponent = require('./components/BillPayCreate.vue');
const BillPayUpdateComponent = require('./components/BillPayUpdate.vue');

const router = new VueRouter();
router.map({
  '/minha-primeira-rota': {
     name: 'helloworld',
     component: ExampleComponent
  },
  '/login': {
     name: 'auth.login',
     component: LoginComponent
  },
  '/app': {
     component: AppComponent,
     subRoutes: {
       '/bill-pays': {
            name: 'bill-pay.list',
            component: BillPayListComponent
       },
       '/bill-pays/create': {
            name: 'bill-pay.create',
            component: BillPayCreateComponent
       },
       '/bill-pays/:id/update': {
            name: 'bill-pay.update',
            component: BillPayUpdateComponent
       }
     }
  }
});

router.start({}, 'body');
