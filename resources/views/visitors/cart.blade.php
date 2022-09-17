@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<!-- Cart Start -->
@php
    $total = 0;
@endphp
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered  mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th class="text-center">Products</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($carts as $cart)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset($cart->product_image)}}" alt="" style="width: 50px;">
                                </div>
                                <div class="col-lg-6">
                                    {{ $cart->product_name }} <br>
                                    <small>Brand : {{ $cart->product_brand }}</small><br>
                                    <small>Color : {{ $cart->cart_product_color }}</small><br>
                                    <small>Size : {{ $cart->cart_product_size }}</small>
                                </div>
                            </div>
                        </td>
                        <td >
                            @if ($cart->product_discount>0)
                            <del class="text-primary">{{$cart->product_price}} BDT</del><br>
                            {{$cart->product_discount_price}} BDT
                            @else
                            {{$cart->product_price}} BDT
                            @endif
                        </td>
                        <td >
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" id="minus{{$cart->cart_id}}">
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{$cart->cart_product_quantity}}" id="product_quantity{{$cart->cart_id}}" min="1">

                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus"  id="plus{{$cart->cart_id}}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="cart_id{{$cart->cart_id}}" value="{{$cart->cart_id}}">
                            <script>
                                    $('#plus{{$cart->cart_id}}').on('click',function(){
                                        var cart_id=$('#cart_id{{$cart->cart_id}}').val();
                                            $.ajax({
                                                url:"{{ url('/update-cart/') }}/"+$('#cart_id{{$cart->cart_id}}').val(),
                                                type:"GET",
                                                dataType:"json",
                                                success:function(data){
                                                    location.reload();
                                                },
                                            })
                                    })


                              </script>
                              <script>
                                $('#minus{{$cart->cart_id}}').on('click',function(){
                                        var cart_id=$('#cart_id{{$cart->cart_id}}').val();
                                            $.ajax({
                                                url:"{{ url('/update-cart-minus/') }}/"+cart_id,
                                                type:"GET",
                                                dataType:"json",
                                                success:function(data){
                                                    location.reload();
                                                },
                                            })
                                    })
                              </script>
                        </td>
                        <td >
                            @if ($cart->product_discount>0)
                            <del class="text-primary">{{$cart->product_price*$cart->cart_product_quantity}} BDT</del><br>
                            {{$cart->product_discount_price*$cart->cart_product_quantity}} BDT
                            @php
                                $total = $total+($cart->product_discount_price*$cart->cart_product_quantity);
                            @endphp
                            @else
                            {{$cart->product_price*$cart->cart_product_quantity}} BDT
                            @php
                                $total = $total+($cart->product_price*$cart->cart_product_quantity);
                            @endphp
                            @endif
                        </td>
                        <td><a href="{{ route('delete_cart',$cart->cart_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            {{-- <form class="mb-5" action="#">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form> --}}
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">{{$total}} BDT</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">60 BDT</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">

                    
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">{{ $total+60 }} BDT</h5>
                    </div>
                    @if ($total+60>60)
                    <a href="{{ route('check_out') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
