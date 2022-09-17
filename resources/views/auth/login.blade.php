<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.bootstrapdash.com/demo/victory/template/demo/vertical-default-light/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 08:06:46 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/admin/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('public/admin/images/favicon.png')}}" />
</head>

<body class="">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth" style="background-image:url({{ asset('public/bg.jpg') }});background-repeat:no-repeat;background-size:100%">
        <div class="row w-100 " style="opacity: .85">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              {{-- <div class="brand-logo">
                <img src="https://www.bootstrapdash.com/demo/victory/template/images/logo.svg" alt="logo">
              </div> --}}
              <h2 class="text-center">LogIn</h2>
              <form class="pt-3" method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                  <label for=""><strong>User Email</strong></label>
                  <input type="email" class="form-control form-control-lg border-info" name="email" placeholder="Username">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for=""><strong>User Password</strong></label>
                  <input type="password" class="form-control form-control-lg border-info" name="password" placeholder="Password">
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  {{-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> --}}
                  {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('public/admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('public/admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/admin/js/template.js')}}"></script>
  <script src="{{asset('public/admin/js/settings.js')}}"></script>
  <script src="{{asset('public/admin/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.bootstrapdash.com/demo/victory/template/demo/vertical-default-light/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 08:06:46 GMT -->
</html>
