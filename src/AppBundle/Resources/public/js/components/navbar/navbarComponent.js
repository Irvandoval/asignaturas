(function(){
  'use strict';

  var NavbarComponent = {
    templateUrl: '/bundles/app/js/components/navbar/navbar.html',
    controller: 'NavbarCtrl as nv'
  };

   angular.module('asigApp')
    .component('navbar', NavbarComponent);
})();
