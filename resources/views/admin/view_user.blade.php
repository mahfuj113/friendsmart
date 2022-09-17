@extends('layouts.app')
@section('title')
Users
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Users List <button class="btn btn-outline-primary ml-3" data-toggle="modal" data-target="#example-4" data-backdrop="static" data-keyboard="false">ADD USER</button></h4>
        <div class="modal fade" id="example-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add New User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('add_user') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                          <div class="form-group col-md-7">
                            <label for="recipient-name" class="col-form-label"><strong> Name</strong></label>
                            <input type="text" class="form-control border-info" name="name" required>
                          </div><div class="form-group col-md-5">
                            <label for="recipient-name" class="col-form-label"><strong> Role</strong></label>
                            <select name="user_role" class="form-control border-info"  required>
                                <option value="2" selected>Moderator</option>
                                <option value="3">Editor</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label"><strong> Phone</strong></label>
                            <input type="text" class="form-control border-info" name="phone" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label"><strong> Email</strong></label>
                            <input type="text" class="form-control border-info" name="email" required>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label"><strong> Address</strong></label>
                            <textarea class="form-control border-info" rows="10" name="address" required></textarea>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label"><strong> Image</strong></label>
                            <input type="file" class="form-control border-info" name="user_image" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label"><strong> Password</strong></label>
                            <input type="password" class="form-control border-info" name="password" required>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success form-control">ADD</button>
                        {{-- <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> --}}
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table table-dark table-bordered">
                <thead>
                  <tr>
                      <th style="width: 20%">Name</th>
                      <th>Details</th>
                      <th>Image</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <strong>Phone : </strong>{{ $user->phone }} <br><br>
                            <strong>Email : </strong>{{ $user->email }} <br><br>
                            <strong>Address </strong> <br><br>
                            {{ $user->address }}
                        </td>
                        <td><img src="{{ asset($user->user_image) }}" alt="{{ $user->name }}"></td>
                        <td class="text-danger">
                            @if($user->user_role==1)
                            Super Admin
                            @elseif($user->user_role==2)
                            Moderator
                            @else
                            Editor
                            @endif
                        </td>
                        <td>{{ $user->user_status }}</td>
                        <td>
                            <div class="modal fade" id="example-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-dark" id="ModalLabel" >Update User Info</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                      <form method="POST" action="{{ route('update_user') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                              <div class="form-group col-md-7">
                                                <label for="recipient-name" class="col-form-label"><strong> Name</strong></label>
                                                <input type="text" class="form-control border-info" name="name" value="{{ $user->name }}" required>
                                                <input type="hidden" class="form-control border-info" name="id" value="{{ $user->id }}" required>
                                              </div><div class="form-group col-md-5">
                                                <label for="recipient-name" class="col-form-label"><strong> Role</strong></label>
                                                <select name="user_role" class="form-control border-info"  required>
                                                    <option value="2" @if($user->user_role==2)selected @endif>Moderator</option>
                                                    <option value="3" @if($user->user_role==3)selected @endif>Editor</option>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label"><strong> Phone</strong></label>
                                                <input type="text" class="form-control border-info" value="{{ $user->phone }}" name="phone" required>
                                              </div>
                                              <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label"><strong> Email</strong></label>
                                                <input type="text" class="form-control border-info" value="{{ $user->email }}" name="email" required>
                                              </div>
                                              <div class="form-group col-md-12">
                                                <label for="message-text" class="col-form-label"><strong> Address</strong></label>
                                                <textarea class="form-control border-info" rows="10" name="address" required>{{ $user->address }}</textarea>
                                              </div>
                                              <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label"><strong> Image</strong></label>
                                                <input type="file" class="form-control border-info" name="user_image">
                                              </div>
                                              <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label"><strong> Previous Image</strong></label><br>
                                                <img src="{{ asset($user->user_image) }}" alt="" style="height: 100px;width:100px">
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success form-control" >UPDATE</button>
                                            {{-- <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> --}}
                                        </div>
                                      </form>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            <a data-toggle="modal" data-target="#example-{{ $user->id }}" data-backdrop="static" data-keyboard="false" class="text-white" style="font-size:18px"><i class="fa fa-pencil-square-o"></i> </a><br><br>
                            @if ($user->user_status=='Enable')
                            <a href="{{ route('update_user_status',['Disable',$user->id]) }}" class="text-warning" style="font-size:18px"><i class="fa fa-window-close"></i> </a><br><br>
                            @else
                            <a href="{{ route('update_user_status',['Enable',$user->id]) }}" class="text-success" style="font-size:18px"><i class="fa fa-check-square"></i> </a><br><br>
                            @endif
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('delete_user',$user->id) }}" class="text-danger" style="font-size:18px"><i class="fa fa-trash-o"></i> </a><br><br>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
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
      showSwal('success-message','User Info Successfully Updated');
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
