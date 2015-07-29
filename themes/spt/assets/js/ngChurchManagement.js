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
	
	var app = angular.module('ngChurchManagement', []);
	
	angular.isUndefinedOrNull = function undefinedOrNull(value){
        return angular.isUndefined(value) || value === null;
    };
    angular.isUndefinedOrNullOrEmpty = function undefinedOrNull(value){
        return angular.isUndefined(value) || value === null || value === "";
    };
    app.factory('ngChurchManagementService', function($http){
        var factory = {};
        factory.model = undefined;
        var observerCallbacks = [];
        factory.registerObserverCallback = function(callback){
            observerCallbacks.push(callback);
        };
        
        var notifyObservers = function(){
            angular.forEach(observerCallbacks, function(callback){
                callback();
            });
        };
        var requested = false;
        
        factory.get = function get(basePath){
            if(angular.isUndefinedOrNullOrEmpty(factory.model) && !requested){
                $http.get(basePath+"/a.json").success(function(data){
                    factory.model = data;
                    notifyObservers();
                });
                requested = true;
            }else{
                notifyObservers();
            }
        };
        
        return factory;
        
    });

	app.controller('ngChurchSermonController', ['$scope', 'ngChurchManagementService',
		function($scope, ngChurchManagementService){
			$scope.sermon = undefined;
			var curSermon = 0;
			var totalSermons = 0;
			$scope.nextDisable = false;
			$scope.prevDisable = false;
			$scope.loading = false;
			
			$scope.init = function init(){
                $scope.loading = true;
                ngChurchManagementService.get($scope.basePath);
			};
			
			var setSermon =  function(){
                if(!angular.isUndefinedOrNullOrEmpty(ngChurchManagementService.model)){
                    $scope.loading = false;
                    if(ngChurchManagementService.model.sermons.length > 0){
                        $scope.sermon = ngChurchManagementService.model.sermons[curSermon];
                        totalSermons = ngChurchManagementService.model.sermons.length; 
                        $scope.prevDisable = curSermon > 0;
                        $scope.nextDisable = (curSermon+1) < totalSermons;
                    }else{
                        if(!angular.isUndefinedOrNullOrEmpty(ngChurchManagementService.model.noSermonsMessage)){
                            $scope.noSermonsMessage = ngChurchManagementService.model.noSermonsMessage;
                        }else{
                            $scope.noSermonsMessage = "There are no current or upcoming sermon series, check back for updates!";
                        }
                    }
                }
			};
			
			ngChurchManagementService.registerObserverCallback(setSermon);
			
			$scope.init();
			
			$scope.next = function next(){
                if(curSermon+1 < totalSermons){
                    curSermon += 1;    
                    $scope.sermon = ngChurchManagementService.model.sermons[curSermon];
                }
                $scope.prevDisable = curSermon > 0;
                $scope.nextDisable = (curSermon+1) < totalSermons;
			};
			
			$scope.prev = function prev(){
                if(curSermon > 0){
                    curSermon -= 1;    
                    $scope.sermon = ngChurchManagementService.model.sermons[curSermon];
                }
                $scope.prevDisable = curSermon > 0;
                $scope.nextDisable = (curSermon+1) < totalSermons;
			};
			
			
		}
	]);
	
	angular.dayString = function(curdate){
        var d = new Date(curdate);
        var day = d.getDate();
        if(day<10){
            return "0"+day;
        }else{
            return day;
        }
	};
