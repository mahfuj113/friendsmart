@extends('layouts.app')
@section('title')
Logo
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Logo List <button class="btn btn-outline-primary ml-3" data-toggle="modal" data-target="#example-4" data-backdrop="static" data-keyboard="false">ADD LOGO</button></h4>
        <div class="modal fade" id="example-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add New Logo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('admin_logo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                          <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label"><strong> Logo</strong></label>
                            <input type="file" class="form-control border-info" name="logo" required>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label"><strong> Logo For</strong></label>
                            <select  class="form-control border-info" name="logo_for" required>
                                <option value="1" selected>Admin</option>
                                <option value="2">Main</option>
                            </select>
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
              <table id="order-listing" class="table table-dark table-bordered text-center">
                <thead>
                  <tr>
                      <th style="width: 20%">Logo</th>
                      <th>Logo For</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($logos as $logo)
                    <tr>
                        <td><img src="{{ asset($logo->logo) }}" alt=""></td>
                        <td>
                            @if ($logo->logo_for==1)
                            Admin Panel
                            @else
                            Main Site
                            @endif
                        </td>
                        <td>{{ $logo->logo_status }}</td>
                        <td>
                        <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('logo_delete',$logo->id) }}" class="text-danger mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-trash-o"></i> </a>
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
      showSwal('success-message','Logo Successfully Added');
    }
  </script>
  @elseif(Session::get('success_updated'))
  <script >
    window.onload=function(){
      showSwal('success-message','Category Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','Logo Successfully Removed');
    }
  </script>
  @endif
@endsection
