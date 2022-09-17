@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<div class="container-fluid pt-5" >
    <div class="row px-xl-5 col-10 mx-auto pb-4" >
        @if (Session::get('success_insert'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <strong>Registration complete successfully .You can log in now </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="col-lg-5 mb-5 mx-auto pb-4" style="box-shadow: 0px 0px 5px black;">
            <div class="text-center mt-3" style="margin-bottom: 60px;">
                <h4 class="section-title px-5"><span class="px-2">Sign In</span></h4>
            </div>
            <div class="contact-form mt-4 mb-4">
                <form method="POSt" action="{{ route('visitor_login') }}">
                    @csrf
                    <div class="control-group my-4">
                        <label for=""> <strong>Enter Your Email</strong></label><br>
                        <input type="email" class="form-control border-dark" name="visitor_email" placeholder="Your Email" required="required" autofocus value="{{old('visitor_email')}}"/>
                        @if (Session::get('err_email'))
                        <p class="text-danger">Email does not match </p>
                        @endif

                    </div>
                    <div class="control-group">
                        <label for=""> <strong>Enter Your Password</strong></label><br>
                        <input type="password" class="form-control border-dark" name="visitor_password" placeholder="Password" required="required" value="{{old('visitor_password')}}"/>
                        @if (Session::get('err_password'))
                        <p class="text-danger">Invalid Password</p>
                        @endif
                    </div>
                    <div class="mt-4 mb-4">
                        <button class="btn btn-outline-dark py-2 px-4 float-right form-control" type="submit" >LogIn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
