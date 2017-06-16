<?php
namespace App\Http\Controllers;

use App\Car;
use App\ModelCar;
use Illuminate\Http\Request;

class ModelCarController extends Controller
{
    public function index()
    {
        return ModelCar::all();
    }

    public function listModels(){

        return view('modelos',[
            'models'=>ModelCar::paginate(15)
        ]);

    }

    public function edit($id,ModelCar $modelCar){
        return $modelCar->find($id);
    }

    public function destroy($id,ModelCar $modelCar){
        $modelCar =  $modelCar->find($id);
        $modelCar->delete();
        return $modelCar;
    }

    public function store(Request $request, ModelCar $modelCar)
    {
        $this->validate($request, [
            'mark' => 'required',
            'motor'=> 'required',
            'name' => 'required',
            'year'=>'required|integer'
        ],[
            'mark.required'=>"A marca é requerida.",
            'motor.required'=>"O motor é requerido.",
            'name.required'=>"O nome do modelo é requerido.",
            'year.required'=>"O ano do modelo é requerido.",
            'year.integer'=>"O ano do dever um número inteiro ex: 1964.",

        ]);
        $modelCar->fill($request->all());
        $modelCar->save();
        return $request->all();
    }

    public function update(Request $request,ModelCar $modelCar){
        $this->validate($request, [
            'mark' => 'required',
            'motor'=> 'required',
            'name' => 'required',
            'year'=>'required|integer',
            'id'=>'exists:model_cars,id'
        ],[
            'mark.required'=>"A marca é requerida.",
            'motor.required'=>"O motor é requerido.",
            'name.required'=>"O nome do modelo é requerido.",
            'year.required'=>"O ano do modelo é requerido.",
            'year.integer'=>"O ano do dever um número inteiro ex: 1964.",
            'id.exists'=>'O modelo informado não existe'

        ]);
        $modelCar = $modelCar->find($request->get('id'));
        $modelCar->fill($request->all());
        $modelCar->save();
        return $modelCar;

    }
}
