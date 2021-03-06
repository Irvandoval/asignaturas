
(function(){
 'use strict';
 angular.module('asigApp')
 .controller('Login', ['$rootScope', '$scope', '$window', '$cookies', 'Salt', 'Digest', function($rootScope, $scope, $window, $cookies, Salt, Digest) {
     // On Submit function
     $scope.getSalt = function() {
         var username = $scope.username;
         var password = $scope.password;
         // Get Salt
         Salt.get({username:username}, function(data){
             var salt = data.salt;
             // Encrypt password accordingly to generate secret
             Digest.cipher(password, salt).then(function(secret){
                 // Display salt and secret for this example
                 $scope.salt = salt;
                 $scope.secret = secret;
                 // Store auth informations in cookies for page refresh
                 $cookies.username = $scope.username;
                 $cookies.secret = secret;
                 $cookies.salt = $scope.salt;
                 // Store auth informations in rootScope for multi views access
                 $rootScope.userAuth = {username: $scope.username, secret : $scope.secret, salt : $scope.salt };
             }, function(err){
                 console.log(err);
             });
         });
     };
   }])
   .controller('MyCtrl1', ['$rootScope','$scope', '$window', '$cookies', 'Hello', 'Salt', function($rootScope, $scope, $window, $cookies, Hello, Salt) {
     // If auth information in cookie
     if ( typeof $cookies.username != "undefined" && typeof $cookies.secret != "undefined" ) {
         $rootScope.userAuth = {username: $cookies.username, secret : $cookies.secret, salt : $cookies.salt };
     }
     // If not authenticated, go to login
     if ( typeof $rootScope.userAuth == "undefined" ) {
         $window.location = '#/login';
         return;
     }
     // Simple communication sample, return world
     $scope.hello = Hello.get({username:$rootScope.userAuth.username,secret:$rootScope.userAuth.secret,salt:$rootScope.userAuth.salt});
   }])
   .controller('MyCtrl2', ['$rootScope','$scope', '$window','$cookies', 'Todos', function($rootScope, $scope, $window, $cookies, Todos) {
         // If auth information in cookie
     if ( typeof $cookies.username != "undefined" && typeof $cookies.secret != "undefined" ) {
         $rootScope.userAuth = {username: $cookies.username, secret : $cookies.secret, salt: $cookies.salt };
     }
     // If not authenticated, go to login
     if ( typeof $rootScope.userAuth == "undefined" ) {
         $window.location = '#/login';
         return;
     }

     // Load Todos with secured connection
     $scope.todos = Todos.query({username:$rootScope.userAuth.username,secret:$rootScope.userAuth.secret,salt:$rootScope.userAuth.salt});

     $scope.addTodo = function() {
         var todo = {text:$scope.todoText, done:false};
         $scope.todos.push(todo);
         $scope.todoText = '';
     };

     $scope.remaining = function() {
         var count = 0;
         angular.forEach($scope.todos, function(todo) {
             count += todo.done ? 0 : 1;
         });
         return count;
     };

     $scope.archive = function() {
         var oldTodos = $scope.todos;
         $scope.todos = [];
         angular.forEach(oldTodos, function(todo) {
             if (!todo.done) $scope.todos.push(todo);
         });
     };
   }]);
})();
