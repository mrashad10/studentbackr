angular.module("studentbackr").controller("modelController", function ($scope, $http, listModelCarService){

    $scope.insertModel = function (model) {
        var copyModelCar = angular.copy(model);
        var token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
        $http({
            header: token,
            method: 'post',
            data: copyModelCar,
            url: 'model/car'
        }).then(function (response) {
            $('#novoModelo').modal('hide');
            delete model;
            alert("Modelo inserido");
            location.reload();


        }, function (response, status) {
            if (response.status == 403) {
                alert('Acesso negado');
            }
            if (response.status == 422) {

                var messagem = "";
                $.each(response.data, function (index, item) {
                    messagem += item + "\n";
                });
                alert(messagem);

            }
            if (response.status == 500) {
                alert('erro 500 no servidor');
            }
        });
    }


});

