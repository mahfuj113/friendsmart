@extends('layouts.app')
@section('title')
Change Password
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">

      <div class="col-lg-6 mx-auto grid-margin stretch-card">
        <div class="card" style="box-shadow: 0px 0px 10px black">
          <div class="card-body">
            <h4 class="card-title text-center">Change Password</h4>

            <form class="forms-sample" method="POST" action="{{ route('change_password') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Current Password</strong></label>
                  <input type="password" class="form-control border-danger" name="current_password" >
                  @if (Session::get('err1'))
                            <span class="text-danger">{{Session::get('err1')}}</span>

                    @endif
                    @php
                            session()->forget('err1');
                    @endphp
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><strong>New Password</strong></label>
                  <input type="password" class="form-control border-danger" name="new_password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><strong>Re-type New Password</strong></label>
                    <input type="password" class="form-control border-danger" name="r_new_password">
                    @if (Session::get('err'))
                    <span class="text-danger">{{Session::get('err')}}</span>

                    @endif
                    @php
                            session()->forget('err');
                    @endphp
                </div>
                <button type="submit" class="btn btn-success mr-2 form-control">Change</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  @if (Session::get('success_change'))
  <script >
    window.onload=function(){
      showSwal('success-message','Password Successfully Changed');
    }
  </script>
  @elseif(Session::get('success_updated'))
  <script >
    window.onload=function(){
      showSwal('success-message','My Profile Info Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','User Successfully Removed');
    }
  </script>
  @endif
@endsection
