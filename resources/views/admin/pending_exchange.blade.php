@extends('layouts.app')
@section('title')
Exchange
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Exchange List</h4>

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table table-dark table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th class="text-center">Exchange ID</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exchanges as $exchange)
                    @php
                        $visitor = DB::table('visitors')->where('id',$exchange->exchanger_id)->first();
                    @endphp
                    <tr>
                        <td style="text-align:center">{{$exchange->exc_id+100}}</td>
                        <td>
                            <strong class="text-danger">Product Name :</strong><br>{{$exchange->exchange_product_name}} <br><br>
                            <strong class="text-danger">Details :</strong><br>{{$exchange->exchange_product_details}} <br><br>
                            <strong class="text-danger">Exchanger :</strong><br>{{$visitor->visitor_name}} <br><br>
                            <strong class="text-danger">Email :</strong><br>{{$visitor->visitor_email}} <br><br>
                            <strong class="text-danger">Phone :</strong><br>{{$visitor->visitor_phone}} <br><br>
                            <strong class="text-danger">Address :</strong><br>{{$visitor->visitor_address}} <br>
                        </td>
                        <td class="text-center">
                            <img src="{{ asset($exchange->exchange_product_image) }}" alt="" style="height:100px;width:100px">
                        </td>
                        <td>
                            <strong class="text-danger">Asking Price : </strong><br>
                            {{$exchange->exchange_product_asking_price}} BDT <br><br>
                            @if ($exchange->exchange_product_sell_price != NULL)
                            <strong class="text-danger">Sell Price : </strong><br>
                            {{$exchange->exchange_product_sell_price}} BDT <br><br>
                            <strong class="text-danger">Exchange Method : </strong><br>
                            {{$exchange->exchange_method}}<br><br>
                            <strong class="text-danger">Exchange Date : </strong><br>
                            {{$exchange->updated_at}}<br>
                            @endif

                        </td>
                        <td class="text-center">
                            {{$exchange->exchange_status}}
                        </td>
                        <td class="text-center">
                            <a onclick="return confirm('Are you sure want to accept ?')" href="{{ route('update_exchange_admin',[$exchange->exc_id,'Accepted']) }}" style="font-size: 11px;" class="btn btn-primary">Accept</a> <br><br>
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('delete_exchange_admin',$exchange->exc_id) }}" style="font-size: 11px;" class="btn btn-danger">Delete</a>
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
      showSwal('success-message','Request Successfully Updated');
    }
  </script>
  @elseif(Session::get('success_delete'))
  <script >
    window.onload=function(){
      showSwal('success-message','exchange Request Successfully Removed');
    }
  </script>
  @endif
@endsection
