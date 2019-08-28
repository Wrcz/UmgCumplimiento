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
    <h1> Gestión de Usuarios
        <small>Edicion de Usuarios</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Usuarios.usuarios')}}">Usuarios</a></li>
        <li><a href="#">Editar Usuarios</a></li>
    </ol>
</section>
@endsection

<div class="box">
    <div class="box-body">
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Información</h4>
            Esta página le permite dar mantenimiento a los usuarios del sistema.
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
            @error('nombreusuario')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un nombre de usuario, minimo de 6 caracteres.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('nivelusuario')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe seleccionar un nivel de usuario
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('password','password_confirmation')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar una contraseña o no son iguales
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            @error('correoelectronico')
            <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar un correo electrónico
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->


            <!-- formulario de Modificacion -->
            <form method="POST" action="{{route('Usuarios.actualizar',$Usuario->idusuario)}}">
                @method('PUT')
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Modificación de Usuarios</h3>
                    </div>
                    <div class="box-body">
                        <input name="idusuario" class="form-control input-lg" type="text"
                            value="{{$Usuario->idusuario}}" disabled>
                        <br>
                        <input name="correoelectronico" type="email" class="form-control"
                            placeholder="Correo Electrónico" value={{$Usuario->correoelectronico}} disabled>
                        <br>
                        <input name="nombreusuario" class="form-control input-lg" type="text"
                            placeholder="Nombre usuario" value={{$Usuario->nombreusuario}}>
                        <br>

                        <select name="nivelusuario" class="form-control select2" style="width: 100%;">
                            @foreach ($Niveles as $nivel)
                            <option value="{{$nivel->idnivelusuario}}" @if ($Usuario->
                                nivelusuario==$nivel->idnivelusuario) selected @endif>
                                {{$nivel->nombrenivelusuario}}
                            </option>
                            @endforeach
                        </select>
                        <br>

                        <input name="password" type="password" class="form-control" placeholder="Contraseña" value="">
                        <br>
                        <input name="password_confirmation" type="password" class="form-control"
                            placeholder="Confirme la Contraseña" value="">
                        <br>

                        <select name="estadousuario" class="form-control select2" style="width: 100%;">
                            <option value="1" @if ($Usuario->estadousuario==true) Selected @endif>Activo</option>
                            <option value="0" @if ($Usuario->estadousuario==false) Selected @endif>Inactivo</option>
                        </select>
                        <br>
                        <input name="cambiarpass" type="checkbox" class="form-check-input" >
                        <label class="form-check-label" for="exampleCheck1">Cambiar Contraseña</label>

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

            <!-- Tabla de Asignacion de Regulaciones -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Asignacion de Empresas</h3>
                        </div>
                        <div class="box-body">
                            <table id="empresas" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Empresa</th>
                                        <th>Estado Empresa</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Empresas as $Empresa)
                                    <tr>
                                        <td>{{$Empresa->idempresa}}</td>
                                        <td>{{$Empresa->nombreempresa}}</td>
                                        <td>
                                            @if ($Empresa->estadoempresa==0)
                                            <span class="label label-danger">Inactiva</span>
                                            @else
                                            <span class="label label-success">Activa</span>
                                            @endif
                                            @if ($Empresa->asignada==0)
                                            <span class="label label-warning">No Asociada</span>
                                            @else
                                            <span class="label label-primary">Asociada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST"
                                                action="{{route('Usuarios.actualizarempresas',['id'=> $Usuario->idusuario ,'empresa'=>$Empresa->idempresa])}}"
                                                class="d-inline">
                                                @method('PUT')
                                                @csrf
                                                @if ($Empresa->asignada==0)
                                                <button name="accion" class="btn btn-primary btn-xs" type="submit"
                                                    value="asociar">Asociar</button>
                                                @else
                                                <button name="accion" class="btn btn-danger btn-xs" type="submit"
                                                    value="desasociar">Desasociar</button>
                                                @endif
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Empresa</th>
                                        <th>Estado Empresa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla de Asignacion de Regulaciones -->

        </section>
    </div>

</div>


<script>
    $(document).ready(function () {
        $('#regulaciones').DataTable({
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