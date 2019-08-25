<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')


  @section('titulo')
  <section class="content-header">
        <h1> Gestión de Empresas 
            <small>Edicion de Empresas</small> 
         </h1>     
        <ol class="breadcrumb">
            <li><a href="{{route('bienvenido')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{route('Empresas.empresas')}}">Empresas</a></li> 
            <li><a href="#">Editar Empresa</a></li> 
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
        
      

        <form method="POST" action="{{route('Empresas.actualizar',$Empresa->idempresa)}}">
            @method('PUT')
            @csrf
      <!-- Form Element sizes -->
             <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Modificación de Empresa</h3>
              </div>
                 <div class="box-body">
                  <input name="idempresa" class="form-control input-lg" type="text" placeholder="id" value={{$Empresa->idempresa}} disabled>
                </br>
                
                <input name="nombreempresa" class="form-control input-lg" type="text" value="{{$Empresa->nombreempresa}}">
                <br>
                    <select name="tipoindustria" class="form-control select2"  style="width: 100%;" value="{{$Empresa->tipoindustria}}">
                        <option @if ($Empresa->tipoindustria=="Alimenticia") Selected  @endif >Alimenticia</option>
                        <option @if ($Empresa->tipoindustria=="Farmacéutica") Selected @endif >Farmacéutica</option>
                        <option @if ($Empresa->tipoindustria=="Metalúrgica") Selected  @endif >Metalúrgica </option>
                        <option @if ($Empresa->tipoindustria=="Química") Selected      @endif >Química</option>
                        <option @if ($Empresa->tipoindustria=="Textil") Selected       @endif >Textil</option>
                        <option @if ($Empresa->tipoindustria=="Automotriz") Selected   @endif >Automotriz</option>
                        <option @if ($Empresa->tipoindustria=="Tecnología") Selected   @endif >Tecnología</option>
                        <option @if ($Empresa->tipoindustria=="Inmobiliaria") Selected   @endif >Inmobiliaria</option>
                    </select>
                <br>
                <input name="pais" type="country" class="form-control" type="text" placeholder="Pais" value={{$Empresa->pais}}>
                <br>
                <input name="direccion" type="address" class="form-control" type="text" placeholder="Dirección" value={{$Empresa->direccion}}>
                <br>
                <input name="correoelectronico" type="email" class="form-control" placeholder="Correo Electrónico" value={{$Empresa->correoelectronico}} >
                
                <br>
                
                    <input type="checkbox" id="estadoempresa" 
                    @if ($Empresa->estadoempresa==1)
                      checked
                    @else
                      unchecked
                    @endif>
                    <label class="custom-control-label" for="estadoempresa">Estado Empresa</label>
              

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


  @endsection

  
 
