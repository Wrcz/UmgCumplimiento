   <!-- jQuery 3 -->
<script src="{{asset("assets/lte/bower_components/jquery/dist/jquery.min.js")}}"></script>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UMGCumplimiento APP</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset("assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
   <!-- DataTables -->
 <link rel="stylesheet" href="{{asset("assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("assets/lte/bower_components/font-awesome/css/font-awesome.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset("assets/lte/bower_components/Ionicons/css/ionicons.min.css")}}">
  <!-- Checkboxes -->
  <link rel="stylesheet" href="{{asset("assets/lte/plugins/iCheck/all.css")}}">
   <!-- Bootstrap Color Picker -->
   <link rel="stylesheet" href="{{asset("assets/lte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css")}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset("assets/lte/bower_components/select2/dist/css/select2.min.css")}}">
  

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("assets/lte/dist/css/AdminLTE.min.css")}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset("assets/lte/dist/css/skins/_all-skins.min.css")}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 

</head>
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">


  <!-- encabezado -->
  @include('Themes/lte/header')
  
  <!-- Barra laeral -->
  @include('Themes/lte/aside')

    <div class="content-wrapper">
      
      <!-- Contenido de Titulos-->
     @yield('titulo')

      <div class="content">
            <!-- Contenido Principal-->
                 @yield('seccion')
     </div> 
     <!-- content -->

    </div> 
    <!-- content-wrapper -->

    </div>
   <!-- /.wrapper --> 

   <!-- /.footer-body -->
  @include('Themes/lte/footer')

    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset("assets/lte/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script> 
    <!-- DataTables -->
    <script src="{{asset("assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset("assets/lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
    <!-- FastClick -->
    <script src="{{asset("assets/lte/bower_components/fastclick/lib/fastclick.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/lte/dist/js/adminlte.min.js")}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset("assets/lte/plugins/iCheck/icheck.min.js")}}"></script>

      </body>
</html>
