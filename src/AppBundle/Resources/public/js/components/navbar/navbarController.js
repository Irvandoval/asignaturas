(function(){
 'use strict';

 angular.module('asigApp')
   .controller('NavbarCtrl', function ($location, Auth, TokenHandler, $state) {
     var self = this;
     self.menu = [{
       'title': 'Home',
       'link': '/',
       'icon': 'fa fa-home fa-lg'
     }
     ];

     self.isCollapsed = true;
     self.isLoggedIn = Auth.isLoggedIn;
     self.isAdmin = Auth.isAdmin;
   /*  self.isDocente = Auth.isDocente;
     self.isRepresentante = Auth.isRepresentante;
     self.isInvitado = Auth.isInvitado;*/
     self.getCurrentUser = Auth.getCurrentUser;
    

     self.logout = function() {
       TokenHandler.clearCredentials();
       $state.go('login');
     };

     self.isActive = function(route) {
       return route === $location.path();
     };
   });

})();
