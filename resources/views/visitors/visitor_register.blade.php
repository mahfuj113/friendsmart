@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<div class="container-fluid pt-5" >
    <div class="row px-xl-5 col-10 mx-auto pb-4" >
        @if (Session::get('success_insert'))
        <div class="alert alert-success alert-dismissible fade show col-7 mx-auto" role="alert">
            <strong>Registration complete successfully .You can log in now </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="col-lg-7 mb-5 mx-auto pb-4" style="box-shadow: 0px 0px 5px green;">
            <div class="text-center mt-3" style="margin-bottom: 60px;">
                <h4 class="section-title px-5"><span class="px-2">Register</span></h4>
            </div>
            <div class="contact-form">
                <form method="POST" action="{{ route('visitor_register') }}">
                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control border-success" name="visitor_name" placeholder="Your Name" required="required">
                    </div>
                    <div class="control-group mt-3">
                        <input type="radio" value="Male" name="visitor_gender" checked> Male
                        <input type="radio" value="Female" name="visitor_gender" > Female
                    </div>
                    <div class="control-group mt-3">
                        <input type="email" class="form-control border-success"  name="visitor_email" placeholder="Your Email" required="required">
                        @error('visitor_email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="control-group mt-2">
                        <input type="text" class="form-control border-success"  name="visitor_phone" placeholder="Phone Number" required="required" >
                        @error('visitor_phone')
                                <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="control-group mt-2">
                        <textarea class="form-control border-success" rows="6"  name="visitor_address" placeholder="Address" required="required"></textarea>
                    </div>
                    <div class="control-group mt-2">
                        <input type="password" class="form-control border-success"  name="visitor_password" placeholder="Password" required="required" >
                    </div>
                    <div>
                        <button class="btn btn-outline-success py-2 px-4 mt-4 float-right form-control" type="submit" >SignUp</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Contact End -->
@endsection
