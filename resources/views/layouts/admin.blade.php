<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />

  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>Dashboard</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset($user->image ?? 'images/avatar.png') }}" class="user-image" alt="User Image" />
                  <span class="hidden-xs">admin</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-footer">
                    {{-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> --}}
                    <div class="pull-right">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-default btn-flat">Sign out</button>
                        </form>
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset($user->image ?? 'images/avatar.png') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>admin</p>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="{{ route('admin.users') }}">
                <i class="fa fa-laptop"></i>
                <span>Users</span>
                {{-- <i class="fa fa-angle-left pull-right"></i> --}}
              </a>
            </li>
            <li class="treeview">
              <a href="{{ route('admin.countries.index') }}">
                <i class="fa fa-edit"></i> <span>Countries</span>
                {{-- <i class="fa fa-angle-left pull-right"></i> --}}
              </a>
            </li>
            <li class="treeview">
              <a href="{{ route('admin.interesting-types.index') }}">
                <i class="fa fa-table"></i> <span>Interesting Types</span>
                {{-- <i class="fa fa-angle-left pull-right"></i> --}}
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          {{-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol> --}}
        </section>

        <section class="content">
          @yield('content')
        </section>
      </div>
      <footer class="main-footer">
        <strong>Copyright &copy; 2021<a href="http://www.magaxat.com">Magaxat</a>.</strong> All rights reserved.
      </footer>
    </div>

    <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dist/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dist/js/demo.js') }}" type="text/javascript"></script>
  </body>
</html>
