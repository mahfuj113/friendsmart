@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form action="{{ url('/pay') }}" method="POST">
        @csrf
    <div class="row px-xl-5">

        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Customer Name</label>
                        <input class="form-control border-primary" type="text" value="{{ Session::get('LoggedUser')->visitor_name }}" name="customer_name" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>E-mail</label>
                        <input class="form-control border-primary" type="text" value="{{ Session::get('LoggedUser')->visitor_email }}" name="customer_email" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Mobile No</label>
                        <input class="form-control border-primary" type="text" value="{{ Session::get('LoggedUser')->visitor_phone }}" name="customer_phone" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Division</label>
                        <input class="form-control border-primary" type="text" name="customer_division" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>District</label>
                        <input class="form-control border-primary" type="text" name="customer_district" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Thana / Sub-district</label>
                        <input class="form-control border-primary" type="text" name="customer_thana" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Address </label>
                        <textarea name="customer_address" class="form-control border-primary" required>{{Session::get('LoggedUser')->visitor_address}}</textarea>
                    </div>

                </div>
            </div>
            {{-- <div class="collapse mb-4" id="shipping-address">
                <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" placeholder="John">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" placeholder="Doe">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" placeholder="+123 456 789">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 2</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ZIP Code</label>
                        <input class="form-control" type="text" placeholder="123">
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($carts as $cart)

                    <div class="d-flex justify-content-between">
                        <p>{{$cart->product_name}}</p>
                        <p>
                            @if ($cart->product_discount>0)
                            @php
                                $total = $total+($cart->product_discount_price*$cart->cart_product_quantity);
                            @endphp
                            {{$cart->cart_product_quantity."x".$cart->product_discount_price." = ".$cart->cart_product_quantity*$cart->product_discount_price}} BDT
                            @else
                            @php
                                $total = $total+($cart->product_price*$cart->cart_product_quantity);
                            @endphp
                            {{$cart->cart_product_quantity."x".$cart->product_price." = ".$cart->cart_product_quantity*$cart->product_price}} BDT
                            @endif
                        </p>
                    </div>
                    @endforeach
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">{{$total }} BDT</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">60 BDT</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                        @if (Session::get('LoggedUser'))
                            @php
                               $point = DB::table('visitors')->where('id',Session::get('LoggedUser')->id)->first();
                            @endphp
                        @endif
                        @if ($point->visitor_points>0)
                        <input type="checkbox" value="{{ $point->visitor_points }}" name="my_points" id="my_points">&nbsp&nbsp Use Points
                        <span style="margin-left:170px">{{ $point->visitor_points }}</span>
                        @else
                        <input type="hidden" value="0" name="my_points">
                        @endif
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold" id="change">{{ $total+60 }} BDT</h5>
                        {{-- <script>
                            function let_total(){

                                var total = {{ $total }};
                                var point = {{$point->visitor_points}};
                                if(document.getElementById('my_points').value!=""){
                                    document.getElementById('change').innerHTML="";
                                    if(point>total){
                                    document.getElementById('change').innerHTML=60+" BDT";
                                    }else{
                                    document.getElementById('change').innerHTML=total-point+60+" BDT";
                                    }
                                }
                                if(document.getElementById('my_points').value==""){
                                    document.getElementById('change').innerHTML="";
                                    // document.getElementById('change').innerHTML=total+60+" BDT";
                                }


                            }
                        </script> --}}
                        <input type="hidden" name="total_payment" value="{{$total}}">
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                            <input type="radio" name="payment" value="1"  checked> Online Payment
                    </div>
                    <div class="form-group">
                            <input type="radio" name="payment" value="2" id="directcheck"> Cash On Delevery
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                </div>
            </div>
        </div>

    </div>
</form>
</div>
<!-- Checkout End -->
@endsection
