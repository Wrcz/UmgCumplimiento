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
      <th scope="col">Correo</th>
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
        <td>{{$item->Correoelectronico}}</td>
        <td>{{$item->Password}}</td>
        <td>@mdo</td>
        </tr>
      @endforeach




  </tbody>
</table>

<form method="POST" action="{{route('Usuario.crear')}}" >

  @csrf
  <input type="text" name="NombreUsuario" placeholder="nombre" class="form-control mb-2">
    <input type="text" name="Password" placeholder="contraseña" class="form-control mb-2">
      <input type="text" name="NivelUsuario" placeholder="nivel" class="form-control mb-2">
  <button class="btn btn-primary btn-block" type="submit">Agregar </button>

</form>
@endsection
