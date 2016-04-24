(function(){
  'use strict';
  // Declare app level module which depends on filters, and services
  angular.module('asigApp', [
    'ui.bootstrap',
    'ui.router',
    'ngCookies',
    'ngResource'
   ])
   
    .config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
     /* $routeProvider.when('/login', {templateUrl: '/bundles/app/partials/login.html', controller: 'Login'});
      $routeProvider.when('/view1', {templateUrl: '/bundles/app/partials/partial1.html', controller: 'MyCtrl1'});
      $routeProvider.when('/view2', {templateUrl: '/bundles/app/partials/partial2.html', controller: 'MyCtrl2'});
      $routeProvider.otherwise({redirectTo: '/login'});*/
      $urlRouterProvider.otherwise("/home");
      $stateProvider
        .state('home', {
          url: '/home',
          templateUrl: "/bundles/app/partials/home.html"
        })

        .state('login', {
          url: '/login',
          templateUrl: '/bundles/app/partials/login.html',
          controller: 'Login'
        });
    }]);
})();
