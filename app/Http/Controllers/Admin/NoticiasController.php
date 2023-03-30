<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Noticia;

class NoticiasController extends Controller
{
    public function index(){         
        return view('admin.noticias');
    }

    public function listar(){
        return  Noticia::all();


    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        $nombre = $r->Nombre;       
        $image = $r->file('Img');
        $image_name = $image!=null?$nombre.'.'.$image->getClientOriginalExtension():null;
        $archivos = 'admin/img/categorias/'.$image_name;

        try{
            if(isset($r->Id)){

                $res = Noticia::where('Id', $r->Id)->update([
                    'Titulo' => $r->Titulo,
                    'Fecha' => $r->Fecha,
                    'Contenido'  => $r->Contenido,
                    'Img' => $archivos
                ]);

                if($res == 1 ){
                    $msj = "Registro modificado correctamente.";
                    if($image!=null){
                        $image->move(public_path('admin/img/noticias'), $image_name);  
                    }
                     
                }
                else if($res <= 0){
                    $error = true;
                    if($image!=null){
                        $image->move(public_path('admin/img/noticias'), $image_name);
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
                $res = Noticia::create([
                    'Titulo' => $r->Titulo,
                    'Fecha' => $r->Fecha,
                    'Contenido'  => $r->Contenido,
                    'Img' => $archivos
                ]);
               
                $image->move(public_path('admin/img/noticias'), $image_name);

                $msj = "Registro guardado correctamente";
            }

            $data =  Noticia::all();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }
}
