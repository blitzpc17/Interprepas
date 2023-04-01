@extends('frontend.layouts.layout-seccion')

@section('title', 'Noticia')



@push('css')

<style>


    table{
        width:100%;
        border-collapse:collapse;
        border: 1px solid black;
    }

    thead th{
        background:var(--primario);
        color:white;
        text-align:center;
        padding:1rem;
    }
    tbody td{
        border: 1px solid #bbb;
        padding:1rem;
    }

    tbody tr td:nth-child(1){
        text-align:center;

    }

    #contenido h3{
        color:var(--primario);
        text-align:center;
        font-size:24px;
    }


</style>
    
@endpush

@section('sub-contenido')

    @include('frontend.layouts.noticia')

@endsection





@push('js')

<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>

<script>
    let prepas;
    moment.locale('es')
    $(document).ready(function () {
        ListarData();
    });

    function ListarData(){

        const data = {cat:"{{$categoria}}"}

        $.get("{{url('categorias/resultados')}}", 
            data, 
            function (data) {
                console.log(data)

                    $('#title').text(data.categoria.Categoria+" Rama: "+data.categoria.Rama )
                    const datainfo = data.categoria.Resultados != null? JSON.parse(data.categoria.Resultados):null;
                    prepas = data.prepas;
                    $('#fecha').text("Última actualizacion:  "+moment().format('MMMM D, h:mm a'))
                    $('#contenido').empty()                   
                    
                    if(datainfo!=null){

                        if(datainfo.ImgEvento!=null){
                            $('#img-noticia').attr('src', `{{asset('${datainfo.ImgEvento}')}}`)
                        }else{
                            $('#img-noticia').hide();
                        }

                        if(datainfo.PreparatoriasParticipantesId.length>0){
                            $('#contenido').append(`<h3>Participantes</h3>`)
                            $('#contenido').append(`<table>
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>PREFECO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tb-participantes"></tbody>
                                                    </table><br><br>`)

                            $.each(datainfo.PreparatoriasParticipantesId, function (i, val) { 
                                const participante = prepas.find(x=>x.Id == val)
                                 const row = `<tr>
                                                    <td>${i+1}</td>
                                                    <td>${participante.Nombre}</td>
                                                </tr>`
                                $('#tb-participantes').append(row)
                            });

                        }



                           

                            if(datainfo.Ganadores.length>0){

                                $('#contenido').append(`<h3>Ganadores</h3>`)

                                $('#contenido').append(`<table>
                                    <thead>
                                        <tr>
                                            <th>Lugar</th>
                                            <th>Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb-ganadores"></tbody>
                                </table><br><br>`)


                                $.each(datainfo.Ganadores, function (i, val) { 
                                    const participante = prepas.find(x=>x.Id == val)
                                    const row = `<tr>
                                                        <td>${i+1}</td>
                                                        <td>${participante.Nombre}</td>
                                                    </tr>`
                                    $('#tb-ganadores').append(row)
                                });
                            }


                            if(datainfo.Archivo!=null){
                                $('#contenido').append(`<iframe id="" src="{{asset('${datainfo.Archivo}')}}" style="width:100%; height:550px;"></iframe><br><br>`)
                            }

                            if(datainfo.enlace!=null){
                                $('#contenido').append(`<h3><a href="${datainfo.Archivo}">Ir al enlace</a></h3><br><br>`)
                            }



                            


                        

                        
                    }else{
                        $('#img-noticia').hide();
                        $('#contenido').html('<h3>No hay información para mostrar...</h3>')
                    }
                    
                    




            },
            "json"
        );
    }


</script>

@endpush