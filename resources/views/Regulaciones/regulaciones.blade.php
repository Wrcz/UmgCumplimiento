<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')

@section('titulo')
<section class="content-header">
    <h1> Gestión de Regulaciones
        <small>Mantenimiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('bienvenido')}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Regulaciones.regulaciones')}}">Regulaciones</a></li>
    </ol>
</section>
@endsection

<div class="box">
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Información</h4>
            Esta página le permite dar mantenimiento a regulaciones para gestionar el cumplimiento.
        </div>

        <!-- Alertas de Mensaje -->
        <section class="content">
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



            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Regulaciones del Sistema</h3>
                        </div>
                        <div class="box-body">
                            <table id="regulaciones" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Identificacion</th>
                                        <th>Nombre</th>
                                        <th>Pais</th>
                                        <th>Fecha Ini. vigencia</th>
                                        <th>Fecha Fin vigencia</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Regulaciones as $Regulacion)
                                    <tr>
                                        <td>{{$Regulacion->idregulacion}}</td>
                                        <td>{{$Regulacion->identificacion}}</td>
                                        <td>{{$Regulacion->nombreregulacion}}</td>
                                        <td>{{$Regulacion->pais}}</td>
                                        <td>{{$Regulacion->fechainiciovigencia}}</td>
                                        <td>{{$Regulacion->fechafinvigencia}}</td>
                                        <td>

                                            @if ($Regulacion->estadoregulacion==0)
                                            <span class="label label-danger">Inactiva</span>
                                            @else
                                            <span class="label label-success">Activa</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{route('Regulaciones.consultar',$Regulacion->idregulacion)}}"
                                                class="btn btn-warning btn-xs">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{route('Regulaciones.eliminar',$Regulacion->idregulacion)}}"
                                                method="POST" class="inline">
                                                @method('DELETE')
                                                @csrf
                                             
                                                
                                                <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                                               
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Identificacion</th>
                                        <th>Nombre</th>
                                        <th>Pais</th>
                                        <th>Fecha Ini. vigencia</th>
                                        <th>Fecha Fin vigencia</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertas de Mensaje -->
            @error('identificacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar una identificacion.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('nombreregulacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe seleccionarel nombre de la regulacion.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('descripcionregulacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar la descripcion
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('pais')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar el pais.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->

            <form method="POST" action="{{route('Regulaciones.agregar')}}">
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Nueva Regulacion</h3>
                    </div>

                    <div class="box-body">
                        <input name="identificacion" class="form-control input-lg" type="text"
                            placeholder="Identificacion" value="{{old('identificacion')}}">
                        <br>
                        <input name="nombreregulacion" type="text" class="form-control" placeholder="Nombre Regulacion"
                            value="{{old('nombreregulacion')}}">
                        <br>
                        <input name=" descripcionregulacion" type="text" class="form-control"
                            placeholder="Descripcion Regulacion" value="{{old('descripcionregulacion')}}">
                        <br>
                        <input name=" pais" type="country" class="form-control" placeholder="Pais Regulacion"
                            value="{{old('pais')}}">
                        <br>


                        <input name=" fechainicio" type="date" class="form-control" placeholder="Fecha Inicio Vigencia"
                            value="{{old('fechainicio')}}">
                        <br>
                        <input name=" fechafin" type="date" class="form-control" placeholder="Fecha fin Vigencia"
                            value="{{old('fechafin')}}">
                        <br>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <p>
                            <button type="submit" class="btn bg-orange">Guardar Datos</button>
                        </p>
                    </div>
                </div>

            </form>
        </section>
    </div>

</div>

<script>
    $(document).ready(function() {
    $('#regulaciones').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
});
</script>
@endsection