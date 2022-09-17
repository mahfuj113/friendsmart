@extends('layouts.app')
@section('title')
Products
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Products List</h4>

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table table-dark table-bordered">
                <thead>
                  <tr>
                      <th style="width: 20%">Name</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Details</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_name }} <br><br>
                            <strong class="text-danger">Code : </strong> {{$product->product_code}}<br><br>
                            <strong class="text-danger">Brand : </strong> {{$product->product_brand}}<br><br>

                        </td>
                        <td>
                            <strong class="text-danger">Category : </strong>{{ $product->category_name }} <br><br>
                            <strong class="text-danger">Sub Category : </strong>{{ $product->sub_category_name }} <br><br>
                            <strong class="text-danger">Price : </strong> {{$product->product_price}} BDT<br><br>
                            <strong class="text-danger">Quantity : </strong> {{$product->product_quantity}}<br><br>
                            <strong class="text-danger">Discount : </strong> {{$product->product_discount}} %<br><br>
                            @if ($product->product_discount>0)
                            <strong class="text-danger">Discount Price : </strong> {{$product->product_discount_price}} BDT<br><br>
                            @endif
                        </td>
                        <td><img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}"></td>
                        <td>
                            <strong class="text-danger">Color : </strong> {{$product->product_color}}<br><br>
                            <strong class="text-danger">Size : </strong> {{$product->product_size}}<br><br>
                            <strong class="text-danger">Details : </strong><br> {!!$product->product_details!!}<br><br>
                        </td>
                        <td>{{ $product->product_status }}</td>
                        <td>
                            <a href="{{ route('edit_product',$product->id) }}" style="font-size:18px;text-decoration:none;color:white"><i class="fa fa-pencil-square-o"></i> </a><br><br>
                            @if ($product->product_status=='Enable')
                            <a href="{{ route('update_product_status',['Disable',$product->id]) }}" class="text-warning" style="font-size:18px"><i class="fa fa-window-close"></i> </a><br><br>
                            @else
                            <a href="{{ route('update_product_status',['Enable',$product->id]) }}" class="text-success" style="font-size:18px"><i class="fa fa-check-square"></i> </a><br><br>
                            @endif
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('delete_product',$product->id) }}" class="text-danger" style="font-size:18px"><i class="fa fa-trash-o"></i> </a><br><br>
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
      showSwal('success-message','product Successfully Added');
    }
  </script>
  @elseif(Session::get('success_updated'))
  <script >
    window.onload=function(){
      showSwal('success-message','Product Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','Product Successfully Removed');
    }
  </script>
  @endif
@endsection
