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
        <li><a href="">Informe de Cumplimiento</a></li>
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
                            <h3 class="box-title">Parametros</h3>

                        </div>
                        <div class="box-body">
                            <label class="select2 input-lm">Empresa </label>
                            <input name="numeroarticulo" class="form-control" type="text" placeholder="id"
                                value="{{$Empresa->nombreempresa}}" disabled>
                            <label class="select2 input-lm">Regulacion </label>
                            <br>
                            <input name="tituloarticulo" class="form-control" type="text" placeholder="id"
                                value="{{$Regulacion->identificacion ." " . $Regulacion->nombreregulacion  }}" disabled>
                            <br>


                        </div>


                    </div>
                </div>
            </div>
            <!-- Tabla de Asignacion de sanciones -->

            <!-- Tabla de Cumplimiento-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Informe de Cumplimiento</h3>
                        </div>
                        <div class="box-body">
                            <table id="cumplimiento" name="cumplimiento" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cumplimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   

                                    @foreach ($Cumplimiento as $row)

                                    @if ($row->filaseccion==1  && $row->filaarticulo==1)
                                    <tr>
                                            <td style="text-align: center; " >
                                                <h3 style=" font-weight: bold;" >{{$Regulacion->pais}} </h3>
                                                <h3 style=" font-weight: bold;">{{$Regulacion->identificacion}} </h3>
                                                <h4>{{$Regulacion->fechainiciovigencia}} </h3>
                                                    <h3 style=" font-weight: bold;">{{$Regulacion->nombreregulacion}}</h3>
                                                    <div>
                                                        <p style="text-align: justify;margin-left: 15%;margin-right: 15%;font-style: italic; font-size: 0.875em;">
                                                            {{$Regulacion->descripcionregulacion }}
                                                        </p>
                                                    </div>
                                            </td>
                                         </tr>
                                    @endif
                                    <div class="box-group" id="<?php echo 'accordion'. $row->idarticulo ?>">
                                                
                                            <!-- titulo de Seccion -->
                                            @if ($row->filaseccion==1 )
                                            <tr>
                                                <td>
                                                    <h3 style="text-align: center; font-weight: bold;">
                                                        {{$row->noseccion}}
                                                        {{$row->tituloseccion}}
                                                    </h3>
                                                    <p style="text-align: center;margin-left: 15%;margin-right: 15%">

                                                        <?php echo nl2br($row->descripcionseccion); ?>
                                                    </p>
                                            </tr>
                                            </td>
                                            @endif

                                            <!-- titulo de Articulo -->
                                            @if ($row->filaarticulo==1 || ($row->estadocumplimiento==0 &&  $row->sanciones>0))
                                           
                                                @if ($row->filaarticulo==1)
                                                <tr> 
                                                   <td> 
                                                            <!-- /.modal -->
                                                        <div class="modal fade" id="modal-info{{$row->idarticulo}}">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                    <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                      <h4 class="modal-title">Gestion de Evidencias - {{$row->numeroarticulo}} </h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                      
                                                                           
                                                                          <table class="table table-bordered" id="evidencia" name="evidencia" style="font-size: 0.70em" >
                                                                              <thead>
                                                                                  <th style="width: 40%;">Nombre</th>
                                                                                  <th style="width: 40%;">Observaciones</th>
                                                                                  <th style="width: 5%;">FechaCargada</th>
                                                                                  <th style="width: 10%;"></th>
                                                                                  <th style="width: 5%;"></th>
                                                                              </thead>
                                                                              <tbody>
                                                                                    @foreach ($Evidencias as $Evidencia)
                                                                                        @if ($Evidencia->idarticulo==$row->idarticulo)
                                                                                            <tr >
                                                                                                <td >{{$Evidencia->nombreevidencia}}</td>
                                                                                                <td>{{$Evidencia->observacionevidencia}}</td>
                                                                                                <td>{{$Evidencia->fechacargada}}</td>
                                                                                                <td>
                                                                                                <form name="eliminarevidencia" action="{{route('Evidencia.eliminar',$Evidencia->idevidenciacumplimiento)}}"
                                                                                                    method="POST" >
                                                                                                    @method('DELETE')
                                                                                                    @csrf
                                                                                                    <button class="btn btn-danger btn-xs" name="eliminarevidencia" onclick="eliminarev({{$Evidencia->idevidenciacumplimiento}});"  type="submit">Eliminar</button>
                                                                                                </form>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="{{url('/evidencias/'.$Evidencia->documentoevidencia)}}" target="_blank">Ver</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                  @endforeach
                                                                              </tbody>
                                                                          </table>
                                                                          <br>
                                                                      
                                                                      
                                                                            <div class="box box-success">
                                                                                <div class="box-header with-border inline">
                                                                                    <h3 class="box-title">Agregar Evidencia</h3>
                                                                                   
                                                                                </div>
                                                                                <div class="box-body">
                                                                                        <form method="POST" action="{{route('Evidencia.agregar')}}" enctype="multipart/form-data">
                                                                                      
                                                                                        {{ csrf_field() }}
                                                                                        <!-- MAX_FILE_SIZE must precede the file input field -->
                                                                                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                                                                                        <input name="archivo" type="file" style=" font-size: 13px;" required />
                                                                                        
                                                                                        <input type="hidden" name="cumplimiento" class="form-control input-ls" type="text" placeholder="Nombre Evidencia"
                                                                                        value="{{$row->idcumplimientoempresa}}" style="width: 100%; font-size: 12px;">
                                                                                        <br>
                                                                                        <input name="nombre" class="form-control input-ls" type="text" placeholder="Nombre Evidencia"
                                                                                        value="{{old('nombre')}}" style="width: 100%; font-size: 12px;">
                                                                                        <br><br>
                                                                                        <textarea name="observacionarchivo" type="text" class="textarea" placeholder="Descripcion"
                                                                                        value="{{old('descripcion')}}"
                                                                                        style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                                                        <br><br>

                                                                                        <button class="btn btn-warning btn-ls pull-right"  type="submit"    >Guardar Evidencia</button>   
                                                                                     </form>
                                                                                    </div>
                                                                                 
                                                                            </div>
                                                                       
                                                                    </div>
                                                                  
                                                                  </div>
                                                                  <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                              </div>
                                                              <!-- /.modal -->

                                                        <!--- Texto colapsado-->
                                                        <div class="panel box 
                                                                <?php   if($row->estadocumplimiento==0) echo('box-danger'); 
                                                                        if($row->estadocumplimiento==1) echo('box-success');
                                                                        if($row->estadocumplimiento==2) echo('box-primary');  ?>">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                        <a data-toggle="collapse" data-parent="#<?php echo 'accordion'. $row->idarticulo ?> " 
                                                                            href="#<?php echo 'colapsar'. $row->idarticulo ?>">
                                                                    
                                                                            <!--Encabezado articulo-->
                                                                            <label style="text-align: left;font-weight: bold;font-size: 0.875em; color:black;">
                                                                                {{$row->numeroarticulo}}
                                                                                {{$row->tituloarticulo}}
                                                                                &nbsp
                                                                            </label>
                                                                            <div class="inline">
                                                                                <label>
                                                                                    <?php  
                                                                                                                                            if($row->estadoarticulo==1) 
                                                                                                                                            echo('<span class="label label-primary">Vigente</spam>'); 
                                                                                                                                            else 
                                                                                                                                            echo('<span class="label label-warning">Inactivo</spam>');  ?>
                                                                                </label>
                                                                                <label>
                                                                                    <?php switch($row->estadocumplimiento)
                                                                                                                                    
                                                                                                                                    { 
                                                                                                                                        case 0 :
                                                                                                                                        echo '<span class="label label-danger">No Cumple</span>';
                                                                                                                                        break;
                                                                                                                                        case 1 :
                                                                                                                                        echo '<span class="label label-success">Cumple</span>';
                                                                                                                                        break;
                                                                                                                                        case 2 :
                                                                                                                                        echo'<span class="label label-primary">No aplica</span>';
                                                                                                                                        break;
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                </label>
                                                                    
                                                                                <a href="" style="text-align: right;font-style: italic; font-weight: bold;font-size: 0.70em;"  data-toggle="modal" data-target="#modal-info{{$row->idarticulo}}">
                                                                                        ({{$row->evidencias}}) Evidencia de Cumplimiento(s) articulo  
                                                                                </a>
                                                                                       
                                                                                     
                                                                                <a href="#" >
                                                                                   
                                                                                </a>
                                                                    
                                                                    
                                                                            </div>
                                                                            <!--- Texto colapsado-->
                                                                          </a>
                                                                </h4>
                                                            </div>
                                                    
                                                            <div id="<?php echo 'colapsar'. $row->idarticulo ?>"  class="panel-collapse collapse">
                                                                    <div class="box-body">

                                                                        <p style="text-align: justify;font-style: italic; font-size: 0.875em; ">
                                                                            <?php echo nl2br( $row->descripcionarticulo); ?>
                                                                        </p>
                                                                        <!--fin Encabezado articulo-->

                                                                        <!--List box Estado de cumplimiento-->
                                                                        <div class="panel box">
                                                                        <table style="border-collapse:collapse;">
                                                                            <thead>
                                                                                <th style="width:20%; " > </th>
                                                                                <th style="width:90%; "></th>
                                                                            
                                                                            </thead>
                                                                            <tbody>
                                                                                   <!--Form actualizar cumplimiento-->
                                                                                    <form method="POST" action="{{route('Cumplimiento.actualizarcumplimiento',['idcumplimiento'=>$row->idcumplimientoempresa,'idreg'=>$row->idregulacionempresa,'idart'=>$row->idarticulo] )}}" >
                                                                                            {{ csrf_field() }}          
                                                                                <tr>
                                                                                                 <td>
                                                                                             
                                                                                             <label style="font-style: bold; font-size:0.875em;">Estado Cumplimiento</label>
                                                                                                 <select name="estadoarticulo" class="form-control select2 input-sm" style="width: 100%;" value=" 
                                                                                                                                 <?php switch($row->estadocumplimiento)
                                                                                                                                 { 
                                                                                                                                     case 0 :
                                                                                                                                         echo '0';
                                                                                                                                         break;
                                                                                                                                     case 1 :
                                                                                                                                         echo '1';
                                                                                                                                         break;
                                                                                                                                     case 2 :
                                                                                                                                         echo '2';
                                                                                                                                         break;
                                                                                                                                     }
                                                                                                                                 ?>      
                                                                                                                                 ">
                                                                                 
                                                                                                     <option @if ($row->estadocumplimiento==0) Selected @endif
                                                                                                         value="0">No Cumple
                                                                                                     </option>
                                                                                                     <option @if ($row->estadocumplimiento==1) Selected @endif
                                                                                                         value="1"> Cumple
                                                                                                     </option>
                                                                                                     <option @if ($row->estadocumplimiento==2) Selected @endif
                                                                                                         value="2"> No aplica
                                                                                                     </option>
                                                                                                 </select>
                                                                                              
                                                                                                 <label style="font-style: bold; font-size:0.875em;">Fecha Cumplimiento</label>
                                                                                                     <input name="fechacumplimiento" type="date" class="form-control select2 input-sm" style="width: 100%;"
                                                                                                         value="{{$row->fechacumplimiento}}">
                                                                                                         <br>
                                                                                                        
                                                                                                 </td>
                                                                                                 
                                                                                                 <td style="padding:.75em .5em;">
                                                                                                        <label style="font-style: bold; font-size:0.875em;">Observaciones</label>

                                                                                                        <button class="btn btn-warning btn-xs"  style="float: right;" type="submit">Guardar Cambios</button> 
                                                                                                        
                                                                                                     <textarea name="observacionescumplimiento" type="text" class="textarea"  value="{{$row->observacionescumplimiento}}"
                                                                                                             style="width: 100%; height: 87px; font-size: 11px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$row->observacionescumplimiento}}</textarea>
                                                                                                             <br>
                                                                                                            
                                                                                                 </td>
                                                                                            
                                                                                           <!--Form actualizar cumplimiento-->

                                                                                </tr>
                                                                                    </form>
                                                                            <tbody>
                                                                        </table>

                                                                        </div>

                                                                        
                                                                        <!-- Sanciones-->
                                                                        @foreach ($Cumplimiento as $sancion)
                                                                            @if ($row->idarticulo==$sancion->idarticulo )
                                                                                @if ( $sancion->estadocumplimiento==0 && $sancion->sanciones>0)

                                                                                        @if ( $sancion->filaarticulo==1 )
                                                                                          
                                                                                        <div class="alert alert-danger alert-dismissible">
                                                                                                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                                                                                                   Esta incurriendo en sanciones por el incumplimiento de este articulo, esto aumenta el nivel de riesgo para la organizacion.
                                                                                              </div>                              
                                                                                                       
                                                                                        @endif

                                                                                        
                                                                                         <textarea type="text" class="textarea"  value="{{$sancion->descripcionsancion}}" readonly
                                                                                                style="width: 100%; height: 87px; font-size: 11px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$sancion->descripcionsancion}}</textarea>
                                                                                                <br>
                                                                                                <br>
                                                                                          

                                                                                @else 
                                                                                    @if($sancion->filaarticulo==1)  
                                                                                        @if ($sancion->sanciones==0 && $sancion->estadocumplimiento==0)
                                                                                                <label style="font-style: italic;color:darkblue;" >***No hay sanciones por incumplimiento de este artìculo.***</label>
                                                                                        @endif

                                                                                        @if ($sancion->estadocumplimiento==1 )
                                                                                                <label style="font-style: italic;color:darkblue;" >***La organizacion cumplen con los requerimientos de este articulo.***</label>
                                                                                        @endif

                                                                                        @if ($sancion->estadocumplimiento==2 )
                                                                                        <label style="font-style: italic;color:darkblue;" >***El articulo no es aplicable en este momento.***</label>
                                                                                         @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                         @endforeach

                                                                      
                                                                         <!-- Sanciones-->
                                             
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <!--fin list box Estado de cumplimiento-->
                                                    </td>
                                                </tr>           
                                                @endif
         
                                                
                                               
                                            @endif
                                     
                                        </div> <!-- Fin accordion-->
             
                                    @endforeach
                                </tbody>
                              
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>

<script>
    $(document).ready(function() {
    $('#cumplimiento').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    });
    $('#evidencia').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    });

});




</script>
<script>

$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


      
function AgregaEv(cumplimiento)
{
    //e.preventDefault();

var archivo = $("input[name=archivo]").val();
var nombre = $("input[name=nombrearchivo]").val().trim();
var observaciones = $("textarea[name=observacionarchivo]").val().trim();

if (archivo.length==0)
    {
        alert('Seleccione Archivo a cargar.');
        return;
    }

    if (nombre.length==0 || observaciones.length==0)
    {
        alert('Ingrese un nombre y descripcion para el archivo.');
        return;
    }

var _token = $('input[name="_token"]').val();
$.ajax({
        url:"{{route('Evidencia.agregar')}}",
        method:"POST",
        data:{archivo:archivo, nombre:nombre, _token:_token, observaciones:observaciones,cumplimiento:cumplimiento},
       
        success:function(result)
        {
            alert('Evidencia guardada con éxito.');
            
        },
        error: function (result, status, err) {
       alert('Error' . result.responseText);
             }
        
        })
}
        </script>

@endsection