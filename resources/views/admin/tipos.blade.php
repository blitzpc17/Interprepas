@extends('admin.layouts.layout')

@section('nombre-seccion', 'Tipos')

@section('title', 'Tipos')


@push('css')
    <link rel="stylesheet" href="{{asset('Admin/dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

    <style>
        table thead th,
        table tbody td:nth-child(1),
        table tbody td:nth-child(3){
            text-align:center;
        }

        .card{
            padding:1rem;
        }
    </style>
@endpush


@section('contenido')


        <div class="container-fluid">
            <div class="row">

                <div style="display:flex; justify-content:end; width:100%; height:45px; align-items:center;">
                    <button onclick="NuevoRegistro()" class="btn btn-primary">Nuevo registro</button>
                </div>
                <!-- left column -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registros</h3>
                        </div>
                    <!-- /.card-header -->

                        <table id="tb-registros" style="width:100%;" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
               
                 
                    </div>
                    <!-- /.card -->

                   

                </div>
                <!--/.col (left) -->
            </div>
        </div>



       
        
        <!-- Modal -->
        <div class="modal fade" id="md-save" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">sm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        
                    <form id="frm">

                    @csrf
                    <input type="hidden" name="Id" id="id">

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input class="form-control" type="text" id="nombre" name="Nombre" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



@endsection



@push('js')

<script src="{{asset('Admin/dist/plugins/datatables/jquery.dataTables.js')}}"></script>

<script>

    let registros;
    let table;

    $(document).ready(function () {

       
        Listar();



        $('#frm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "{{route('tip.save')}}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (res) {
                    if(res.error==false){
                        registros = res.data
                        Swal.fire("Aviso", res.msj, "success").then(() =>{
                            Reiniciar(registros);
                            $('#md-save').modal('toggle')
                        });
                    }else{
                        Swal.fire("Advertencia", res.msj, "warning")
                        console.log(res)
                    }
                    
                }
            });



        })
    });


    function NuevoRegistro(){       
        LimpiarControles();
        $('.modal-title').text('Nuevo registro')
        $('#md-save').modal('toggle')
    }
    function ModificarRegistro(id){
        $('#md-save').modal('toggle')
        $('.modal-title').text('Modificar registro')

        const registro = registros.find(x=>x.Id == id)
        $('#nombre').val(registro.Nombre)
        $('#id').val(registro.Id) 
    }
    function Listar(){
        $.get("{{route('tip.listar')}}", 
            function (data) {
                registros = data
                Reiniciar(registros)
        });
    }

    function Reiniciar(data){
        LimpiarControles();
        if(table!=null){
            table.destroy();
        }

        $('#tb-registros tbody').empty();     
        
        $.each(data, function (i, val) { 
             const html = `<tr>
                                        <td>${(i+1)}</td>
                                        <td>${val.Nombre}</td>                                      
                                        <td>
                                            <button onclick="ModificarRegistro(${val.Id})" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>      `;
            $('#tb-registros tbody').append(html)
        });

        table = $('#tb-registros').DataTable();
    }

    function LimpiarControles(){
        $('#nombre').val(null)
        $('#id').val(null)
    }
</script>


@endpush

