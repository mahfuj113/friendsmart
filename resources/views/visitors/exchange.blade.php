@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-10 table-responsive mb-5 mx-auto">
            <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Exchange</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('exchange') }}" enctype="multipart/form-data">
                @csrf
                <div class="control-group">
                    <input type="text" class="form-control border-success" name="exchange_product_name" placeholder="Exchange Product Name" required="required">
                </div>
                <div class="control-group mt-2">
                    <textarea class="form-control border-success" rows="6"  name="exchange_product_details" placeholder="Exchange Product Details" required="required"></textarea>
                </div>
                <div class="control-group mt-2">
                    <input type="number" class="form-control border-success" name="exchange_product_asking_price" placeholder="Exchange Product Asking Price" min="1" required="required">
                </div>
                <div class="control-group mt-2">
                    <input type="file" class="form-control border-success"  name="exchange_product_image" placeholder="Exchange Product Image" required="required" >
                </div>
                <div>
                    <button class="btn btn-outline-success py-2 px-4 mt-4 float-right form-control" type="submit" >Exchange Request</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  @php
      $check = DB::table('exchanges')->where('exchanger_id',Session::get('LoggedUser')->id)->orderBy('exc_id','DESC')->first();
  @endphp
            @if ($check==NULL || $check->exchange_status=='Completed')
            <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#staticBackdrop">
                Exchange a Product
            </button>
            @endif

            @if (Session::get('success_request'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your exchange request has been placed !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::get('success_delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Your exchange request has been deleted !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <table class="table table-bordered border-dark mb-0">
                <thead class="bg-secondary text-dark">
                    <tr class="bg-info">
                        <th class="text-center">Exchange ID</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($exchanges as $exchange)
                    <tr>
                        <td style="text-align:center">{{$exchange->exc_id+100}}</td>
                        <td>
                            <strong>Product Name :</strong><br>{{$exchange->exchange_product_name}} <br>
                            <strong>Details :</strong><br>{{$exchange->exchange_product_details}} <br>
                        </td>
                        <td class="text-center">
                            <img src="{{ asset($exchange->exchange_product_image) }}" alt="" style="height:100px">
                        </td>
                        <td>
                            <strong>Asking Price : </strong><br>
                            {{$exchange->exchange_product_asking_price}} BDT <br>
                            @if ($exchange->exchange_product_sell_price != NULL)
                            <strong>Sell Price : </strong><br>
                            {{$exchange->exchange_product_asking_price}} BDT <br>
                            <strong>Exchange Method : </strong><br>
                            {{$exchange->exchange_method}}<br>
                            <strong>Exchange Date : </strong><br>
                            {{$exchange->updated_at}}<br>
                            @endif

                        </td>
                        <td class="text-center">
                            {{$exchange->exchange_status}}
                        </td>
                        <td class="text-center">
                            @if ($exchange->exchange_status=='Pending')
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('delete_exchange',$exchange->exc_id) }}" class="btn btn-sm btn-primary" style="font-size:11px">Delete</a>
                            @elseif($exchange->exchange_status=='Accepted')
                            <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('update_exchange',[$exchange->exc_id,'Cancel']) }}" class="btn btn-sm btn-danger" style="font-size:11px">Cancel</a>
                            @endif
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
