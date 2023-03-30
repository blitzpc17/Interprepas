<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Preparatoria;
use App\Models\Participantes;
use DB;
use Illuminate\Support\Facades\Storage;

class ParticipantesController extends Controller
{
    public function index(){ 

        $prepas = Preparatoria::all();
        
        return view('admin.participantes', compact('prepas'));
    }

    public function listar(){
        return    DB::table('participantes as part')
                    ->join('preparatorias as prepa', 'part.PreparatoriaId','prepa.Id')
                    ->selectraw(
                        "part.Id as ParticipanteId, concat(part.Apellidos,' ',part.Nombres) as Participante,
                        part.Nombres, part.Apellidos, part.Foto, part.Sexo,
                        prepa.Nombre as PreparatoriaNombre, prepa.Id as PreparatoriaId"
                    )
                    ->get();


    }

    public function save(Request $r){

        $error = false;
        $msj = "";
        $data = [];

        $nombre = $r->Preparatoria."-".rand();       
        $image = $r->file('Img');
        $image_name = $image!=null?$nombre.'.'.$image->getClientOriginalExtension():"default.png";
        $archivos = 'admin/img/participantes/'.$image_name;

        try{
            if(isset($r->Id)){
                $old = Participantes::where('Id', $r->Id)->first();
                $res = Participantes::where('Id', $r->Id)->update([
                    'Apellidos' => $r->Apellidos,
                    'Nombres' => $r->Nombres,
                    'PreparatoriaId'  => $r->Preparatoria,
                    'Foto' => $image==null?$old->Foto:$archivos,
                    'Sexo' => $r->Sexo==1?true:false
                ]);

                if($res == 1 ){
                    $msj = "Registro modificado correctamente.";
                    if($image!=null){
                        $image->move(public_path('admin/img/participantes'), $image_name);  
                    }
                     
                }
                else if($res <= 0){
                    $error = true;
                    if($image!=null){
                        $image->move(public_path('admin/img/participantes'), $image_name);
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
                $res = Participantes::create([
                    'Apellidos' => $r->Apellidos,
                    'Nombres' => $r->Nombres,
                    'PreparatoriaId'  => $r->Preparatoria,
                    'Foto' => $archivos,
                    'Sexo' => ($r->Sexo==1?true:false)
                ]);

                Storage::move(public_path('admin/img/participantes'), $image_name);

                $msj = "Registro guardado correctamente";
            }

            $data =  DB::table('participantes as part')
            ->join('preparatorias as prepa', 'part.PreparatoriaId','prepa.Id')
            ->selectraw(
                "part.Id as ParticipanteId, concat(part.Apellidos,' ',part.Nombres) as Participante,
                part.Nombres, part.Apellidos, part.Foto, part.Sexo,
                prepa.Nombre as PreparatoriaNombre, prepa.Id as PreparatoriaId"
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
