<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Preparatoria;

use DB;

class HomePageController extends Controller
{
    public function index(Request $r){
        return view('frontend.home');


        
    }

    public function listarDataHome(Request $r){
        $medallero = DB::table('preparatorias as prep')
        ->select('prep.Id', 'prep.Region', 'prep.Logo', 'prep.Posicion', 'prep.Medallas')
        ->orderby('posicion')
        ->get();

        $eventos = DB::table('eventos as ev')
        ->join('categorias as cat', 'ev.CategoriaId', 'cat.Id')
        ->join('ramas as ram', 'cat.ramasId', 'ram.Id')
        ->join('tipos as tip', 'cat.tiposId','tip.Id')
        ->join('sedes as sed', 'ev.SedeId', 'sed.Id')
        ->selectraw("ev.Id, ev.FechaHora, ev.SourceData, cat.Id, cat.Img as CategoriaImagen,
                tip.Id as TipoId,
               concat(cat.Nombre,' ',ram.Nombre) as Categoria,
                sed.Nombres as Sede")
        ->get();

        $evDeportivos = $eventos->where('TipoId', 1);

        $evCulturales = $eventos->where('TipoId', 2);

        $evConocimiento = $eventos->where('TipoId', 3);

        $preparatorias = Preparatoria::all();


        $noticias = DB::table('noticias as not')
            ->select('not.Id', 'not.Titulo', 'not.Fecha', 'not.Contenido', 'not.Img')
            ->get();


        return response()->json([
                    "medallero" => $medallero, 
                    "evDeportivos" => $evDeportivos,
                    "evCulturales" => $evCulturales,
                    "evConocimiento" => $evConocimiento,
                    "noticias" => $noticias,
                    "prepas" => $preparatorias
                    ]);
    }



   
}
