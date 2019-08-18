@extends('Plantilla')

@section('seccion')

<h1>Estos son los alumnos </h1>

@foreach($Alumnos as $item)
  <a href="{{Route('Prueba',$item)}}">{{$item}}</a> </br>
@endforeach

@if(!empty($nombre))

  @switch ($nombre)
    @case ($nombre=='william')
      <h2>el nombre es {{$nombre}} </h2>
      @break
  @endswitch

@endif

@endsection
