@extends('layouts.app')
@section('title')
My Profile
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">

      <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">My Profile</h4>
            <div class="modal fade" id="example-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Update My Profile</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ route('update_my_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label"><strong> Name</strong></label>
                                <input type="text" class="form-control border-info" value="{{ Auth::user()->name }}" name="name" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="message-text" class="col-form-label"><strong> Phone</strong></label>
                                <input type="text" class="form-control border-info" value="{{ Auth::user()->phone }}" name="phone" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="message-text" class="col-form-label"><strong> Email</strong></label>
                                <input type="text" class="form-control border-info" value="{{ Auth::user()->email }}" name="email" required>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="message-text" class="col-form-label"><strong> Address</strong></label>
                                <textarea class="form-control border-info" rows="10" name="address" required>{{ Auth::user()->address }}</textarea>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="message-text" class="col-form-label"><strong> Image</strong></label>
                                <input type="file" class="form-control border-info" name="user_image">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="message-text" class="col-form-label"><strong>Previous Image</strong></label><br>
                                <img src="{{ asset(Auth::user()->user_image) }}" alt="{{ Auth::user()->name }}" style="height: 100px; width:100px">
                              </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success form-control">UPDATE</button>
                            {{-- <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> --}}
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            <div class="table-responsive">
              <table class="table table-dark table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 30%" >
                      Name
                    </th>
                    <td>
                      {{Auth::user()->name}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%">
                      Phone
                    </th>
                    <td>
                      {{Auth::user()->phone}}
                    </td>
                  <tr>
                    <th style="width: 30%">
                        Email
                    </th>
                    <td>
                        {{Auth::user()->email}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%" >
                      Address
                    </th>
                    <td>
                      {{Auth::user()->address}}
                    </td>
                  </tr>
                  <tr>
                    <th style="width: 30%" >
                      Image
                    </th>
                    <td>
                        <img src="{{ asset(Auth::user()->user_image) }}" alt="{{ Auth::user()->name }}">
                    </td>
                  </tr>
                </tbody>
              </table>
              <button class="btn btn-outline-info form-control mt-3 border-info" data-toggle="modal" data-target="#example-4" data-backdrop="static" data-keyboard="false">Update Profile</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  @if (Session::get('success_insert'))
  <script >
    window.onload=function(){
      showSwal('success-message','User Successfully Added');
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
