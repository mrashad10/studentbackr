@extends('layouts.app')
@section('content')
    <div class="container" ng-controller="modelController">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <button class="btn btn-info" data-toggle="modal" data-target="#novoModelo">Novo Modelo</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Modelos</div>
                    <div class="panel-body">
                        <table class="table table-striped hover">
                            <thead>
                            <th>Modelo</th>
                            <th>Motor</th>
                            <th>Cor</th>
                            <th>Marca</th>
                            <th>Ano</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($models as $model)
                                <tr>
                                    <td>
                                        {{$model->name}}
                                    </td>
                                    <td>
                                        {{ $model->motor }}
                                    </td>
                                    <td>
                                        {{$model->mark}}
                                    </td>
                                    <td>
                                        {{$model->year}}
                                    </td>
                                    <td>
                                        <input type="hidden" class="car-id" value="{{$model->id}}">
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
                        {{ $models->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="novoModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         ng-controller="modelController">
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


    <div class="modal fade" id="editarModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         ng-controller="modelController">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Modelo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form name="newModel">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" id="editarModelName" name="editarModelName" ng-model="editarModel.name">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input type="text" class="form-control" id="editarModelMark" name="editarModelMark" ng-model="editarModel.mark">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Motor</label>
                                    <input type="text" class="form-control" id="editarModelMotor" name="editarModelMotor" ng-model="editarModel.motor">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Ano modelo</label>
                                    <input type="text" class="form-control" id="editarModelYear" name="editarModelYear" ng-model="editarModel.year">
                                </div>
                            </div>
                            <input type="hidden" id="editarModelId">
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
    <script src="{{ asset('js/services/listModelCarService.js') }}"></script>
    <script src="{{ asset('js/controller/modelController.js') }}"></script>
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
                    url: 'model/car/' + id + '/edit',
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
                    $('#editarModelName').val(response.name);
                    $('#editarModelMark').val(response.mark);
                    $('#editarModelMotor').val(response.motor);
                    $('#editarModelYear').val(response.year);
                    $('#editarModelId').val(response.id);
                    $('#editarModelo').modal('show');

                });

            });
            $(document).on('click', '.excluir', function () {
                var id = $(this).parent().find('.car-id').val();
                if(confirm("Excluir o modelo ?")){
                    $.ajax({
                        url: 'model/car/' + id,
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
                $('#editarModelo').modal('hide');
                var model = {
                    id:$('#editarModelId').val(),
                    name: $('#editarModelName').val(),
                    mark: $('#editarModelMark').val(),
                    motor: $('#editarModelMotor').val(),
                    year: $('#editarModelYear').val()
                }

                $.ajax({
                    url: 'model/car/'+model.id,
                    data:model,
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
                    alert("Modelo atualizado");
                    location.reload();
                })
            });
        });
    </script>
@endsection