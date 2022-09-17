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
                        <!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$exchange->exc_id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Exchange Id #{{$exchange->exc_id+100}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('accepted_exchange') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for=""><strong>Asking Price</strong></label>
                <input type="number" class="form-control border-info" value="{{ $exchange->exchange_product_asking_price }}" readonly name="asking_price" required>
            </div>
            <div class="form-group">
                <label for=""><strong>Sell Price</strong></label>
                <input type="number" class="form-control border-info" min="1" value="100" name="sell_price" required>
                <input type="hidden" class="form-control border-info" value="{{ $exchange->exc_id }}" name="exc_id" required>
                <input type="hidden" class="form-control border-info" value="{{ $exchange->exchanger_id }}" name="exchanger_id">
            </div>
            <div class="form-group">
                <label for=""><strong>Exchange Method</strong></label>
                <select class="form-control border-info" name="exchange_method" required>
                    <option value="Cash">Cash</option>
                    <option value="Point" selected>Point</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Complete Exchange</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#staticBackdrop{{$exchange->exc_id}}" style="font-size: 11px;" class="btn btn-primary">Exchange</a> <br><br>
                            <a onclick="return confirm('Are you sure want to cancel ?')" href="{{ route('update_exchange_admin1',[$exchange->exc_id,'Cancel']) }}" style="font-size: 11px;" class="btn btn-danger">Cancel</a>
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
