<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MMS::{{$title}}</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{asset('adminlte/dist/img/rak_RGv_icon.ico')}}" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- datatable -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- datepicker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!--select 2 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  <!--timepicker 2 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <!-- jQuery 3 -->
  <script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <style media="screen">
  .skin-blue .main-header .navbar {
    background-color: #222d32 !important;
  }
  .skin-blue .main-header .logo {
    background-color: #27345d !important;
  }
  .skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #27345d !important;
  }
  .skin-blue .main-header .navbar {
    background-color: #222d32 !important;
  }

  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>AK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"  style="font-size:15px !important;"><b>PT. ABC</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications: style can be found in dropdown.less -->
        @if (Auth::check())
          @if ( Auth::user()->role == 'a')
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger">
                  {{ Auth::user()->approvals->count() }}
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have {{ Auth::user()->approvals->count() }} notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->

                  </li>
                  <li class="footer"><a href="{{url('approvals')}}">View all</a></li>
                </ul>
              </li>
            @endif
        @endif
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            @if (Auth::check())
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if (Auth::user()->photos != NULL)
                  <img src="{{asset('CDN_URL')}}user_image/{{Auth::user()->photos}}" class="user-image" alt="User Image">
                @else
                  <img src="{{asset('adminlte/dist/img/default-image.png')}}" class="user-image img-responsive img-circle" alt="User Image">
                @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
              @endif
            <ul class="dropdown-menu">
              {{-- class="profile-user-img img-responsive img-circle" --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <div class="user-panel">
      @if (Auth::check())
        <div class="pull-left image">
          @if (Auth::user()->photos != NULL)
            <img src="{{asset('CDN_URL')}}user_image/{{Auth::user()->photos}}" class="img-circle" alt="User Image">
          @else
            <img src="{{asset('adminlte/dist/img/default-image.png')}}" class="img-circle" alt="User Image">
          @endif
        </div>

        <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      @endif
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">MAIN NAVIGATION</li> --}}
        <li  id="menu_home"><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        @if (Auth::check())
          @if ( Auth::user()->role == 'a' || Auth::user()->role == 'm' )
            @if ( Auth::user()->role == 'a')
            <li class="treeview" id="menu_master">
              <a href="#">
                <i class="fa fa-database"></i> <span>Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  {{--USERS--}}
                  <li id="submenu_user"><a href="{{url('master/users')}}"><i class="fa fa-users"></i> User</a></li>
                  {{--ITEM--}}
                  <li id="submenu_item"><a href="{{url('master/item')}}"><i class="fa fa-inbox"></i> Master Equipment</a></li>
              </ul>
            </li>
          @endif
            <!--report-->
            <li class="treeview" id="menu_report">
              <a href="#">
                <i class="fa fa-file"></i> <span>Report</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if ( Auth::user()->role == 'a')
                  {{--Report workplane--}}
                  <li id="submenu_report_workplane"><a href="{{url('report/rworkplane')}}"><i class="fa fa-circle-o text-default"></i> Work Plan </a></li>
                @endif
                  {{--Report complaint--}}
                  <li id="submenu_report_complaint"><a href="{{url('report/rcomplaint')}}"><i class="fa fa-circle-o text-default"></i> Complaint </a></li>
                @if (Auth::user()->role == 'a')
                  {{--Report energy using--}}
                  <li id="submenu_report_energys"><a href="{{url('report/renergys')}}"><i class="fa fa-circle-o text-default"></i> Energy Using  </a></li>
                @endif
              </ul>
            </li>
            @if (Auth::user()->role == 'a')
              {{--approvals--}}
              <li id="menu_approvals"><a href="{{url('/approvals')}}"><i class="fa fa-info-circle"></i><span> Approvals</span></a></li>
            @endif
          @endif
        @endif

        @if (Auth::check())
          @if ( Auth::user()->role == 'l' || Auth::user()->role == 'a' )
            {{--LEVEL--}}
            <li id="menu_level"><a href="{{url('/level')}}"><i class="fa fa-building"></i><span> Master Location</span></a></li>
            {{--FUNLOC--}}
            <li id="menu_funloc"><a href="{{url('/funloc')}}"><i class="fa fa-tags"></i><span> Functional Location</span></a></li>
            {{--EQUIPMENTS--}}
            <li id="menu_equipment"><a href="{{url('/equipments')}}"><i class="fa fa-file-text-o"></i><span> Equipment</span></a></li>
            {{--EQUIPMENTS--}}
            <li id="menu_workplane"><a href="{{url('/workplane')}}"><i class="fa fa-random"></i><span> Work Plan</span></a></li>
            {{--Energy using--}}
            <li id="menu_energys"><a href="{{url('/energys')}}"><i class="fa fa-battery-three-quarters" aria-hidden="true"></i><span> Energy Using</span></a></li>
          @endif
          {{--complaint--}}
          <li id="menu_complaint"><a href="{{url('/complaint')}}"><i class="fa fa-list-alt" aria-hidden="true"></i><span> Complaint</span></a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <div class="box-body">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Success!</h4>
      {{session('success')}}
    </div>
    @elseif(session('status_error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Error!</h4>
      {{session('status_error')}}
    </div>
    @elseif($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        <ul>
          @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
           @endforeach
        </ul>
      </div>
    @endif
  </div>
      {!!$pagecontent!!}
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>MMS For Lazada Copyright © 2019 - @php
      echo date('Y')
    @endphp.</strong>
  </footer>
    @endif
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->


</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('adminlte/bower_components/chart.js/Chart.js')}}"></script>
<!-- Daterange -->
<script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!--datepicker-->
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!--timepicker-->
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- select2-->
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<script type="text/javascript">

$(function () {
  //datatable
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  });
});

//datatable
$('.example2').DataTable({
  'paging'      : true,
  'lengthChange': false,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : false
  });

  $('#example5').DataTable({
     'paging'      : true,
     'lengthChange': false,
     'searching'   : true,
     'ordering'    : true,
     'info'        : true,
     'autoWidth'   : false
   });

   $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

//Date picker
 $('.datepicker').datepicker({
   autoclose: true,
   format: 'yyyy-mm-dd'
 });

 $('.datepicker1').datepicker({
   autoclose: true,
   format: 'mm',
   viewMode: "months",
   minViewMode: "months"
 });

 $('.datepicker2').datepicker({
   autoclose: true,
   format: 'yyyy',
   viewMode: "years",
   minViewMode: "years"
 });


 //datimepicker
   $('#datetimepicker').timepicker({
     showInputs: false,
   });
   $('#datetimepicker-start').timepicker({

     showInputs: false,

   });
   $('#datetimepicker-end').timepicker({
     showInputs: false,
   });
 //Initialize Select2 Elements
$('.select2').select2({
    tags: false
});

//Date range picker
$('#datepickerrange').daterangepicker({
    locale: {
        format: 'YYYY-MM-DD'
    }
});


$('#menu_{{$menu}}').addClass('active');
$('#submenu_{{$submenu}}').addClass('active');

</script>
</body>
</html>
