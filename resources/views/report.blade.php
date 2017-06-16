@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <button class="btn btn-info" data-toggle="modal" data-target="#novoModelo">Novo Modelo</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Relatório</div>

                    <div class="panel-body">

                        @forelse($cars as $car)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div style="background-color:{{$car->color}};width: 25px;height: 25px;float: right"></div>
                                    {{ $car->model->name }}| {{ strtoupper($car->model->mark) }} | {{$car->model->year}},{{$car->motor}} , {{ $car->date_manufacture }}, R${{ money_format($car->price,2) }}

                                </div>
                            </div>
                        @empty

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    Sem dados
                                </div>
                            </div>

                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection