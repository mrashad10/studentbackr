angular.module("studentbackr").controller("homeController", function ($scope,$http,listCarService,listModelCarService) {
    var listCars = function(){
        listCarService.getListCars().then(function(response){

           $scope.cars = response.data;
        },function(response,status){
            if(response.status == 403){
                alert('Acesso negado');
            }
            if(response.status == 422){

                var messagem = "";
                $.each(response.data,function(index,item){
                    messagem +=  item + "\n";
                });
                alert(messagem);

            }
            if(response.status == 500){
                alert('erro 500 no servidor');
            }
        });
    };

    var listModelCars = function(){
        listModelCarService.getListModelCars().then(function(response){
            $scope.modelCars = response.data;
        },function(response,status){
            if(response.status == 403){
                alert('Acesso negado');
            }
            if(response.status == 422){

                var messagem = "";
                $.each(response.data,function(index,item){
                    messagem +=  item + "\n";
                });
                alert(messagem);

            }
            if(response.status == 500){
                alert('erro 500 no servidor');
            }
        });
    };

    listModelCars();
    $scope.insertModel = function(model){
        var copyModelCar = angular.copy(model);
        var token = {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')};
        $http({
            header : token,
            method : 'post',
            data: copyModelCar,
            url:'model/car'
        }).then(function(response){
            $('#novoModelo').modal('hide');
            delete model;
            alert("Modelo inserido");
            location.reload();


        },function(response,status){
            if(response.status == 403){
                alert('Acesso negado');
            }
            if(response.status == 422){

                var messagem = "";
                $.each(response.data,function(index,item){
                    messagem +=  item + "\n";
                });
                alert(messagem);

            }
            if(response.status == 500){
                alert('erro 500 no servidor');
            }
        });
    }

    $scope.insertCar = function(car){
        var carClone = angular.copy(car);
        var token = {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')};
        $http({
            header : token,
            method : 'post',
            data: carClone,
            url:'car'
        }).then(function(response){
            console.log(response);
            $('#novoCarro').modal('hide');
            delete car;
            location.reload();
            alert("Carro inserido");

        },function(response,status){
            if(response.status == 403){
                alert('Acesso negado');
            }
            if(response.status == 422){
                var messagem = "";
                $.each(response.data,function(index,item){
                    messagem +=  item + "\n";
                });
                alert(messagem);
            }
            if(response.status == 500){
                alert('erro 500 no servidor');
            }
        });

    }
    listCars();

});
