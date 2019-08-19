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

      @foreach ($Alumnos as $item)
          <tr>
        <th scope="row">{{$item->id}}</th>
        <td>{{$item->NombreUsuario}}</td>
        <td>{{$item->Correoelectronico}}</td>
        <td>{{$item->Password}}</td>
        </tr>
      @endforeach




  </tbody>
</table>

@endsection
