<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')
<style>
    .ocultarcol {
        display: none;
    }
</style>


@section('titulo')
<section class="content-header">
    <h1> Gestión de Regulaciones
        <small>Edición de Regulaciones</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Regulaciones.regulaciones')}}">Regulacines</a></li>
        <li><a href="#">Editar Regulación</a></li>
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

            <!-- Alertas de Mensaje -->
            @error('identificacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar una identificación.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('nombreregulacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe inserar un nombre de regulación.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('descripcionregulacion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingrear una descripción.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('pais')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un pais.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->


            <!-- formulario de Modificacion -->
            <form method="POST" action={{route('Regulaciones.actualizar',$Regulaciones->idregulacion)}}>
                @method('PUT')
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Modificación de Regulaciones</h3>
                    </div>
                    <div class="box-body">
                        <input name="idregulacion" class="form-control input-lg" type="text" placeholder="id"
                            value="{{$Regulaciones->idregulacion}}" disabled>
                        <br>
                        <input name="identificacion" class="form-control input-lg" type="text"
                            value="{{$Regulaciones->identificacion}}" placeholder="Identificación">
                        <br>
                        <input name="nombreregulacion" type="country" class="form-control" type="text"
                            placeholder="Nombre Regulación" value="{{$Regulaciones->nombreregulacion}}">
                        <br>
                        <input name="descripcionregulacion" type="address" class="form-control" type="text"
                            placeholder="Descripción" value="{{$Regulaciones->descripcionregulacion}}">
                        <br>
                        <input name="pais" type="address" class="form-control" type="text" placeholder="Pais"
                            value="{{$Regulaciones->pais}}">
                        <br>
                        <input name="fechainicio" type="date" class="form-control" placeholder="Fecha Inicio Vigencia"
                            value="{{$Regulaciones->fechainiciovigencia}}">
                        <br>
                        <input name="fechafin" type="date" class="form-control" placeholder="Fecha Fin Vigencia"
                            value="{{$Regulaciones->fechafinvigencia}}">
                        <br>
                        <select name="estadoregulacion" class="form-control select2" style="width: 100%;"
                            value="@if ($Regulaciones->estadoregulacion==true) Activa @else Inactiva  @endif) ">
                            <option @if ($Regulaciones->estadoregulacion==true) Selected @endif value="true">Activa
                            </option>
                            <option @if ($Regulaciones->estadoregulacion==false) Selected @endif value="false">Inactiva
                            </option>
                        </select>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <p>
                            <button type="submit" class="btn bg-orange">Guardar Datos</button>
                        </p>
                    </div>
                </div>
            </form>
            <!-- fin formulario de Modificacion -->


            <!-- Alertas de Mensaje -->
            @error('noseccion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un nùmero de sección.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('tituloseccion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar el tìtulo de la sección..
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('descripcionseccion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingrear una descripción para la sección.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->

            <!-- Tabla de Asignacion de Regulaciones -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Secciones/Capitulos Relacionados</h3>
                            
                        </div>
                        <div class="box-body">

                            <table id="Secciones" class="table table-striped table-bordered">
                                <thead>
                                       
                                    <tr>
                                        <th>Id</th>
                                        <th>No. Seccion</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Estado Sección</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    @foreach ($Secciones as $Seccion)
                                    
                                    <tr>
                                        <form method="POST"
                                            action="{{route('Regulaciones.actualizarseccion',$Seccion->idseccion)}}">
                                            @method('PUT')
                                            @csrf
                                            <td><label name="idseccion" class="input-lg border-0"
                                                    value="{{$Seccion->idseccion}}"> {{$Seccion->idseccion}}</td>
                                            <td><input name="noseccion" type="text" class="form-control"
                                                    value="{{$Seccion->noseccion}}"></td>
                                            <td><input name="tituloseccion" type="text" class="form-control"
                                                    value="{{$Seccion->tituloseccion}}"></td>
                                            <td><input name="descripcionseccion" type="text" class="form-control"
                                                    value="{{$Seccion->descripcionseccion}}"></td>
                                            <td>

                                                <select name="estadoseccion" class="form-control select2"
                                                    style="width: 100%;"
                                                    value="@if ($Seccion->estadoseccion==true) Activa @else Inactiva  @endif) ">
                                                    <option @if ($Seccion->estadoseccion==true) Selected @endif
                                                        value="true"><span class="label label-success">Activa</span>
                                                    </option>
                                                    <option @if ($Seccion->estadoseccion==false) Selected @endif
                                                        value="false"> <span class="label label-danger">Inactiva</span>
                                                    </option>
                                                </select>

                                            </td>

                                            <td>
                                                <button class="btn btn-warning btn-xs" type="submit">Guardar</button>
                                            </td>
                                        </form>

                                        <td>
                                            <form action="{{route('Regulaciones.eliminarseccion',$Seccion->idseccion)}}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf

                                                <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                                            </form>

                                        </td>
                                        <td>
                                                <a href="" class="btn btn-primary btn-xs" >Articulos</button>
                                        </td>

                                    </tr>

                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>No. Seccion</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Estado Sección</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla de Asignacion de Regulaciones -->


            <form method="POST" action="{{route('Regulaciones.agregarseccion',$Regulaciones->idregulacion)}}">
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Nueva Seccion/Capitulo</h3>
                    </div>

                    <div class="box-body">
                        <input name="noseccion" class="form-control input-lg" type="text" placeholder="No. Seccion"
                            value="{{old('noseccion')}}">
                        <br>
                        <input name="tituloseccion" type="text" class="form-control" placeholder="Titulo Seccion"
                            value="{{old('tituloseccion')}}">
                        <br>
                        <textarea name="descripcionseccion" type="text" class="textarea"  placeholder="Descripcion Seccion" value="{{old('descripcionseccion')}}"
                        style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        
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


            <!-- Alertas de Mensaje -->
            @error('numeroarticulo')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un nùmero de articulo.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('ordenarticulo')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un orden de articulo
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('tituloarticulo')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un titulo para el articulo
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('descripcionarticulo')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar una descripcion para el articulo
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->

            <form method="POST" action="{{route('Regulaciones.agregararticulo',$Regulaciones->idregulacion)}}">
                    @csrf
                    <!-- Form Element sizes -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Agregar Nuevo Articulo</h3>
                        </div>
    
                        <div class="box-body">
                           
                           
                            <select name="idseccion" class="form-control select2" style="width: 100%;">
                                <option value="{{old('idseccion')}}" disabled selected>Seccion</option>
                                @foreach ($Secciones as $Seccion)
                                <option value="{{$Seccion->idseccion}}" ><?php echo($Seccion->idseccion . " - " . $Seccion->tituloseccion) ; ?>  </option>
                                @endforeach
                            </select>
                            <br>
                            <input name="numeroarticulo" class="form-control input-lg" type="text" placeholder="No. Articulo"
                                value="{{old('numeroarticulo')}}">
                            <br>
                            <input name="ordenarticulo" type="text" class="form-control" placeholder="Orden"
                                value="{{old('ordenarticulo')}}">
                            <br>
                            <input name="tituloarticulo" type="text" class="form-control" placeholder="Titulo"
                                value="{{old('tituloarticulo')}}">
                            <br>
                            <textarea name="descripcionarticulo" type="text" class="textarea"  placeholder="Descripcion Articulo" value="{{old('descripcionarticulo')}}"
                            style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            <br><br>
                            <input name="fechainicio" type="date" class="form-control" placeholder="Fecha Inicio vigencia"
                                value="{{old('fechainicio')}}">
                            <br>
                            <input name="fechafin" type="date" class="form-control" placeholder="Fecha Fin vigencia"
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
    $(document).ready(function () {
        $('#Secciones').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        });
    });

</script>

@endsection