<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')
  


  @section('titulo')
  <section class="content-header">
        <h1> Gestión de Empresas 
            <small>Mantenimiento</small> 
         </h1>     
        <ol class="breadcrumb">
            <li><a href="{{route('bienvenido')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{route('Empresas.empresas')}}">Empresas</a></li> 
         </ol>
      </section>
  @endsection

             <div class="box">
             <div class="box-body">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Información</h4>
                Esta página le permite dar mantenimiento a las empresas a las cuales necesita gestionar el cumplimiento normativo.
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
                                    <h3 class="box-title">Listado de Empresas</h3>
                            </div>
                       <div class="box-body">
                            <table id="empresas" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                      <th>Id</th>
                                      <th>Nombre Empresa</th>
                                      <th>Industria</th>
                                      <th>Dirección</th>
                                      <th>Correo Electrónico</th>
                                      <th>País</th>
                                      <th>Estado</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                 @foreach ($Empresas as $empresa)
                                    <tr>
                                      <td>{{$empresa->idempresa}}</td>
                                      <td>{{$empresa->nombreempresa}}</td>
                                      <td>{{$empresa->tipoindustria}}</td>
                                      <td>{{$empresa->direccion}}</td>
                                      <td>{{$empresa->correoelectronico}}</td>
                                      <td>{{$empresa->pais}}</td>
                                      <td>
                                        @if ($empresa->estadoempresa==0)
                                        <span class="label label-danger">Inactiva</span>
                                        @else
                                          <span class="label label-success">Activa</span>
                                        @endif
                                      </td>
                                          <td>
                                            <a href="{{route('Empresas.consultar',$empresa->idempresa)}}"  class="btn btn-warning btn-xs">Editar</a>
                                          </td>
                                          <td>
                                            <form action="{{route('Empresas.eliminar',$empresa->idempresa)}}"  method="POST" class="d-inline">
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
                                        <th>Nombre Empresa</th>
                                        <th>Industria</th>
                                        <th>Dirección</th>
                                        <th>Correo Electrónico</th>
                                        <th>País</th>
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
        @error('nombreempresa')
              <div class="alert alert-warning alert-dismissible" role="alert">
                Debe ingresar Nombre de Empresa
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
        @enderror
        @error('tipoindustria')
        <div class="alert alert-warning alert-dismissible" role="alert">
          Debe seleccionar un tipo de industria
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
        @enderror
        @error('pais')
        <div class="alert alert-warning alert-dismissible" role="alert">
          Debe ingrear un pais
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
        @enderror
        @error('direccion')
        <div class="alert alert-warning alert-dismissible" role="alert">
          Debe seleccionar una dirección
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

        <form method="POST" action="{{route('Empresas.agregar')}}">
            @csrf
        <!-- Form Element sizes -->
             <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Agregar Nueva Empresa</h3>
              </div>

              <div class="box-body">
                <input name="nombreempresa" class="form-control input-lg" type="text" placeholder="Nombre Empresa" value={{old('nombreempresa')}}>
                <br>
                    <select name="tipoindustria" class="form-control select2"  style="width: 100%;">
                        <option value="{{old('tipoindustria')}}" disabled selected>Tipo de Industria</option>
                        <option>Alimenticia</option>
                        <option>Farmacéutica</option>
                        <option>Metalúrgica </option>
                        <option>Química</option>
                        <option>Textil</option>
                        <option>Automotriz</option>
                        <option>Tecnología</option>
                        <option>Inmobiliaria</option>
                    </select>
                <br>
                <input name="pais" type="country" class="form-control" type="text" placeholder="Pais" value={{old('pais')}}>
                <br>
                <input name="direccion" type="address" class="form-control" type="text" placeholder="Dirección" value={{old('direccion')}}>
                <br>
                <input name="correoelectronico" type="email" class="form-control" placeholder="Correo Electrónico" value={{old('correoelectronico')}}>
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
    $('#empresas').DataTable({
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

  
 
