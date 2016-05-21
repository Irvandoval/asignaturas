(function() {
  'use strict';
  angular.module('asigApp')
    .factory('Auth', AuthService);

  function AuthService($q, $resource, TokenHandler, $rootScope, $cookies) {

    var currentUser = {};
    var resource = $resource('/api/usuarios/:id', {
      id: '@id'
    });
    resource = TokenHandler.wrapActions(resource, ['get', 'query', 'remove']);
    if($cookies.get('username')){
     getUser($cookies.get('username'), function(err, data){});
    }
    //esta funcion obtiene el usuario despues de haber obtenido la salt
    function getUser(username, cb) {
     console.log($cookies.get('salt'));
      currentUser = resource.query({username:$cookies.get('username'),secret:$cookies.get('secret'),salt:$cookies.get('salt')},
       function(user) {
        currentUser = user;
        cb(null, user);
      }, function(err) {
          console.log(err);
          cb(err, null);
      });
      console.log(currentUser);
    }

    function cipher(secret, salt) {
      var deferred = $q.defer();

      var salted = secret + '{' + salt + '}';
      var digest = CryptoJS.SHA512(salted);
      for (var i = 1; i < 5000; i++) {
        digest = CryptoJS.SHA512(digest.concat(CryptoJS.enc.Utf8.parse(salted)));
      }
      digest = digest.toString(CryptoJS.enc.Base64);

      deferred.resolve(digest);
      return deferred.promise;
    }

    function getCurrentUser(){
      return currentUser;
    }

    function isLoggedIn(){
      return $cookies.get('username') !== undefined;
    }

    return {
      getUser: getUser,
      cipher: cipher,
      getCurrentUser: getCurrentUser,
      isLoggedIn: isLoggedIn
    };
  }
})();
