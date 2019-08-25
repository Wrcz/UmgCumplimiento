@extends('Plantilla')

@section('seccion')
  @if (session('mensaje'))
    <div class="alert alert-success">
      {{session('mensaje')}}
  </div>
  @endif

  @section('titulo')
  <section class="content-header">
        <h1> Bienvenidos a UMGCumplimiento </h1>
         <!-- <small>Blank example to the fixed layout</small> -->
        
         
        <!--  <ol class="breadcrumb">-->
        <!--    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
        <!--    <li><a href="#">Layout</a></li>-->
        <!--    <li class="active">Fixed</li>-->
       <!-- </ol>-->
      </section>
  @endsection

   <div class="box-body">
 
   </br>
  <div class="alert alert-info alert-dismissible">
    
    <h4><i class="icon fa fa-info"></i> Información</h4>
    Aplicacion con funciones básicas de gestión del cumplimiento que le permitirá gestionar multiples regulaciones para 
    multiples empresas, registrar evidencias de cumplimiento, informes acerca del estado de cumplimiento de regulaciones, gestión de 
    usuarios, entre otras.
  </div>

  </div>
  @endsection


