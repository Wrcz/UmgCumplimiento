<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')


@section('titulo')
<section class="content-header">
    <h1> Gestión de Cumplimiento
        <small>Mantenimiento </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Cumplimiento.cumplimiento')}}">Gestion de Cumplimiento</a></li>

    </ol>
</section>

<div class="box">
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Información</h4>
            Esta página le permite gestionar el cumplimiento de las regulaciones para su empresa.
        </div>



        <section class="content">

            <!-- Alertas de Mensaje -->
            @if (session('mensaje'))
            <div class="alert alert-success  alert-dismissible">
                {{session('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @endif
            @if (session('mensajeerror'))
            <div class="alert alert-warning  alert-dismissible">
                {{session('mensajeerror')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @endif
            <!-- Fin Alertas de Mensaje -->

            <!-- Alertas de Mensaje -->

            <!-- Tabla de sanciones -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Seleccione Parametros </h3>

                        </div>
                        <div class="box-body">
                          
                            <label class="select2 input-lm">Empresas </label>
                            <br>
                            <select name="empresas" id="empresas" class="form-control select2 dynamic"
                                style="width: 100%;" data-dependent="regulaciones">
                                <option value="">Select Empresa</option>
                                @foreach ($Empresas as $Empresa)
                                <option value="{{$Empresa->idempresa}}">
                                    {{$Empresa->nombreempresa}}
                                </option>
                                @endforeach
                            </select>
                            <br>
                            <label class="select2 input-lm">Regulaciones</label>
                            <br>
                            <select name="regulaciones" id="regulaciones" class="form-control select2 dynamic"
                                style="width: 100%;">
                                <option value="">Seleccione Regulación</option>
                            </select>
                            {{ csrf_field() }}
                            <br>
                            <p>
                                <button class="btn btn-primary btn-lg" name="consultar" id="consultar"  >Consultar </button>
                                
                            </p>
                      
                        </div>


                    </div>
                </div>
            </div>
            <!-- Tabla de Asignacion de sanciones -->


        </section>
    </div>

</div>

<script>
    $(document).ready(function () {
      
$('#empresas').change(function(){
        $('#regulaciones').val('');
        if($(this).val() != '')
        {
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();
           
        $.ajax({
        url:"{{route('Cumplimiento.cumplimientofetch')}}",
        method:"POST",
        data:{select:select, value:value, _token:_token, dependent:dependent},
       
        success:function(result)
        {
        $('#'+dependent).html(result);
        
        },
        error: function (result, status, err) {
        alert(result.responseText);
             }
        
        })
        
        }
        });

    $('#consultar').click(function(){
             
       emp = $('#empresas').val();
        regu=$('#regulaciones').val();
        var _token = $('input[name="_token"]').val();
 
        window.location.href = "<?php echo URL::to('/cumplimiento/regulacion/"+emp+"/"+regu+"'); ?>";
                
        });   
 }); 



</script>
@endsection