(function(angular, factory) {
        'use strict';
        if (typeof define === 'function' && define.amd) {
                define(['angular'], function(angular) {
                        return factory(angular);
                });
        } else {
                return factory(angular);
        }
}(window.angular || null, function(angular) {
        'use strict';
        var app = angular.module('ngImageSlider', []);
        app.controller('ngImageSliderController', ['$scope', '$interval', '$http', '$window',
                       function($scope, $interval, $http, $window){
                               $scope.images = [];
                               $scope.curImageNum = 0;
                               $scope.divHeight = Math.min($window.innerHeight-50, $window.innerWidth/(2.39));
                               var intPromise = null;
                               $scope.init = function init(){
                                       $scope.images = $scope.data;
                                       if($scope.images.length >=1){
                                               if(intPromise !== null){
                                                       $interval.cancel(intPromise);
                                               }
                                               intPromise = $interval(function(){
                                                       var tempNum = $scope.curImageNum + 1;
                                                       if(tempNum>=$scope.images.length){
                                                               tempNum = 0;
                                                       }
                                                       $scope.curImageNum = tempNum;
                                               },7000);
                                       }else{
                                               $scope.divHeight = "58";
                                               bgColor = "#222";
                                       }
                               };
                               //reload image on orientation change or resize to ensure proper sizing
                               angular.element($window).bind('orientationchange', function () {
                                       var newHeight = Math.min($window.innerHeight-50, $window.innerWidth/(2.39));
                                       if(newHeight !== $scope.divHeight){
                                               $scope.divHeight = newHeight;
                                               $scope.init();
                                       }
                               });
                               angular.element($window).bind('resize', function () {
                                       var newHeight = Math.min($window.innerHeight-50, $window.innerWidth/(2.39));
                                       if(newHeight !== $scope.divHeight){
                                               $scope.divHeight = newHeight;
                                               $scope.init();
                                       }
                               });
                               var bgColor = "black";
                               $scope.imageStyle = function imageStyle(){
                                       var data = {
                                               "background-size":"cover",
                                               "height":$scope.divHeight+"px",
                                               "background-color": bgColor
                                       };
                                       if($scope.images.length > 0 && ($scope.images[$scope.curImageNum].image !== '' || $scope.images[$scope.curImageNum].image !== null || $scope.images[$scope.curImageNum].image !== undefined)){
                                               data["background-image"] = "url('"+$scope.images[$scope.curImageNum].image+"')";
                                       }
                                       return data;
                               };
                               $scope.init();
                       }
        ]);
        app.directive('ngImageSlider', ['$q', '$parse',
                      function($q, $parse) {
                              return {
                                      restrict: 'AEC',
                                      scope: {
                                              data: '='
                                      },
                                      controller: 'ngImageSliderController',
                                      templateUrl: 'imageslide.html'
                              };
                      }]);
                      app.run(['$templateCache', function ($templateCache) {
                              $templateCache.put('imageslide.html',
                                                 '<div class="holder" style="height:{{divHeight}}px; z-index: -2;"></div>'+
                                                         '<div class="imageSlider" ng-style="imageStyle()">'+
                                                         '	<div class="hidden-xs col-xs-12 dots">'+
                                                         '		<span>'+
                                                         '           <div data-ng-repeat="image in images track by $index">'+
                                                         '               <i class="fa fa-fw" data-ng-class="$index==curImageNum ?\'fa-circle\':\'fa-circle-o\'"></i>'+
                                                         '               <br />'+
                                                         '           </div>'+
                                                         '		</span>'+
                                                         '	</div>'+
                                                         '</div>'
                                                );
                      }]);
}));
(function(angular, factory) {
        'use strict';
        if (typeof define === 'function' && define.amd) {
                define(['angular'], function(angular) {
                        return factory(angular);
                });
        } else {
                return factory(angular);
        }
}(window.angular || null, function(angular) {
        'use strict';
        var app = angular.module('ngImagePreview', []);
        app.controller('ngImagePreviewController', ['$scope', '$interval', '$http', '$window',
                       function($scope, $interval, $http, $window){
                               $scope.curImageNum = 0;
                               $scope.divHeight = 500;
                               $scope.init = function init(){
                               };
                               var bgColor = "black";
                               $scope.imageStyle = function imageStyle(){
                                       var data = {
                                               "height":$scope.divHeight+"px",
                                               "background": bgColor
                                       };
                                       if($scope.image !== '' && $scope.image !== null && $scope.image !== undefined){
                                               data["background-image"] = "url('"+$scope.image+"')";
                                               data["background-size"] = "contain";
                                               data["background-repeat"] = "no-repeat";
                                               data["background-position-x"] = "center";
                                       }
                                       return data;
                               };
                               $scope.init();
                       }
        ]);
        app.directive('ngImagePreview', ['$q', '$parse',
                      function($q, $parse) {
                              return {
                                      restrict: 'AEC',
                                      scope: {
                                              image: '@'
                                      },
                                      controller: 'ngImagePreviewController',
                                      templateUrl: 'imagepre.html'
                              };
                      }]);
                      app.run(['$templateCache', function ($templateCache) {
                              $templateCache.put('imagepre.html',
                                                 '<div class="holder" style="height:{{divHeight}}px; z-index: -2;"></div>'+
                                                         '<div class="imagePreview" ng-style="imageStyle()">'+
                                                         '</div>'
                                                );
                      }]);
}));
