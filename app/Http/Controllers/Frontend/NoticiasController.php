<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Preparatoria;

use DB;

class NoticiasController extends Controller
{
    public function noticia(Request $r){


        



        return view('frontend.noticia');
    }


    public function ApartadoCategoria(Request $r){

        if($r->ajax()){

            $categoria = DB::table('categorias as cat')
            ->join('tipos as tip', 'cat.tiposid', 'tip.id')
            ->join('ramas as ram', 'cat.ramasid', 'ram.id')
            ->where('cat.id', $r->cat)
            ->select('cat.Id', 'cat.Nombre as Categoria', 
                'tip.Nombre as Tipo', 'ram.Nombre as Rama',
                'cat.Resultados')
            ->first();

            $prepas = Preparatoria::all();

            return response()->json(["categoria" => $categoria, "prepas" => $prepas]);

        }
        
        $categoria = $r->cat;
        return view('frontend.resultados', compact('categoria'));
    }


}
