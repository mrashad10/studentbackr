angular.module("studentbackr").factory("listCarService", function($http){
    var _getListCars = function(){
        return $http.get("/car/");
    };
    return {
        getListCars:_getListCars
    };

});
