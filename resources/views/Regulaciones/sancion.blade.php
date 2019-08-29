<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')


@section('titulo')
<section class="content-header">
    <h1> Gestión de Regulaciones
        <small>Edición de Regulaciones</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Regulaciones.regulaciones')}}">Regulacines</a></li>
        <li><a href="{{route('Regulaciones.consultar',$idregulacion)}}">Editar Regulación</a></li>
        <li><a href="#">Editar Sanciones</a></li>
    </ol>
</section>

<div class="box">
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Información</h4>
            Esta página le permite dar mantenimiento a las sancionoes por cada articulo.
        </div>

        <div class="box-body">

            <label class="select2 ">Id Artículo </label>
            <br>
            <input name="idarticulo" class="form-control" type="text" placeholder="id" value="{{$Articulos->idarticulo}}""
                disabled>
            <label class="select2">No. Artículo </label>
            <br>
            <input name="numeroarticulo" class="form-control" type="text" placeholder="id"
                value="{{$Articulos->numeroarticulo}}"" disabled>
            <label class="select2">Título </label>
            <br>
            <input name="tituloarticulo" class="form-control" type="text" placeholder="id"
                value="{{$Articulos->tituloarticulo}}"" disabled>
            <br>


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
            @error('descripcionsancion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar una descripcion.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('estadosancion')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe seleccionar un estado.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror

            <!-- Alertas de Mensaje -->

            <!-- Tabla de sanciones -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Sanciones</h3>

                        </div>
                        <div class="box-body">
                            <table id="Sanciones" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th style="width:95%">Descripcion</th>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Sanciones as $Sancion)

                                    <tr>
                                        <form method="POST"
                                            action="{{route('Regulaciones.actualizarsancion',$Sancion->idsancion)}}">
                                            @method('PUT')
                                            @csrf

                                            <td>
                                                <label name="idsancion" class="select2" value="{{$Sancion->idsancion}}">
                                                    {{$Sancion->idsancion}}</label>
                                            </td>


                                            <td>
                                                <label class="select2">Estado </label>
                                                <br>
                                                <select name="estadosancion" class="form-control select2"
                                                    style="width: 100%;"
                                                    value="@if ($Sancion->estadosancion==true) Activa @else Inactiva @endif) ">

                                                    <option @if ($Sancion->estadosancion==true) Selected
                                                        @endif
                                                        value="true"><span class="label label-success">Activa</span>
                                                    </option>
                                                    <option @if ($Sancion->estadosancion==false) Selected
                                                        @endif
                                                        value="false"> <span class="label label-danger">Inactiva</span>
                                                    </option>

                                                </select>

                                                <label class="select2">Descripción </label>
                                                <br>
                                                <textarea name="descripcionsancion" type="text" class="textarea"
                                                    placeholder="Descripcion Sancion"
                                                    value="{{$Sancion->descripcionsancion}}"
                                                    style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$Sancion->descripcionsancion}}</textarea>

                                            </td>

                                            <td>
                                                <button class="btn btn-warning btn-xs" type="submit">Guardar</button>
                                            </td>

                                        </form>

                                        <td>
                                            <form action="{{route('Regulaciones.eliminarsancion',$Sancion->idsancion)}}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf

                                                <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                                            </form>

                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla de Asignacion de sanciones -->


            <!-- Formulario para agregar sanciones -->
            <form method="POST" name="agregarseccion"
                action="{{route('Regulaciones.agregarsancion',$Articulos->idarticulo)}}">
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Nueva Sancion</h3>
                    </div>

                    <div class="box-body">


                        <textarea name="descripcionsancion" type="text" class="textarea"
                            placeholder="Descripcion Sancion" value="{{old('descripcionsancion')}}"
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


        </section>
    </div>

</div>


<script>
    $(document).ready(function () {
        $('#Sanciones').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        });
       
    });


$(function () {
     var top = parseInt($.cookie("top"));
     if (top) $(document).scrollTop(top);
         $(document).scroll(function () {
             var top = $(document).scrollTop();
             $.cookie("top", top);
         })
     });

</script>
@endsection