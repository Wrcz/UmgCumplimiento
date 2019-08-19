@extends('Plantilla')

@section('seccion')

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
        <tr>
        <th scope="row">0</th>
        <td>{{$Alumno->NombreUsuario}}</td>
        <td>{{$Alumno->Correoelectronico}}</td>
        <td>{{$Alumno->Password}}</td>
        <td>@mdo</td>
        </tr>





  </tbody>
</table>

@endsection
