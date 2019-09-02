<!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="{{asset("assets/lte/dist/img/avatar6.png")}}" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p> {{auth()->user()->nombreusuario}}  </p>
         <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        
       </div>
     </div>
     <!-- search form -->
     <form action="#" method="get" class="sidebar-form">
       <div class="input-group">
         <input type="text" name="q" class="form-control" placeholder="Buscar...">
             <span class="input-group-btn">
               <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
               </button>
             </span>
       </div>
     </form>
     <!-- /.search form -->
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MENU PRINCIPAL</li>

      
       <li class="treeview">
         <a href="#">
           <i class="fa fa-dashboard"></i> <span>Configuración</span>
           <span class="pull-right-container">
             <i class="label label-primary pull-right">3</i>
           </span>
         </a>
         <ul class="treeview-menu">
            @if ( auth()->user()->idnivelusuario==1  )
               <li><a href="{{route('Usuarios.usuarios')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
           @endif
           @if ( auth()->user()->idnivelusuario==1  || auth()->user()->idnivelusuario==2  )
           <li><a href="{{route('Empresas.empresas')}}"><i class="fa fa-circle-o"></i> Empresas</a></li>
           @endif
           @if ( auth()->user()->idnivelusuario==1  || auth()->user()->idnivelusuario==2  || auth()->user()->idnivelusuario==3 )
           <li><a href="{{route('Regulaciones.regulaciones')}}"><i class="fa fa-circle-o"></i> Regulaciones</a></li>
           @endif
         </ul>
       </li>
      

       <li class="treeview">
         <a href="#">
           <i class="fa fa-pie-chart"></i>
           <span>Cumplimiento</span>
           <span class="pull-right-container">
          <span class="label label-primary pull-right">1</span>
           </span>
         </a>
         <ul class="treeview-menu">
            @if ( auth()->user()->idnivelusuario==1  || auth()->user()->idnivelusuario==2 || auth()->user()->idnivelusuario==3 )
           <li><a href="{{route('Cumplimiento.cumplimiento')}}"><i class="fa fa-circle-o"></i> Gestión de Cumplimiento</a></li>
            @endif
                   </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-laptop"></i>
           <span>Informes</span>
           <span class="pull-right-container">
            <span class="label label-primary pull-right">2</span>
           </span>
         </a>
         <ul class="treeview-menu">
            @if ( auth()->user()->idnivelusuario==1  || auth()->user()->idnivelusuario==2 || auth()->user()->idnivelusuario==3  || auth()->user()->idnivelusuario==4)
            
            <li><a href="{{route('Informe.parametroinforme')}}"><i class="fa fa-circle-o"></i> Cumplimiento</a></li>
          
           @endif
        </ul>
       </li>
           
     </ul>
   </section>
   <!-- /.sidebar -->
 </aside>

 <!-- =============================================== -->
