@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-10 table-responsive mb-5 mx-auto">
            <table class="table table-bordered border-dark mb-0">
                <thead class="bg-secondary text-dark">
                    <tr class="bg-info">
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Order Details</th>
                        <th class="text-center">Order Costs</th>
                        <th class="text-center">Order Status</th>
                    </tr>
                    @foreach ($orders as $order)
                    <tr>
                        <td style="text-align:center">{{$order->id+100}}</td>
                        <td>
                            <strong>Name :</strong><br>{{$order->customer_name}} <br>
                            <strong>Email :</strong><br>{{$order->customer_email}} <br>
                            <strong>Phone :</strong><br>{{$order->customer_phone}} <br>
                            <strong>Address :</strong><br>{{$order->customer_address1}} <br>{{$order->customer_address2}}
                        </td>
                        <td class="text-center">
                            {{$order->total_price}} BDT <br>
                            @if($order->point_use>0)
                            <small><strong>Point Use : </strong>{{$order->point_use}}</small>
                            @endif

                        </td>
                        <!-- Modal -->
<div class="modal fade" id="example{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Order Id#{{ $order->id+100 }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @php
                $pds = DB::table('order_products')->join('products','order_products.order_product_id','products.id')->where('order_id',$order->id)->select('order_products.*','products.product_name','products.product_image')->get();
            @endphp
            @foreach ($pds as $pd)
            <div class="row">
                <div class="col-md-4 text-center"><img src="{{ asset($pd->product_image) }}" alt="" style="height:50px"></div>
                <div class="col-md-4">
                    {{ $pd->product_name }} <br>
                    <small> Size : {{ $pd->order_product_size }}</small> ,
                    <small> Color : {{ $pd->order_product_color }}</small><br>
                    <small> QTY : {{ $pd->order_product_quantity }}</small> ,
                    <small> Price : {{ $pd->order_product_price }} BDT</small>
                </div>
                <div class="col-md-4">
                    <small><strong>Order Date : </strong><br>{{$order->created_at}}</small><br>
                    <small><strong>Delevery Date (Approx) : </strong><br>{{$order->updated_at}}</small><br>
                    @if ($order->order_status=='Delevered')
                    <small><strong>Delevered At : </strong><br>{{$order->delevered_at}}</small>
                    @endif
                </div>
            </div>
            <hr>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
                        <td style="text-align:center">
                            {{$order->order_status}} <br>
                            <a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#example{{$order->id}}">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </thead>
                <tbody >
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- Cart End -->
@endsection
