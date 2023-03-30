<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Tipo;
use App\Models\Rama;

use DB;

class CategoriasController extends Controller
{
    public function index(){ 
        $tipos = Tipo::all();
        $ramas = Rama::all();
        
        return view('admin.categorias', compact('tipos','ramas'));
    }

    public function listar(){
        return    DB::table('categorias as cat')
                    ->join('tipos as tip', 'cat.TiposId', 'tip.Id')
                    ->join('ramas as ram', 'cat.RamasId','ram.Id')
                    ->select('cat.Id as CategoriaId', 'cat.Nombre as NombreCategoria',
                            'tip.Id as TipoId', 'tip.Nombre as NombreTipo',
                            'ram.Id as RamaId', 'ram.Nombre as NombreRama', 
                            'cat.Img' )
                    ->get();


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

                $res = Categoria::where('Id', $r->Id)->update([
                    'Nombre' => $r->Nombre,
                    'TiposId' => $r->Tipo,
                    'RamasId'  => $r->Rama,
                    'Img' => $archivos
                ]);

                if($res == 1 ){
                    $msj = "Registro modificado correctamente.";
                    if($image!=null){
                        $image->move(public_path('admin/img/categorias'), $image_name);  
                    }
                     
                }
                else if($res <= 0){
                    $error = true;
                    if($image!=null){
                        $image->move(public_path('admin/img/categorias'), $image_name);
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
                $res = Categoria::create([
                    'Nombre' => $r->Nombre,
                    'TiposId' => $r->Tipo,
                    'RamasId'  => $r->Rama,
                    'Img' => $archivos
                ]);
               
                $image->move(public_path('admin/img/categorias'), $image_name);

                $msj = "Registro guardado correctamente";
            }

            $data =  DB::table('categorias as cat')
                        ->join('tipos as tip', 'cat.TiposId', 'tip.Id')
                        ->join('ramas as ram', 'cat.RamasId','ram.Id')
                        ->select('cat.Id as CategoriaId', 'cat.Nombre as NombreCategoria',
                                'tip.Id as TipoId', 'tip.Nombre as NombreTipo',
                                'ram.Id as RamaId', 'ram.Nombre as NombreRama',
                                'cat.Img' )
                        ->get();

        }catch(Exception $ex){
            $error = true;
            \Log::error($e->getMessage());
            $msj = "Error en la operación: "+$ex->getMessage();
        }

        return response()->json(["error"=> $error, "msj"=>$msj, "data"=>$data]);
    
    }

        

    
}
