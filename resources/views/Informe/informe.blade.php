<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')


@section('titulo')
<section class="content-header">
    <h1>  Informe de Cumplimiento
        <small>Seguimiento </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Cumplimiento.cumplimiento')}}">Parametros de Reporte</a></li>
        <li><a href="">Informe de Cumplimiento</a></li>
    </ol>
</section>

<div class="box">
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Información</h4>
            Esta página le permite dar seguimiento al cumplimiento de las regulaciones para su empresa.
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

            @error('observacionescumplimiento')
              <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar observaciones para guardar los cambios.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            @enderror
           
            @error('estadoarticulo')
            <div class="alert alert-warning alert-dismissible" role="alert">
            Seleccione un estado de cumplimiento valido.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('nivelmadurez')
            <div class="alert alert-warning alert-dismissible" role="alert">
            Seleccione un nivel de madurez valido.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            @enderror

            <!-- Tabla de Parametros -->
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
            <!-- Tabla de Parametros -->

            <!-- Tabla de Cumplimiento-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><label class="select2 input-lm"> Informe de Cumplimiento </label></h3>
                        </div>
            <br>

                        <!--<sup style="font-size: 20px">%</sup>-->
            <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3>
                            <?php 
                                    foreach ($PromedioNMadurez as $An ) 
                                    { 
                                        switch ($An->NivelMadurez)
                                        {
                                            case 0:
                                            echo ('0-Incompleto');
                                            break; 
                                            case 1:
                                            echo ('1-Realizado');
                                            break; 
                                            case 2:
                                            echo ('2-Gestionado');
                                            break; 
                                            case 3:
                                            echo ('3-Establecido');
                                            break; 
                                            case 4:
                                            echo ('4-Predecible');
                                            break; 
                                            case 5:
                                            echo ('5-Optimizado');
                                            break; 
                                        }
                                        break;
                                    
                                    }?> 
                        
                        </h3>
          
                        <p>Nivel de Madurez Cobit (General)</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                  
                    </div>
                  </div>

            <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3><?php 
                            foreach ($CantidadArticulos as $CA ) 
                            { 
                                    echo ($CA->CantidadArticulos);
                                    break; 
                               
                            }?> </h3>
          
                        <p>Cantidad de Artículos</p>
                      </div>
                      <div class="icon">
                        <i class="ion-ios-bookmarks"></i>
                      </div>
                      
                    </div>
                  </div>

          
             <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                        <h3><?php 
                            foreach ($ArticulosVigentes as $AV ) 
                            { 
                                if($AV->estadoarticulo==1){ 
                                    echo ($AV->CantidadArticulos);
                                    break; 
                                }
                               
                            }?> </h3>

                        <p>Articulos Vigentes</p>
                        </div>
                        <div class="icon">
                        <i class="ion-ios-calendar"></i>
                        </div>
                        
                    </div>
                    </div>

                      <!-- ./col -->
                      <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                <h3><?php 
                                    foreach ($ArticulosVigentes as $AV ) 
                                    { 
                                        if($AV->estadoarticulo==0){ 
                                            echo ($AV->CantidadArticulos);
                                            break; 
                                        }
                                       
                                    }?> </h3>
        
                                <p>Articulos Inactivos</p>
                                </div>
                                <div class="icon">
                                <i class="ion-arrow-down-b"></i>
                                </div>
                                
                            </div>
                            </div>

          <div class="col-md-6">
                <!-- Bar chart -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Cantidad de Artículos por Nivel de Madurez Cobit </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <div class="box-body">
                    <div id="bar-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body-->
                </div>
                <!-- /.box -->
            </div>

                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="box box-danger">
                            <div class="box-header with-border">
                            <h3 class="box-title">Cantidad de Artículos por Estado de Cumplimiento</h3>
                
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            </div>
                            <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
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

                                    @if ($row->filaseccion==1  && $row->filaarticulo==1 && $row->filaregulacion==1)
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
                                           
                                                @if ($row->filaarticulo==1  && !is_null($row->idarticulo))
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
                                                                                
                                                                              </thead>
                                                                              <tbody>
                                                                                    @foreach ($Evidencias as $Evidencia)
                                                                                        @if ($Evidencia->idarticulo==$row->idarticulo)
                                                                                            <tr >
                                                                                                <td >{{$Evidencia->nombreevidencia}}</td>
                                                                                                <td>{{$Evidencia->observacionevidencia}}</td>
                                                                                                <td>{{$Evidencia->fechacargada}}</td>
                                                                                           
                                                                                                <td>
                                                                                                    <a href="{{url('/evidencias/'.$Evidencia->documentoevidencia)}}" target="_blank">Ver</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                  @endforeach
                                                                              </tbody>
                                                                          </table>
                                                                          <br>
                                                                      
                                                                                                                                             
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
                                                                        if($row->estadocumplimiento==2) echo('box-warning'); 
                                                                        if($row->estadocumplimiento==3) echo('box-primary'); ?>">
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
                                                                                                                                            echo('<span class="label label-default">Vigente</spam>'); 
                                                                                                                                            else 
                                                                                                                                            echo('<span class="label label-default">Inactivo</spam>');  ?>
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
                                                                                                                                            echo'<span class="label label-warning">En Proceso</span>';
                                                                                                                                            break;
                                                                                                                                        case 3 :
                                                                                                                                            echo'<span class="label label-primary">No aplica</span>';
                                                                                                                                            break;
                                                                                                                                    }
                                                                                   ?>
                                                                                    <?php switch($row->nivelmadurez)
                                                                                                                                    
                                                                                    { 
                                                                                        case 0 :
                                                                                            echo '<span class="label label-info">0. Incompleto</span>';
                                                                                            break;
                                                                                        case 1 :
                                                                                            echo '<span class="label label-info">1. Realizado</span>';
                                                                                            break;
                                                                                        case 2 :
                                                                                            echo'<span class="label label-info">2. Gestionado</span>';
                                                                                            break;
                                                                                        case 3 :
                                                                                            echo'<span class="label label-info">3. Establecido</span>';
                                                                                            break;
                                                                                         case 4 :
                                                                                            echo'<span class="label label-info">4. Predecible</span>';
                                                                                            break;
                                                                                        case 5 :
                                                                                            echo'<span class="label label-info">5. Optimizado</span>';
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </label>
                                                                    
                                                                                <a href="" style="text-align: right;font-style: italic; font-weight: bold;font-size: 0.70em;"  data-toggle="modal" data-target="#modal-info{{$row->idarticulo}}">
                                                                                        ({{$row->evidencias}}) Evidencia(s) de Cumplimiento  
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
                                                                                            
                                                                                <tr>
                                                                                                 <td>
                                                                                             
                                                                                             <label style="font-style: bold; font-size:0.875em;">Estado Cumplimiento</label>
                                                                                                 <select name="estadoarticulo" class="form-control select2 input-sm" style="width: 100%;" disabled value="  
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
                                                                                                                                    case 3 :
                                                                                                                                         echo '3';
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
                                                                                                         value="2"> En Proceso
                                                                                                     </option>
                                                                                                     <option @if ($row->estadocumplimiento==3) Selected @endif
                                                                                                            value="3"> No Aplica
                                                                                                    </option>
                                                                                                 </select>

                                                                                                 <label style="font-style: bold; font-size:0.875em;">Nivel Madurez Cobit </label>
                                                                                                 <select name="nivelmadurez" class="form-control select2 input-sm" style="width: 100%;" disabled value=" 
                                                                                                        <?php switch($row->nivelmadurez)
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
                                                 
                                                                                                <option @if ($row->nivelmadurez==0) Selected @endif
                                                                                                    value="0">0. Incompleto
                                                                                                </option>
                                                                                                <option @if ($row->nivelmadurez==1) Selected @endif
                                                                                                    value="1">1. Realizado
                                                                                                </option>
                                                                                                <option @if ($row->nivelmadurez==2) Selected @endif
                                                                                                    value="2">2. Gestionado
                                                                                                </option>
                                                                                                <option @if ($row->nivelmadurez==3) Selected @endif
                                                                                                    value="3">3. Establecido
                                                                                                </option>
                                                                                                <option @if ($row->nivelmadurez==4) Selected @endif
                                                                                                    value="4">4. Predecible
                                                                                                </option>
                                                                                                <option @if ($row->nivelmadurez==5) Selected @endif
                                                                                                    value="5">5. Optimizado
                                                                                                </option>
                                                                                            </select>
                                                                                                <br>
                                                                                                <label style="font-style: bold; font-size:0.875em;">Fecha Cumplimiento</label>
                                                                                                <input name="fechacumplimiento" type="date" class="form-control select2 input-sm" style="width: 100%;" readonly
                                                                                                    value="{{$row->fechacumplimiento}}">
                                                                                                  
                                                                                          
                                                                                                        
                                                                                                 </td>
                                                                                                 
                                                                                                 <td style="padding:.75em .5em;">
                                                                                                  
                                                                                                        <label style="font-style: bold; font-size:0.875em;">Observaciones</label>

                                                                                                     
                                                                                                     <textarea name="observacionescumplimiento" type="text" class="textarea"  value="{{$row->observacionescumplimiento}}" readonly
                                                                                                             style="width: 100%; height: 133px; font-size: 11px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$row->observacionescumplimiento}}</textarea>
                                                                                                             <br>
                                                                                                            
                                                                                                 </td>
                                                                                            
                                                                                           <!--Form actualizar cumplimiento-->

                                                                                </tr>
                                                                                    
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

///graficas//////

$(function () {
    
    
    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [
          ['0 - Incompleto', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==0) {echo ($An->CantidadArticulos); break;}}?> ], 
          ['1 - Realizado', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==1) {echo ($An->CantidadArticulos); break;}}?> ], 
          ['2 - Gestionado', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==2) {echo ($An->CantidadArticulos); break;}}?> ], 
          ['3 - Establecido', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==3) {echo ($An->CantidadArticulos); break;}}?> ], 
          ['4 - Predecible', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==4) {echo ($An->CantidadArticulos); break;}}?> ], 
          ['5 - Optimizado', <?php foreach ($ArticulosNivel as $An ) { if ($An->nivelmadurez==5) {echo ($An->CantidadArticulos); break;}}?> ]
          
          ],
      color: '#2E9AFE'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */

   
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==0) {echo ($An->CantidadArticulos); break;}}?>,
        color    : '#FE2E2E',
        highlight: '#FE2E2E',
        label    : '<?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==0) {echo ($An->DescripcionEstadoCumplimiento); break;}}?>'
      },
      {
        value    : <?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==1) {echo ($An->CantidadArticulos); break;}}?>,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : '<?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==1) {echo ($An->DescripcionEstadoCumplimiento); break;}}?>'
      },
      {
        value    : <?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==2) {echo ($An->CantidadArticulos); break;}}?>,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : '<?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==2) {echo ($An->DescripcionEstadoCumplimiento); break;}}?>'
      },
      {
        value    : <?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==3) {echo ($An->CantidadArticulos); break;}}?>,
        color    : '#BDBDBD',
        highlight: '#BDBDBD',
        label    : '<?php foreach ($ArticulosEstadoCumplimiento as $An ) { if ($An->EstadoCumplimiento==3) {echo ($An->DescripcionEstadoCumplimiento); break;}}?>'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

  })
        </script>

@endsection