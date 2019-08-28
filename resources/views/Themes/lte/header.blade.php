<header class="main-header">
   <!-- Logo -->
   <a href="{{route("bienvenido")}}/" class="logo">
     <!-- mini logo for sidebar mini 50x50 pixels -->
     <span class="logo-mini"><b>UMG</b></span>
     <!-- logo for regular state and mobile devices -->
     <span class="logo-lg"><b>UMG</b>Cumplimiento</span>
   </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top">
     <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Cambiar Navegación</span>
    </a>

     <div class="navbar-custom-menu">
       <ul class="nav navbar-nav">
         <!-- Messages: style can be found in dropdown.less-->
         <li class="dropdown messages-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-envelope-o"></i>
             <span class="label label-success">0</span>
           </a>
                    </li>
         <!-- Notifications: style can be found in dropdown.less -->
         <li class="dropdown notifications-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-bell-o"></i>
             <span class="label label-warning">0</span>
           </a>
           
         </li>
         <!-- Tasks: style can be found in dropdown.less -->
         <li class="dropdown tasks-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-flag-o"></i>
             <span class="label label-danger">0</span>
           </a>
           
         </li>
         <!-- User Account: style can be found in dropdown.less -->
         <li class="dropdown user user-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <img src="{{asset("assets/lte/dist/img/avatar6.png")}}"  class="user-image" alt="User Image">
             <span class="hidden-xs">Nombre Usuario</span>
           </a>
           <ul class="dropdown-menu">
             <!-- User image -->
             <li class="user-header">
               <img src="{{asset("assets/lte/dist/img/avatar6.png")}}" class="img-circle" alt="User Image">

               <p>
                 Nombre Usuario              
               </p>
             </li>
            
             <!-- Menu Footer-->
             <li class="user-footer">
                  <div class="pull-right">
                 <a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>
               </div>
             </li>
           </ul>
         </li>
        
       </ul>
     </div>
   </nav>
 </header>
