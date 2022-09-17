<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/summernote/dist/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/quill/quill.snow.css')}}">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <script src="https://use.fontawesome.com/efb4e31c3a.js"></script>
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/admin/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('public/admin/images/favicon.png')}}" />
</head>
<body class="sidebar-fixed sidebar-dark">
  <div class="container-scroller ">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-dark">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        @php
            $logo = DB::table('logos')->where('logo_for',1)->orderBy('id','DESC')->first();
        @endphp
        <a class="navbar-brand brand-logo" href="{{ url('/home') }}"><img src="@if($logo!=NULL){{ asset($logo->logo) }}@endif" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/home') }}">@if($logo!=NULL)<img src="{{ asset($logo->logo) }}" alt="logo"/>@endif</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">
              <span class="btn"><i class="fa fa-spin fa-cog"></i> Setting</span>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
              <a class="dropdown-item" href="{{ route('my_profile') }}">
                <i class="icon-user text-primary"></i>
                My profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('change_password') }}">
                <i class="icon-user-following text-warning"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>

            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
              <i class="flag-icon flag-icon-gb"></i>
              English
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-fr"></i>
                French
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-es"></i>
                Espanol
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-lt"></i>
                Latin
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-ae"></i>
                Arabic
              </a>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="mdi mdi-multiplication"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles primary"></div>
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles pink"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img src="{{ asset(Auth::user()->user_image) }}" alt="image"/>
                  <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                  <p class="name">
                    {{Auth::user()->name}}
                  </p>
                  <p class="designation">
                    @if(Auth::user()->user_role==1)
                    Super Admin
                    @elseif(Auth::user()->user_role==2)
                    Moderator
                    @else
                    Editor
                    @endif
                  </p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/home') }}">
                <i class="icon-menu menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            @if(Auth::user()->user_role==1)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('view_users') }}">
                  <i class="fa fa-users menu-icon"></i>
                  <span class="menu-title">Users</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-target menu-icon"></i>
                <span class="menu-title">Category Options</span>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('category') }}">Category</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('sub_category') }}">Sub-category</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui" aria-expanded="false" aria-controls="ui">
                  <i class="fa fa-product-hunt menu-icon"></i>
                  <span class="menu-title">Product Options</span>
                </a>
                <div class="collapse" id="ui">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('add_product') }}">Add Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('view_product') }}">View Product</a></li>
                  </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui2" aria-expanded="false" aria-controls="ui2">
                  <i class="fa fa-first-order menu-icon"></i>
                  <span class="menu-title">Orders</span>
                </a>
                <div class="collapse" id="ui2">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('processing_orders') }}">Processing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('on_the_way_orders') }}">On the way</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('delevered_orders') }}">Delevered</a></li>
                  </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui3" aria-expanded="false" aria-controls="ui3">
                  <i class="fa fa-exchange menu-icon"></i>
                  <span class="menu-title">Exchanges</span>
                </a>
                <div class="collapse" id="ui3">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('pending_exchange') }}">Pending</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('accepted_exchange') }}">Accepted</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('completed_exchange') }}">Completed</a></li>
                  </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui4" aria-expanded="false" aria-controls="ui3">
                  <i class="fa fa-american-sign-language-interpreting menu-icon"></i>
                  <span class="menu-title">Logo</span>
                </a>
                <div class="collapse" id="ui4">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin_logo') }}">Admin Logo</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('accepted_exchange') }}">Main Logo</a></li>
                  </ul>
                </div>
            </li>
            @endif
            <li class="nav-item nav-doc">
              <a class="nav-link bg-primary" href="{{ route('logout') }}">
                <i class="fa fa-sign-out menu-icon"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>

          </ul>
        </nav>
      <!-- partial -->
      <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © @php  $date = \Carbon\Carbon::now();
                $formatedDate = $date->format('Y');
                echo($formatedDate); @endphp<a href="#"> <i class="fa fa-free-code-camp text-danger"></i> Friends Mart</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('public/admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('public/admin/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/progressbar.js/progressbar.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/morris.js/morris.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('public/admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/admin/js/template.js')}}"></script>
  <script src="{{asset('public/admin/js/settings.js')}}"></script>
  <script src="{{asset('public/admin/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('public/admin/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->
  <script src="{{asset('public/admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('public/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('public/admin/js/data-table.js')}}"></script>
  <script src="{{asset('public/admin/js/modal-demo.js')}}"></script>
  <script src="{{asset('public/admin/vendors/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/jquery.avgrund/jquery.avgrund.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('public/admin/js/alerts.js')}}"></script>
  <script src="{{asset('public/admin/js/avgrund.js')}}"></script>
  <script src="{{asset('public/admin/vendors/summernote/dist/summernote-bs4.min.js')}}"></script>
  <script src="{{asset('public/admin/vendors/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('public/admin/js/editorDemo.js')}}"></script>
</body>



</html>

