@extends('layouts.app')
@section('title')
Orders
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table table-dark table-bordered">
                <thead>
                  <tr>
                      <th style="width: 20%">Order ID</th>
                      <th>Customer Details</th>
                      <th>Payment Details</th>
                      <th>Others</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id+100 }}</td>
                        <td>
                            <small><strong class="text-danger">Name : </strong><br>{{$order->customer_name}}</small><br>
                            <small><strong class="text-danger">Email : </strong><br>{{$order->customer_email}}</small><br>
                            <small><strong class="text-danger">Phone : </strong><br>{{$order->customer_phone}}</small><br>
                            <small><strong class="text-danger">Address : </strong><br>{{$order->customer_address1}}</small><br>
                            <small>{{$order->customer_address2}}</small><br>
                        </td>
                        <td>
                            <strong class="text-danger">Price : </strong>{{$order->total_price}} BDT<br>
                            @if ($order->point_use>0)
                            <small><strong class="text-danger">Point Use : </strong>{{$order->point_use}}</small><br>
                            @endif

                            <small>
                                <span class="text-danger">Payment-method : </span><br>@if ($order->payment_method==1)
                                        Online
                                        @else
                                        Cash On Delevery
                                @endif
                            </small>
                        </td>
                        <td>
                            <strong class="text-warning">{{ $order->order_status }}</strong><br>
                            <small>
                                <strong class="text-danger">Order Date : </strong><br>
                                {{$order->created_at}} <br>
                                <strong class="text-danger">Delevery(Approx) : </strong><br>
                                {{$order->updated_at}} <br>
                                <strong class="text-danger">Delevered At : </strong><br>
                                {{$order->delevered_at}}
                            </small>
                        </td>
                        <td>
                            <div class="modal fade" id="example-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-dark" id="ModalLabel" >Product Details</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        @php
                                        $pds = DB::table('order_products')->join('products','order_products.order_product_id','products.id')->where('order_id',$order->id)->select('order_products.*','products.product_name','products.product_image','products.product_code')->get();
                                    @endphp
                                    @foreach ($pds as $pd)
                                    <div class="row">
                                        <div class="col-md-4 text-center"><img src="{{ asset($pd->product_image) }}" alt="" style="height:50px;width:50px;"></div>
                                        <div class="col-md-4">
                                            {{ $pd->product_name }} <br>
                                            <small> Size : {{ $pd->order_product_size }}</small> ,
                                            <small> Color : {{ $pd->order_product_color }}</small><br>
                                            <small> QTY : {{ $pd->order_product_quantity }}</small> ,
                                            <small> Price : {{ $pd->order_product_price }} BDT</small><br>
                                            <small> Product Code : {{ $pd->product_code }} </small>
                                        </div>
                                        <div class="col-md-4">

                                            <small><strong>Order Date : </strong><br>{{$order->created_at}}</small><br>
                                            <small><strong>Delevery Date (Approx) : </strong><br>{{$order->updated_at}}
                                            <small><strong>Delevered At : </strong><br>{{$order->delevered_at}}</small>
                                        </div>
                                    </div>
                                    <hr>
                                    @endforeach
                                      </form>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            <a data-toggle="modal" data-target="#example-{{ $order->id }}" data-backdrop="static" data-keyboard="false" class="text-white mr-1 btn btn-sm btn-outline-primary" style="font-size:12px;text-decoration:none">Details</a><br><br>

                            {{-- @if ($category->category_status=='Enable')
                            <a  href="{{ route('category_status_update',['Disable',$category->id]) }}" class="text-warning mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-window-close"></i>
                            @else
                            <a href="{{ route('category_status_update',['Enable',$category->id]) }}" class="text-success mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-check-square"></i>
                            @endif
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('category_delete',$category->id) }}" class="text-danger mr-1" style="font-size:18px;text-decoration:none"><i class="fa fa-trash-o"></i> </a> --}}
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
      showSwal('success-message','Category Successfully Added');
    }
  </script>
  @elseif(Session::get('success_updated'))
  <script >
    window.onload=function(){
      showSwal('success-message','Order Status Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','category Successfully Removed');
    }
  </script>
  @endif
@endsection
