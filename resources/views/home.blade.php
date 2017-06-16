@extends('layouts.app')
@section('content')
    <div class="container" ng-controller="homeController">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <button class="btn btn-default" data-toggle="modal" data-target="#novoCarro">Novo Carro</button>
                        <button class="btn btn-info" data-toggle="modal" data-target="#novoModelo">Novo Modelo</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Carros</div>

                    <div class="panel-body">
                        <table class="table table-striped hover">
                            <thead>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Cor</th>
                            <th>Ano Modelo</th>
                            <th>Ano Fabricação</th>
                            <th>Preço</th>
                            <th>Motor</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($cars as $car)
                                <tr>
                                    <td>
                                        {{$car->model->name}}
                                    </td>
                                    <td>
                                        {{ strtoupper($car->model->mark)}}
                                    </td>
                                    <td style="background-color:{{$car->color}}">
                                        {{$car->color}}
                                    </td>
                                    <td>
                                        {{$car->model->year}}
                                    </td>
                                    <td>
                                        {{$car->date_manufacture}}
                                    </td>
                                    <td>
                                        R${{money_format($car->price,2)}}
                                    </td>
                                    <td>
                                        {{$car->model->motor}}
                                    </td>
                                    <td>
                                        <input type="hidden" class="car-id" value="{{$car->id}}">
                                        <button class="btn btn-default btn-xs editar">Editar</button>
                                        <button class="btn btn-danger btn-xs excluir">Excluir</button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8">
                                        Sem registros
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal New Mark-->
    <div class="modal fade" id="novoModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         ng-controller="homeController">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Novo Modelo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form name="newModel">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="name" ng-model="model.name">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input type="text" class="form-control" name="mark" ng-model="model.mark">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Motor</label>
                                    <input type="text" class="form-control" name="motor" ng-model="model.motor">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Ano modelo</label>
                                    <input type="text" class="form-control" name="year" ng-model="model.year">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" ng-click="insertModel(model)">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal New Car-->
    <div class="modal fade" id="novoCarro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         ng-controller="homeController">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Novo Modelo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form name="newModel">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Modelo</label>
                                    <select type="text" class="form-control" name="model" ng-model="car.model_cars_id"
                                            ng-options="modelCar.id as modelCar.name +' '+ modelCar.mark+' ('+modelCar.year+')'  for modelCar in modelCars">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Cor</label>
                                    <input type="color" class="form-control" name="color" ng-model="car.color">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Preço</label>
                                    <input type="text" class="form-control" name="motor" ng-model="car.price">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Data Fabricação</label>
                                    <input type="date" class="form-control" name="year" ng-model="car.date_manufacture">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" ng-click="insertCar(car)">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Car-->
    <div class="modal fade" id="editarCarro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         ng-controller="homeController">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Novo Modelo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form name="newModel">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Modelo</label>
                                    <select type="text" class="form-control" id='model-edit' name="model-edit"
                                            ng-model="carEdit.model_cars_id"
                                            ng-options="modelCar.id as modelCar.name +' '+ modelCar.mark+' ('+modelCar.year+')'  for modelCar in modelCars">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Cor</label>
                                    <input type="color" class="form-control" id='color-edit' name="color-edit"
                                           ng-model="carEdit.color">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Preço</label>
                                    <input type="text" class="form-control" id="price-edit" name="price-edit"
                                           ng-model="carEdit.price">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Data Fabricação</label>
                                    <input type="date" class="form-control" id="date_manufacture-edit"
                                           name="date_manufacture-edit"
                                           ng-model="carEdit.date_manufacture">
                                </div>
                            </div>
                            <input type="hidden" id="id-edit">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary updateModel">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/services/listCarService.js') }}"></script>
    <script src="{{ asset('js/services/listModelCarService.js') }}"></script>
    <script src="{{ asset('js/controller/homeController.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.editar', function () {
                var id = $(this).parent().find('.car-id').val();
                $.ajax({
                    url: '/car/' + id + '/edit',
                    dataType: 'json',
                    type: 'get',
                    statusCode: {
                        404: function () {
                            alert("Página não encontrada");
                        },
                        403: function () {
                            alert("Acesso não autorizado");
                        },
                        500: function () {
                            alert('Erro interno do servidor.');
                        }
                    }
                }).done(function (response) {
                    $('#model-edit').val('number:' + response.model_cars_id);
                    $('#color-edit').val(response.color);
                    $('#price-edit').val(response.price);
                    $('#date_manufacture-edit').val(response.date_manufacture);
                    $('#editarCarro').modal('show');
                    $('#id-edit').val(response.id);
                });

            });
            $(document).on('click', '.excluir', function () {
                var id = $(this).parent().find('.car-id').val();
                if(confirm("Excluir o carro ?")){
                    $.ajax({
                        url: '/car/' + id,
                        dataType: 'json',
                        type: 'delete',
                        statusCode: {
                            404: function () {
                                alert("Página não encontrada");
                            },
                            403: function () {
                                alert("Acesso não autorizado");
                            },
                            500: function () {
                                alert('Erro interno do servidor.');
                            }
                        }
                    }).done(function (response) {
                        alert("Carro excluido");
                        location.reload();
                    });
                }

            });
            $('.updateModel').click(function () {
                $('#editarCarro').modal('hide');

                var car = {
                    id:$('#id-edit').val(),
                    model_cars_id: $('#model-edit').val().toString().replace('number:',''),
                    color: $('#color-edit').val(),
                    price: $('#price-edit').val(),
                    date_manufacture: $('#date_manufacture-edit').val()
                }

                $.ajax({
                    url: '/car/'+car.id,
                    data:car,
                    dataType: 'json',
                    method : 'put',
                    statusCode: {
                        404: function () {
                            alert("Página não encontrada");
                        },
                        403: function () {
                            alert("Acesso não autorizado");
                        },
                        500: function () {
                            alert('Erro interno do servidor.');
                        },
                        422:function(response){

                            var messagem = "";
                            $.each(response.responseJSON,function(index,item){
                                messagem +=  item + "\n";
                            });
                            alert(messagem);
                        }
                    }
                }).done(function (response) {
                    alert("Carro atualizado");
                    location.reload();
                })
            });
        });
    </script>
@endsection
