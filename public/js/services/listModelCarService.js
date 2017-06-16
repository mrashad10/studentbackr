angular.module("studentbackr").factory("listModelCarService", function($http){
    var _getListModelCars = function(){
        return $http.get("/model/car");
    };
    return {
        getListModelCars:_getListModelCars
    };

});

