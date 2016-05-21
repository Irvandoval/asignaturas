(function(){
 'use strict';
  function FacultadService($resource, TokenHandler){
   var resource = $resource('api/facultades/:factId', {factId: '@id'});
   //TokenHandler le agrega en header con el token a los resources
   resource = TokenHandler.wrapActions(resource, ['get', 'query', 'remove', 'post']);

    var options = {
     get: get,
     remove: remove,
     getResource: getResource,
     save: save
    };

    return options;

    function get(cb){
      resource.query(function(facultades){
        return cb(null, facultades);
      },
     function(err){
       return cb(err, null);
     });
    }

    function remove(id, cb){
     resource.remove({factId: id}, function(data){
       return cb(null, data);
     }, function(err){
        return cb(err, null);
     });
    }

    function save(data,cb){
     resource.save(data,function(){
       cb(null, data);
     }, function(err){
      cb(err, null);
     });
    }

    function getResource(){
     /*var resource = $resource('api/facultades/:factId', {factId: '@id'});
     //TokenHandler le agrega en header con el token a los resources
     return TokenHandler.wrapActions(resource, ['get', 'query', 'remove']);*/
     return resource;
    }


  }



 angular.module('asigApp')
   .factory('Facultad', FacultadService);
})();
