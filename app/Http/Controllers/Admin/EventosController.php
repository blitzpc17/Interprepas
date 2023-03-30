<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use  App\Models\Sedes;
use  App\Models\Evento;

class EventosController extends Controller
{
    public function index(){ 
        $categorias = DB::table('categorias as cat')
                        ->join('ramas as ram', 'cat.RamasId', 'ram.Id')
                        ->selectraw("cat.Id, concat(cat.Nombre, ' ', ram.Nombre) as Nombre")
                        ->get();     

        $sedes = Sedes::all();

        return view('admin.eventos', compact('categorias', 'sedes'));
    } 

    public function listar(){
        return DB::table('eventos as ev')
                    ->join('categorias as cat', 'ev.CategoriaId','cat.Id')
                    ->join('ramas as ram', 'cat.RamasId', 'ram.Id')
                    ->join('tipos as tip', 'cat.TiposId', 'tip.Id')
                    ->join('sedes as sed', 'ev.SedeId', 'sed.Id')
                    ->select('ev.Id as EventoId', 'cat.Id as CategoriaId', 'cat.Nombre as NombreCategoria',
                        'ram.Nombre as NombreRama', 'tip.Nombre as NombreTipo', 'sed.Id as SedeId', 'sed.Nombres as NombreSede',
                        'ev.FechaHora', 'ev.SourceData as Data', DB::raw("concat(cat.Nombre, ' ', ram.Nombre) as CategoriaRama")
                    )
                    ->get();
    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        try{
            if(isset($r->Id)){

                $res = Evento::where('Id', $r->Id)->update([
                    'CategoriaId' => $r->Categoria,
                    'FechaHora' => $r->Fecha,
                    'SedeId'  => $r->Sede,
                    'SourceData' => $r->Data
                ]);

                if($res == 1 ){
                    $msj = "Registro modificado correctamente.";
                }
                else if($res <= 0){
                    $error = true;
                    $msj = "No se afectaron registros, verifique si selecciono un registro e intentelo nueevamente.";
                }
                else{
                    $error = true;
                    $msj = "Ocurrio un detalle al modificar los registros. Verifique su información ({$res})";
                }

            }else{
                $res = Evento::create([
                    'CategoriaId' => $r->Categoria,
                    'FechaHora' => $r->Fecha,
                    'SedeId'  => $r->Sede,
                    'SourceData' => $r->Data
                ]);

                $msj = "Registro guardado correctamente";
            }

            $data =   DB::table('eventos as ev')
                        ->join('categorias as cat', 'ev.CategoriaId','cat.Id')
                        ->join('ramas as ram', 'cat.RamasId', 'ram.Id')
                        ->join('tipos as tip', 'cat.TiposId', 'tip.Id')
                        ->join('sedes as sed', 'ev.SedeId', 'sed.Id')
                        ->select('ev.Id as EventoId', 'cat.Id as CategoriaId', 'cat.Nombre as NombreCategoria',
                            'ram.Nombre as NombreRama', 'tip.Nombre as NombreTipo', 'sed.Id as SedeId', 'sed.Nombres as NombreSede',
                            'ev.FechaHora', 'ev.SourceData as Data', DB::raw("concat(cat.Nombre, ' ', ram.Nombre) as CategoriaRama")
                        )
                        ->get();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
