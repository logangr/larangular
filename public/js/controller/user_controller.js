'use strict';
 
App.directive('userInfo', function() {
    return {
        restrict: 'E',
        scope: {
        	u: '=info'
        },        
        replace: true,
        templateUrl: 'scopes/user-info-iso.html'
//        ,
//        link: function(scope, elem, attrs) {
//            elem.bind('keyup', function() {
//                scope.$apply(function() {
//                    scope.search(elem);
//                });
//            });
//        }
    };
});

//Aquesta directiva esta dins un nou scope
App.directive('limitInput', function() {
    return {
        restrict: 'E',
        scope: false, 
        replace: true,
        controller: ['$scope', function($scope, $element, $attrs) {}],
        link: function ($scope, $element, $attrs) {
        	$scope.id = $attrs.id;
        	$scope.label = $attrs.label;
        	$scope.camp = $attrs.camp;
        	$scope.placeholder = $attrs.placeholder;
        	$scope.type = $attrs.type;
        	$scope.estil = $attrs.estil;
        },
        templateUrl: 'scopes/limit-input.html'
    };
});

App.controller('UserController', ['$scope', 'UserService', function($scope, UserService) {

          var self = this;
          self.user={id:null,username:'',address:'',email:'',fecha:'',municipi:null, actiu:true};
          self.users=[];
          self.municipis=[]

//          var items = ["ask","always", "all", "alright", "one", "foo", "blackberry", "tweet","force9", "westerners", "sport"];
//          
//          $scope.search = function(element) {
//              $("#searchbarid").autocomplete({source: items});
//          };

          self.fetchAllUsers = function(){
              UserService.fetchAllUsers()
                  .then(
                               function(d) {
                                    self.users = d;
                               },
                                function(errResponse){
                                    console.error('Error while fetching Users');
                                }
                       );
          };
          
          self.getAllMunicipis = function(){
              UserService.getAllMunicipis()
                  .then(
                               function(d) {
                                    self.municipis = d;
                               },
                                function(errResponse){
                                    console.error('Error while fetching Municipis');
                                }
                       );
          };

          self.createUser = function(user){
              UserService.createUser(user)
                      .then(
                      self.fetchAllUsers, 
                              function(errResponse){
                                   console.error('Error while creating User.');
                              } 
                  );
          };
 
         self.updateUser = function(user, id){
              UserService.updateUser(user, id)
                      .then(
                              self.fetchAllUsers, 
                              function(errResponse){
                                   console.error('Error while updating User.');
                              } 
                  );
          };
 
         self.deleteUser = function(id){
              UserService.deleteUser(id)
                      .then(
                              self.fetchAllUsers, 
                              function(errResponse){
                                   console.error('Error while deleting User.');
                              } 
                  );
          };
 
          self.fetchAllUsers();
          self.getAllMunicipis();
 
          self.submit = function() {
              if(self.user.id===null){
                  console.log('Saving New User', self.user);    
                  self.createUser(self.user);
              }else{
                  self.updateUser(self.user, self.user.id);
                  console.log('User updated with id ', self.user.id);
              }
              self.reset();
          };
               
          self.edit = function(id){
              console.log('id to be edited', id);
              for(var i = 0; i < self.users.length; i++){
                  if(self.users[i].id === id) {
                     self.user = angular.copy(self.users[i]);
                     self.user.fecha = new Date(self.users[i].fecha);
                     break;
                  }
              }
          };
               
          self.remove = function(id){
              console.log('id to be deleted', id);
              if(self.user.id === id) {//clean form if the user to be deleted is shown there.
                 self.reset();
              }
              self.deleteUser(id);
          };
 
           
          self.reset = function(){
              self.user={id:null,username:'',address:'',email:'',municipi:null,actiu:true};
              $scope.myForm.$setPristine(); //reset Form
          };
 
      }]);