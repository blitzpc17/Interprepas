<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Models\Sedes;

class SedesController extends Controller
{
    public function index(){       
        return view('admin.sedes');
    }

    public function listar(){
        return Sedes::all();
    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        $directorio = 'admin/img/sedes';
        $image = $r->file('Img');
        $archivos = '';
        $image_name = '';
        if($image != null){
            foreach($image as $img){
                $image_name = rand().".".$img->getClientOriginalExtension();
                $archivos.= $directorio."/".$image_name. ",";
                
               $img->move(public_path($directorio), $image_name);
            }
        }else{
           if(!isset($r->Id)){
               
                $image_name = "default.png,";
                $archivos = $directorio."/".$image_name;
                Storage::move(public_path($directorio), $image_name);
            }else{
                $old = Sedes::where('Id', $r->Id)->first();
                $archivos = $old->Imagenes;
            }
        }
        

        try{
            if(isset($r->Id)){

                $res = Sedes::where('Id', $r->Id)->update([
                    'Nombres' => $r->Nombre, 
                    'Domicilio' => $r->Domicilio,
                    'Imagenes' => substr($archivos, 0,strlen($archivos)-1),
                    'Descripcion' => $r->Descripcion,
                    'Ubicacion' => $r->Ubicacion                   
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
                $res = Sedes::create([
                    'Nombres' => $r->Nombre, 
                    'Domicilio' => $r->Domicilio,
                    'Imagenes' => substr($archivos, 0,strlen($archivos)-1),
                    'Descripcion' => $r->Descripcion,
                    'Ubicacion' => $r->Ubicacion                               
                ]);

                $msj = "Registro guardado correctamente";
            }

            $data =  Sedes::all();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
