<!--Extiendo de la plantilla-->
@extends('Plantilla')

@section('seccion')


@section('titulo')
<section class="content-header">
    <h1> Gestión de Regulaciones
        <small>Edición de Regulaciones</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("bienvenido")}}/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('Regulaciones.regulaciones')}}">Regulacines</a></li>
        <li><a href="{{route('Regulaciones.regulaciones',$Regulaciones->idregulacion)}}">Editar Regulación</a></li>
        <li><a href="#">Editar Sanciones</a></li>
    </ol>
</section>
@endsection




@endsection