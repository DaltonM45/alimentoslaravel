<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimentos;

class FoodController extends Controller
{
    //metodo para mostrar (read)
    public function index(Request $request){
       // $alimentos = Alimentos::select('desayuno','comida','cena','extra')->get();

       $alimentos = Alimentos::orderBy('id' , 'desc')->get();

        return ['alimentos' => $alimentos];
    }

    //metodo para insertar datos
    public function store(Request $request)
    {

        $alimentos = new Alimentos();
        $alimentos->desayuno = $request->desayuno;
        $alimentos->comida = $request->comida;
        $alimentos->cena = $request->cena;
        $alimentos->extra = $request->extra;
        $alimentos->save();

    }

    //metodo para actualizar datos
    public function update(Request $request)
    {
    
        if(!$request->ajax()) return redirect('/');
        $alimentos = Alimentos::findOrFail($request->id);//buscamos alimentoss en la tabla, y actualizamos
        $alimentos->desayuno = $request->desayuno;
        $alimentos->comida = $request->comida;
        $alimentos->cena = $request->cena;
        $alimentos->extra = $request->extra;
        $alimentos->save();


    }

    public function destroy($id){

        $alimentos = Alimentos::find($id);
        $alimentos->delete();

    }



}
