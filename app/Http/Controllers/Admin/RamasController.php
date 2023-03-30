<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Rama;

class RamasController extends Controller
{
    public function index(){       
        return view('admin.ramas');
    }

    public function listar(){
        return Rama::all();
    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        try{
            if(isset($r->Id)){

                $res = Rama::where('Id', $r->Id)->update([
                    'Nombre' => $r->Nombre,                    
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
                $res = Rama::create([
                    'Nombre' => $r->Nombre                   
                ]);

                $msj = "Registro guardado correctamente";
            }

            $data =  Rama::all();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
