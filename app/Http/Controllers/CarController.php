<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return $cars;

    }
    public function store(Request $request, Car $car)
    {
        $this->validate($request, [
            'color' => 'required|regex:/^#(?:(?:[a-f\d]{3}){1,2})$/',
            'date_manufacture' => 'required|date',
            'model_cars_id'=>'required|exists:model_cars,id',
            'price'=>'required|numeric'
        ],[
            'color.required'=>'A cor é requerida.',
            'color.regex'=>'A cor informada não é um Hex Color',
            'date_manufacture.required'=>'A data de fabricação é requerida.',
            'date_manufacture.date'=>'A data de fabricação está fora do padrão yyyy-mm-dd.',
            'model_cars_id.required'=>'O modelo é requerido.',
            'model_cars_id.exists'=>'O modelo não existe.',
            'price.required'=>'O preço é requerido.',
            'price.numeric'=>'O preço não é um numeral',

        ]);
        $car->fill($request->all());
        $car->date_manufacture = new \DateTime($car->date_manufacture);
        $car->save();
        return $car;
    }
    public function edit(Car $car){
        $data = new \DateTime($car->date_manufacture);
        $car->date_manufacture = $data->format('Y-m-d');
        return $car;
    }

    public function update(Request $request,Car $car){
        $this->validate($request, [
            'color' => 'required|regex:/^#(?:(?:[a-f\d]{3}){1,2})$/',
            'date_manufacture' => 'required|date',
            'model_cars_id'=>'required|exists:model_cars,id',
            'price'=>'required|numeric'
        ],[
            'color.required'=>'A cor é requerida.',
            'color.regex'=>'A cor informada não é um Hex Color',
            'date_manufacture.required'=>'A data de fabricação é requerida.',
            'date_manufacture.date'=>'A data de fabricação está fora do padrão yyyy-mm-dd.',
            'model_cars_id.required'=>'O modelo é requerido.',
            'model_cars_id.exists'=>'O modelo não existe.',
            'price.required'=>'O preço é requerido.',
            'price.numeric'=>'O preço não é um numeral',
        ]);
        $car->fill($request->all());
        $car->save();
        return $car;
    }
    public function destroy(Car $car){
        $car->delete();
        return $car;
    }

    public function report(){

        $cars = Car::orderBy('date_manufacture','ASC')->get();
        return view('report',['cars'=>$cars]);
    }
}
