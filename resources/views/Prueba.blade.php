@extends('Plantilla')

@section('seccion')
  @if (session('mensaje'))
    <div class="alert alert-success">
      {{session('mensaje')}}
  </div>
  @endif

<h1>Estos son los alumnos </h1>

</br>
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">NivelUsuario</th>
      <th scope="col">Password</th>
    </tr>
  </thead>
  <tbody>

      @foreach ($Alumnos as $item)
          <tr>
        <th scope="row">{{$item->id}}</th>
        <td>
<a href="{{route('Usuario.detalle',$item)}}">
          {{$item->NombreUsuario}}
</a>
        </td>
        <td>{{$item->NivelUsuario}}</td>
        <td>{{$item->Password}}</td>
        <td>
              <a href="{{route('Usuario.editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>

              <form action="{{route('Usuario.eliminar',$item)}}"  method="POST" class="d-inline">
                @method('DELETE')
                @csrf

              <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
            </form>

          </td>
        </tr>
      @endforeach

  </tbody>
</table>

{{$Alumnos->links()}}
<form method="POST" action="{{route('Usuario.crear')}}" >

  @csrf
  @error('NombreUsuario')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      Debe ingresar Nombre de Usuario
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </div>
  @enderror
  <input type="text" name="NombreUsuario" placeholder="nombre" class="form-control mb-2" value={{old('NombreUsuario')}}>
    <input type="text" name="Password" placeholder="contraseña" class="form-control mb-2" value={{old('Password')}}>
      <input type="text" name="NivelUsuario" placeholder="nivel" class="form-control mb-2" value={{old('NivelUsuario')}}>
  <button class="btn btn-primary btn-block" type="submit">Agregar </button>

</form>
@endsection
