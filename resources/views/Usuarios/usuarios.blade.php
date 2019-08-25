<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')

@section('titulo')
<section class="content-header">
    <h1> Gestión de Usuarios
        <small>Mantenimiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('bienvenido')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Usuarios.usuarios')}}">Usuarios</a></li>
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



            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Usuarios del Sistema</h3>
                        </div>
                        <div class="box-body">
                            <table id="usuarios" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Usuario</th>
                                        <th>Nivel</th>
                                        <th>Correo Electrónico</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Usuarios as $Usuario)
                                    <tr>
                                        <td>{{$Usuario->idusuario}}</td>
                                        <td>{{$Usuario->nombreusuario}}</td>
                                        <td>{{$Usuario->nombrenivelusuario}}</td>
                                        <td>{{$Usuario->correoelectronico}}</td>
                                        <td>
                                            @if ($Usuario->estadousuario==0)
                                            <span class="label label-danger">Inactivo</span>
                                            @else
                                            <span class="label label-success">Activo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('Usuarios.consultar',['id'=> $Usuario->idusuario,'regula'=>0])}}"
                                                class="btn btn-warning btn-xs">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{route('Usuarios.eliminar',$Usuario->idusuario)}}"
                                                method="POST" class="d-inline">
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
                                        <th>Nombre Usuario</th>
                                        <th>Nivel</th>
                                        <th>Correo Electrónico</th>
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
                Debe seleccionar un correo electrónico
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            @enderror
            <!-- Alertas de Mensaje -->

            <form method="POST" action="{{route('Usuarios.agregar')}}">
                @csrf
                <!-- Form Element sizes -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Nuevo Usuario</h3>
                    </div>

                    <div class="box-body">
                        <input name="nombreusuario" class="form-control input-lg" type="text"
                            placeholder="Nombre usuario" value={{old('nombreusuario')}}>
                        <br>
                        <select name="nivelusuario" class="form-control select2" style="width: 100%;">
                            <option value="{{old('nivelusuario')}}" disabled selected>Nivel Usuario</option>
                            @foreach ($Niveles as $nivel)
                            <option value="{{$nivel->idnivelusuario}}">{{$nivel->nombrenivelusuario}}</option>
                            @endforeach
                        </select>
                        <br>
                        <input name="correoelectronico" type="email" class="form-control"
                            placeholder="Correo Electrónico" value={{old('correoelectronico')}}>
                        <br>
                        <input name="password" type="password" class="form-control"  placeholder="Contraseña"
                            value={{old('password')}}>
                        <br>
                        <input name="password_confirmation" type="password" class="form-control"  placeholder="Repita la Contraseña"
                        value={{old('password')}}>
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
    $('#usuarios').DataTable({
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