<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Preparatoria;
use App\Models\Categoria;

use DB;

class HomePageController extends Controller
{
    public function index(Request $r){

        $categorias = Categoria::all();
        return view('frontend.home', compact('categorias'));
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
        ->whereraw('convert(ev.FechaHora, DATE) = curdate()')
        ->selectraw("ev.Id, ev.FechaHora, ev.SourceData, cat.Id, cat.Img as CategoriaImagen,
                tip.Id as TipoId,
               concat(cat.Nombre,' ',ram.Nombre) as Categoria,
               cat.Nombre as SoloCategoria,
               cat.Nombre as SoloCategoria,
                sed.Nombres as Sede")
        ->get();

        $evDeportivos = $eventos->where('TipoId', 1);

        $evCulturales = $eventos->where('TipoId', 2);

        $evConocimiento = $eventos->where('TipoId', 3);

        $preparatorias = Preparatoria::all();


        $noticias = DB::table('noticias as not')
            ->select('not.Id', 'not.Titulo', 'not.Fecha', 'not.Contenido', 'not.Img')
            ->orderbydesc('not.Id')
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
