    var appDependencies = ['ngImageSlider', 'ngChurchManagement'];
    var hbcAPP = angular.module("hbcAPP", appDependencies);
    angular.isUndefinedOrNull = function undefinedOrNull(value){
        return angular.isUndefined(value) || value === null;
    };
    angular.isUndefinedOrNullOrEmpty = function undefinedOrNull(value){
        return angular.isUndefined(value) || value === null || value === "";
    };
	