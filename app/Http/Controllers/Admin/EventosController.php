<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use  App\Models\Sedes;

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

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        try{
            if(isset($r->Id)){

                $res = Categoria::where('Id', $r->Id)->update([
                    'Nombre' => $r->Nombre,
                    'TiposId' => $r->Tipo,
                    'RamasId'  => $r->Rama,
                    'Img' => $archivos
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
                $res = Categoria::create([
                    'Nombre' => $r->Nombre,
                    'TiposId' => $r->Tipo,
                    'RamasId'  => $r->Rama,
                    'Img' => $archivos
                ]);

                $msj = "Registro guardado correctamente";
            }

            $data =  DB::table('categorias as cat')
                        ->join('tipos as tip', 'cat.TiposId', 'tip.Id')
                        ->join('ramas as ram', 'cat.RamasId','ram.Id')
                        ->select('cat.Id as CategoriaId', 'cat.Nombre as NombreCategoria',
                                'tip.Id as TipoId', 'tip.Nombre as NombreTipo',
                                'ram.Id as RamaId', 'ram.Nombre as NombraRama' )
                        ->get();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
