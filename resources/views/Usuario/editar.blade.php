@extends('Plantilla')

@section('seccion')
  @if (session('mensaje'))
    <div class="alert alert-success">
      {{session('mensaje')}}
  </div>
  @endif

  <form method="POST" action="{{route('Usuario.update',$Alumno->id)}}" >
    @method('PUT');
    @csrf
    <h1>Editar el Alumno: {{$Alumno->NombreUsuario}}</h1>

    <input type="text" name="NombreUsuario" placeholder="nombre" class="form-control mb-2" value={{$Alumno->NombreUsuario}}>
      <input type="text" name="Password" placeholder="contraseña" class="form-control mb-2" value={{$Alumno->Password}}>
        <input type="text" name="NivelUsuario" placeholder="nivel" class="form-control mb-2" value={{$Alumno->NivelUsuario}}>
    <button class="btn btn-warning btn-block" type="submit">Editar </button>


  </form>
@endsection
