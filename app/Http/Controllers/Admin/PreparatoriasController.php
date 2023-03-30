<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Preparatoria;
use Illuminate\Support\Facades\Storage;

class PreparatoriasController extends Controller
{
    public function index(){ 
        
        return view('admin.preparatorias');
    }

    public function listar(){
        return  Preparatoria::all();
    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        $nombre = $r->Alias;      
        $image = $r->file('Img');
        $image_name='';
        $remplazarImg = false;
        $archivos = 'admin/img/preparatorias/';

        try{
            if(isset($r->Id)){              
                $old = Preparatoria::where('Id', $r->Id)->first();

                if(($r->Alias!=$old->Alias) && $image ==null){
                    $remplazarImg = true;
                    $image_name = 'default.png';

                }else if(($r->Alias== $old->Alias) && $image ==null ){
                    $remplazarImg = false;
                    $extension = explode('.',$old->Logo);
                    $image_name = $old->Alias.".".$extension[1];
                }else{
                    $remplazarImg = true;
                    $image_name = $nombre.'.'.$image->getClientOriginalExtension();
                }

                $archivos .= $image_name;

                $res = Preparatoria::where('Id', $r->Id)->update([
                    'Nombre' => $r->Nombre,
                    'Alias' => $r->Alias,
                    'Region'  => $r->Region,
                    'Logo' => $archivos
                ]);

                if($res == 1 ){
                    $msj = "Registro modificado correctamente.";
                    if($remplazarImg==true){
                      //  $extension = explode('.',$old->Logo);
                      //  $base = 'admin/img/preparatorias/';
                      //  $old_file= $old->Logo;
                       // Storage::delete($old_file);
                        if(strcmp($image_name, 'default.png') != 0){
                            Storage::move(public_path('admin/img/preparatorias'), $archivos);
                        }
                        
                    }                     
                }
                else if($res <= 0){
                    $error = true;
                    if($image!=null){
                        if($remplazarImg==true){
                           // $extension = explode('.',$old->Logo);
                           // $base = 'admin/img/preparatorias/';
                           // $old_file= $base.$old->Logo.'.'.$extension[1];
                           // Storage::delete($old_file);
                            $image->move(public_path('admin/img/preparatorias'), $archivos);
                        }    
                        $msj = "Imagen del registro actualizada.";
                        $error = false;
                    }else{                        
                        $msj = "No se afectaron registros, verifique si selecciono un registro e intentelo nueevamente.";
                    }
                   
                }
                else{
                    $error = true;
                    $msj = "Ocurrio un detalle al modificar los registros. Verifique su información ({$res})";
                }

            }else{
                if($image!=null){
                    $archivos = $archivos.$r->Alias.'.'.$image->getClientOriginalExtension();
                }else{
                    $archivos = $archivos.'default.png';
                }
                
                
                $res = Preparatoria::create([
                    'Nombre' => $r->Nombre,
                    'Alias' => $r->Alias,
                    'Region'  => $r->Region,
                    'Logo' => $archivos
                ]);
                
                Storage::move(public_path('admin/img/preparatorias'), $archivos);

                $msj = "Registro guardado correctamente";
            }

            $data =  Preparatoria::all();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