angular.monthString = function(curdate){
        var d = new Date(curdate);
        switch(d.getMonth()){
            case 0:
                return "Jan";
            case 1:
                return "Feb";
            case 2:
                return "Mar";
            case 3:
                return "Apr";
            case 4:
                return "May";
            case 5:
                return "Jun";
            case 6:
                return "Jul";
            case 7:
                return "Aug";
            case 8:
                return "Sep";
            case 9:
                return "Oct";
            case 10:
                return "Nov";
            case 11:
                return "Dec";
        }
    };
	app.controller('ngChurchEventController', ['$scope', 'ngChurchManagementService',
		function($scope, ngChurchManagementService){
			$scope.events = undefined;
			var curPage = 0;
			var totalPages = 1;
			$scope.nextDisable = false;
			$scope.prevDisable = false;
			$scope.loading = false;
			
			$scope.init = function init(){
                $scope.loading = true;
                ngChurchManagementService.get($scope.basePath);
			};
			
			var setEvents = function(){
                if(!angular.isUndefinedOrNullOrEmpty(ngChurchManagementService.model)){
                    $scope.loading = false;
                    if(ngChurchManagementService.model.events.length>0){
                        if(ngChurchManagementService.model.events.length>=(1+curPage)*2){
                            $scope.events = {0:ngChurchManagementService.model.events[curPage],1:ngChurchManagementService.model.events[curPage+1]};
                        }else{
                            $scope.events = {0:ngChurchManagementService.model.events[curPage]};
                        }
                        totalPages = parseInt(""+ngChurchManagementService.model.events.length/2) + ngChurchManagementService.model.events.length%2; 
                        $scope.prevDisable = curPage > 0;
                        $scope.nextDisable = (curPage+1) < totalPages;
                    }else{
                        $scope.events = [];
                        if(!angular.isUndefinedOrNullOrEmpty(ngChurchManagementService.model.noEventsMessage)){
                            $scope.noEventsMessage = ngChurchManagementService.model.noEventsMessage;
                        }else{
                            $scope.noEventsMessage = "There are no current or upcoming events, check back for updates!";
                        }
                    }
                }
			};
			
			ngChurchManagementService.registerObserverCallback(setEvents);
			
			$scope.getDay = function(curdate){
                return angular.dayString(curdate);
			};
			
			$scope.getMonth = function(curdate){
                return angular.monthString(curdate);
			};
			
			$scope.getFormattedDate = function (curdate){
                var month = angular.monthString(curdate);
                var day = angular.dayString(curdate);
                var date = new Date(curdate);
                var year = date.getFullYear();
                var time = date.toLocaleTimeString();
                return month + " " + day + ", " + year + " " + time;
			};
			
			$scope.next = function next(){
                curPage += 2;
                if(ngChurchManagementService.model.events.length>=(1+curPage)*2){
                    $scope.events = {0:ngChurchManagementService.model.events[curPage],1:ngChurchManagementService.model.events[curPage+1]};
                }else{
                    $scope.events = {0:ngChurchManagementService.model.events[curPage]};
                }
                $scope.prevDisable = curPage > 0;
                $scope.nextDisable = (curPage+1) < totalPages;
			};
			
			$scope.prev = function prev(){
                curPage -= 2;    
                $scope.events = {0:ngChurchManagementService.model.events[curPage],1:ngChurchManagementService.model.events[curPage+1]}; 
                
                $scope.prevDisable = curPage > 0;
                $scope.nextDisable = (curPage+1) < totalPages;
			};
			
			$scope.init();
			
			
		}
	]);
	
	
	app.directive('ngChurchEvent', ['$q', '$parse',
		function($q, $parse) {
			return {
				restrict: 'AEC',
				scope: {
					basePath: '@'
				},
				controller: 'ngChurchEventController',
				templateUrl: 'cmEvent.html'
			};
		}
	]);
	app.directive('ngChurchSermon', ['$q', '$parse',
		function($q, $parse) {
			return {
				restrict: 'AEC',
				scope: {
					basePath: '@'
				},
				controller: 'ngChurchSermonController',
				templateUrl: 'cmSermon.html'
            };
        }
	]);
	app.run(['$templateCache', function ($templateCache) {
        $templateCache.put('cmEvent.html', 
            '<div class="row" ng-if="loading">'+
            '   <div class="col-xs-12">'+
            '       <div class="spinner">'+
            '           <div class="rect1"></div>'+
            '           <div class="rect2"></div>'+
            '           <div class="rect3"></div>'+
            '           <div class="rect4"></div>'+
            '           <div class="rect5"></div>'+
            '       </div>'+
            '   </div>'+
            '</div>'+
            '<div ng-if="!loading && events.length == 0" class="col-xs-12">'+
            '   <h3 class="text-center">{{noEventsMessage}}</h3>'+
            '</div>'+
            '<div ng-cloak class="col-xs-12 col-md-6" ng-repeat="event in events">'+
            '  <a ng-href="{{event.url}}">                                                               '+
            '    <div class="well" style="padding: 0px;">                                                '+
            '        <div class="start text-center">                                                     '+
            '            <p class="num">{{getDay(event.start)}}</p>                                      '+
            '            <p class="month">{{getMonth(event.start)}}</p>                                  '+
            '        </div>                                                                              '+
            '        <div>                                                                               '+
            '           <img ng-src="{{basePath+event.image}}" style="width:100%;">                      '+
            '        </div>                                                                              '+
            '        <div class="row">                                                                   '+
            '            <div class="col-xs-12">                                                         '+
            '                <div class="col-xs-12">                                                     '+
            '                    <h4 class="col-xs-12">{{event.title}}</h4>                              '+
            '                    <p class="small">Start: {{getFormattedDate(event.start)}}</p>           '+
            '                    <p class="small">End: {{getFormattedDate(event.end)}}</p>               '+
            '                    <p class="col-xs-12">{{event.description}}</p>                          '+
            '                </div>                                                                      '+
            '            </div>                                                                          '+
            '        </div>                                                                              '+
            '    </div>                                                                                  '+
            '	</a>                                                                                     '+
            '</div>                                                                                      '+
            '<div class="row" ng-if="prevDisable || nextDisable">                                        '+
            '    <div class="col-xs-12">'+
            '        <div class="col-xs-4 col-xs-offset-1 col-md-2 col-md-offset-3">                     '+
            '            <button class="btn btn-primary col-xs-12" ng-disabled="!prevDisable" ng-click="prev()"><i class="fa fa-fw fa-lg fa-chevron-left"></i></button>'+
            '        </div>'+
            '        <div class="col-xs-4 col-xs-offset-2 col-md-2 col-md-offset-2">                     '+
            '            <button class="btn btn-primary col-xs-12" ng-disabled="!nextDisable" ng-click="next()"><i class="fa fa-fw fa-lg fa-chevron-right"></i></button>'+
            '        </div>'+
            '    </div>                                                                                  '+
            '</div>                                                                                      '
            );
		$templateCache.put('cmSermon.html', 
            '<div class="row" ng-if="loading">'+
            '   <div class="col-xs-12">'+
            '       <div class="spinner">'+
            '           <div class="rect1"></div>'+
            '           <div class="rect2"></div>'+
            '           <div class="rect3"></div>'+
            '           <div class="rect4"></div>'+
            '           <div class="rect5"></div>'+
            '       </div>'+
            '   </div>'+
            '</div>'+
            '<div ng-if="!loading && sermon === undefined" class="col-xs-12">'+
            '   <h3 class="text-center">{{noSermonsMessage}}</h3>'+
            '</div>'+
            '<div ng-if="sermon" class="col-xs-12 col-md-6 col-md-offset-3">                                   '+
            '    <div class="well" style="padding: 0px;">                                                '+
            '        <img ng-src="{{basePath+sermon.image}}" style="width:100%;">                        '+
            //'        <div class="row">                                                                   '+
            // '            <div class="col-xs-12">                                                         '+
            // '                <div class="col-xs-12">                                                     '+
            //'                    <h4 class="col-xs-12">{{sermon.title}}</h4>                             '+
            //'                    <p class="small">Start: {{getFormattedDate(sermon.start)}}</p>          '+
            // '                    <p class="small">End: {{getFormattedDate(sermon.end)}}</p>              '+
            // '                    <p class="col-xs-12">{{sermon.description}}</p>                         '+
            // '                </div>                                                                      '+
            // '            </div>                                                                          '+
            // '        </div>                                                                              '+
            '    </div>                                                                                  '+
            '</div>                                                                                      '+
            '<div class="row"  ng-if="prevDisable || nextDisable">                                       '+
            '    <div class="col-xs-12">'+
            '        <div class="col-xs-4 col-xs-offset-1 col-md-2 col-md-offset-3">                     '+
            '            <button class="btn btn-primary col-xs-12" ng-disabled="!prevDisable" ng-click="prev()"><i class="fa fa-fw fa-lg fa-chevron-left"></i></button>'+
            '        </div>'+
            '        <div class="col-xs-4 col-xs-offset-2 col-md-2 col-md-offset-2">                     '+
            '            <button class="btn btn-primary col-xs-12" ng-disabled="!nextDisable" ng-click="next()"><i class="fa fa-fw fa-lg fa-chevron-right"></i></button>'+
            '        </div>'+
            '    </div>                                                                                  '+
            '</div>                                                                                      '
            );
        }
    ]);
}));