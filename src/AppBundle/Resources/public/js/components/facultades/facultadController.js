(function(){
  function FacultadController(Facultad, NgTableParams, $resource, $cookies, $rootScope, $uibModal){
    var self = this;
    self.deleteFacultad = deleteFacultad;
    self.newFacultad = newFacultad;
    function activate(){
     if ( typeof $cookies.get('username') != "undefined" && typeof $cookies.get('secret') != "undefined" ) {
         $rootScope.userAuth = {username: $cookies.get('username'), secret : $cookies.get('secret'), salt: $cookies.get('salt') };
     }
     // If not authenticated, go to login
     if ( typeof $rootScope.userAuth == "undefined" ) {
         $window.location = '#/login';
         return;
     }
     self.facultadesTable = tableConfig();
    }
    activate();

    function newFacultad(){
     $uibModal.open({
      animation: true,
      templateUrl: 'bundles/app/js/components/facultades/facultad-modal.html',
      controller: 'NewFacultadController as ne',
      size: 'lg',
    });
    }

    function deleteFacultad(idFacultad){
     console.log(idFacultad);
     Facultad.remove(idFacultad, function(err, data){
       if(err) console.log(err);
       else{
        self.facultadesTable.reload();
       }

     });
    }

    function tableConfig(){

     var initialParams = {
       count: 5
     };
     var initialSettings = {
      counts: [],
      getData: function(params){
        return Facultad.getResource().query({username:$rootScope.userAuth.username,
         secret:$rootScope.userAuth.secret,
         salt:$rootScope.userAuth.salt}).$promise.then(function(data){
        return data;
       });
      }
     };
     return new NgTableParams(initialParams, initialSettings);
    }
  }

  function NewFacultadController(Facultad, $cookies){
    vm = this;
    vm.facultad = {};
    vm.guardar = guardar;

    function guardar(){
      Facultad.save({username: $cookies.get('username'),
      secret : $cookies.get('secret'),
      salt: $cookies.get('salt'),
      name: vm.facultad.nombre }, function(err, data){
       if(!err){
        console.log(data);
       }
     });
    }
  }

  angular.module('asigApp')
    .controller('FacultadController', FacultadController)
    .controller('NewFacultadController', NewFacultadController);
})();
