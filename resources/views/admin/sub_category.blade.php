@extends('layouts.app')
@section('title')
Sub Categories
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Sub Category List <button class="btn btn-outline-primary ml-3" data-toggle="modal" data-target="#example-4" data-backdrop="static" data-keyboard="false">ADD SUB CATEGORY</button></h4>
        <div class="modal fade" id="example-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add New Sub Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('sub_category') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label"><strong>Select Category</strong></label>
                            <select class="form-control border-info" name="category_id" required>
                                <option value="" selected disabled>Select One</option>
                                @php
                                    $cats = DB::table('categories')->where('category_status','Enable')->where('category_delete',1)->get();
                                @endphp
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label"><strong>Sub Category Name</strong></label>
                            <input type="text" class="form-control border-info" name="sub_category_name" required>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="message-text" class="col-form-label"><strong>Sub Category Details</strong></label>
                            <textarea  class="form-control border-info" name="sub_category_details" rows="8" required></textarea>
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
                      <th style="width: 20%">Sub Category Name</th>
                      <th style="width: 20%">Category Name</th>
                      <th>Details</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($sub_categories as $sub_category)
                    <tr>
                        <td>{{ $sub_category->sub_category_name }}</td>
                        <td>{{ $sub_category->category_name }}</td>
                        <td>{{ $sub_category->sub_category_details}}</td>
                        <td>{{ $sub_category->sub_category_status }}</td>
                        <td>
                            <div class="modal fade" id="example-{{ $sub_category->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-dark" id="ModalLabel" >Update Sub Category Info</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                      <form method="POST" action="{{ route('sub_category_update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="recipient-name" class="col-form-label"><strong>Select Category</strong></label>
                                                <select class="form-control border-info" name="category_id" required>
                                                    <option value="" selected disabled>Select One</option>
                                                    @php
                                                        $cats = DB::table('categories')->where('category_status','Enable')->where('category_delete',1)->get();
                                                    @endphp
                                                    @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}" @if($cat->id==$sub_category->id) selected @endif>{{ $cat->category_name }}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                            <div class="form-group col-md-12">
                                                <label for="recipient-name" class="col-form-label"><strong>Sub Category Name</strong></label>
                                                <input type="text" class="form-control border-info" name="sub_category_name" required value="{{ $sub_category->sub_category_name }}">
                                                <input type="hidden"  name="sub_category_id" required value="{{ $sub_category->id }}">
                                              </div>
                                              <div class="form-group col-md-12">
                                                <label for="message-text" class="col-form-label"><strong>Sub Category Details</strong></label>
                                                <textarea  class="form-control border-info" name="sub_category_details" rows="8" required>{{ $sub_category->sub_category_details }}</textarea>
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
                            <a data-toggle="modal" data-target="#example-{{ $sub_category->id }}" data-backdrop="static" data-keyboard="false" class="text-white mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-pencil-square-o"></i> </a>
                            @if ($sub_category->sub_category_status=='Enable')
                            <a  href="{{ route('sub_category_status_update',['Disable',$sub_category->id]) }}" class="text-warning mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-window-close"></i>
                            @else
                            <a href="{{ route('sub_category_status_update',['Enable',$sub_category->id]) }}" class="text-success mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-check-square"></i>
                            @endif
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('sub_category_delete',$sub_category->id) }}" class="text-danger mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-trash-o"></i> </a>
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
      showSwal('success-message','Sub Category Successfully Added');
    }
  </script>
  @elseif(Session::get('success_updated'))
  <script >
    window.onload=function(){
      showSwal('success-message','Sub Category Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','Sub Category Successfully Removed');
    }
  </script>
  @endif
@endsection
