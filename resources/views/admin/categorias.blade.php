@extends('admin.layouts.layout')

@section('nombre-seccion', 'Categorías')

@section('title', 'Categorías')


@push('css')
    <link rel="stylesheet" href="{{asset('Admin/dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

    <style>
        table thead th,
        table tbody td:nth-child(1),
        table tbody td:nth-child(3),
        table tbody td:nth-child(4),
        table tbody td:nth-child(5){
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
                                    <th>Tipo</th>
                                    <th>Rama</th>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">sm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        
                    <form id="frm" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="Id" id="id">

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input class="form-control" type="text" id="nombre" name="Nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo</label>
                            <select class="form-control" name="Tipo" id="tipo" required>
                                <option value="">Seleccione una opcion</option>
                                @foreach ($tipos as $tip )
                                    <option value="{{$tip->Id}}">{{$tip->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Rama</label>
                            <select class="form-control" name="Rama" id="rama" required>
                                <option value="">Seleccione una opcion</option>
                                @foreach ($ramas as $ram )
                                    <option value="{{$ram->Id}}">{{$ram->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="">Imagen categoría</label>
                          <input type="file" class="form-control" name="Img" id="img">
                        </div>

                        <iframe id="visor" src="" width=150 height=200 frameborder="0"></iframe>


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

        $('#img').on('change', function(e){
            const img = URL.createObjectURL(e.target.files[0])
            $('#visor').attr('src', img)

        });



        $('#frm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "{{route('cat.save')}}",
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
        $('#md-save').modal('toggle')
        $('.modal-title').text('Nuevo registro')
        LimpiarControles();
    }
    function ModificarRegistro(id){        
        $('.modal-title').text('Modificar registro')
        LimpiarControles()
        const registro = registros.find(x=>x.CategoriaId == id)
        $('#nombre').val(registro.NombreCategoria)
        $('#tipo').val(registro.TipoId)
        $('#rama').val(registro.RamaId)
        $('#id').val(registro.CategoriaId) 
        const url = "{{url('')}}/"+registro.Img;
        console.log(url)
        $('#visor').attr('src', url)

        $('#md-save').modal('toggle')
    }
    function Listar(){
        $.get("{{route('cat.listar')}}", 
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
                                        <td>${val.NombreCategoria}</td>
                                        <td>${val.NombreTipo}</td>
                                        <td>${val.NombreRama}</td>
                                        <td>
                                            <button onclick="ModificarRegistro(${val.CategoriaId})" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>      `;
            $('#tb-registros tbody').append(html)
        });

        table = $('#tb-registros').DataTable();
    }

    function LimpiarControles(){
        $('#nombre').val(null)
        $('#tipo').val(null)
        $('#rama').val(null)
        $('#id').val(null) 
        $('#img').val(null)
        $('#visor').attr('src', null)
    }
</script>


@endpush

