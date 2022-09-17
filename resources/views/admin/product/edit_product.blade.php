@extends('layouts.app')
@section('title')
Edit Product
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">

      <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card" style="box-shadow: 0px 0px 10px black">
          <div class="card-body">
            <h4 class="card-title text-center">Update Product</h4>
            <p class="mx-auto" style="font-weight:1000">{{ $product->product_name }}</p>
            <img src="{{ asset($product->product_image) }}" alt="" style="height:150px;width:150px;">
            <form class="forms-sample mt-4" method="POST" action="{{ route('update_product') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Select Category</strong></label>
                        <select class="form-control border-danger" name="category_id" required>
                            <option value="">Select Category</option>
                            @php
                                $cats = DB::table('categories')->where('category_status','Enable')->where('category_delete',1)->get();
                            @endphp
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}" @if ($product->category_id==$cat->id) Selected @endif>{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Select Sub Category</strong></label>
                        <select class="form-control border-danger" name="sub_category_id" id="sub_category_id" required>
                            <option value="{{ $product->sub_category_id }}" selected >{{ $product->sub_category_name }}</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><strong>Product Name</strong></label>
                        <input type="text" class="form-control border-danger" name="product_name" value="{{ $product->product_name }}" required>
                        <input type="hidden" class="form-control border-danger" name="product_id" value="{{ $product->id }}" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product_code</strong></label>
                        <input type="text" class="form-control border-danger" name="product_code" value="{{ $product->product_code }}" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleInputPassword1"><strong>Product Brand</strong></label>
                          <input type="text" class="form-control border-danger" name="product_brand" value="{{ $product->product_brand }}" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product Color</strong></label>
                        <input type="text" class="form-control border-danger" name="product_color" value="{{ $product->product_color }}" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product Size</strong></label>
                        <select class="form-control border-danger" name="product_size[]" multiple required>
                            @php
                                $size = explode(',',$product->product_size)
                            @endphp
                            <option value="No" @if(in_array('No',$size))selected @endif>No Need</option>
                            <option value="S" @if(in_array('S',$size))selected @endif>S</option>
                            <option value="M" @if(in_array('M',$size))selected @endif>M</option>
                            <option value="L" @if(in_array('L',$size))selected @endif>L</option>
                            <option value="XL" @if(in_array('XL',$size))selected @endif>XL</option>
                            <option value="XXL" @if(in_array('XXL',$size))selected @endif>XXL</option>
                            <option value="3XL" @if(in_array('3XL',$size))selected @endif>3XL</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Price</strong></label>
                        <input type="text" class="form-control border-danger" name="product_price" value="{{ $product->product_price }}" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Quantity</strong></label>
                        <input type="text" class="form-control border-danger" name="product_quantity" value="{{ $product->product_quantity }}" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Discount(%)</strong></label>
                        <input type="number" class="form-control border-danger" min="0" max="100" name="product_discount" value="{{ $product->product_discount }}" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleInputPassword1"><strong>Product Details</strong></label>
                        <textarea class="form-control border-danger" rows="4" name="product_details" id="summernoteExample" required>{!! $product->product_details !!}</textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product Image</strong></label>
                        <input type="file" class="form-control border-danger" name="product_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Image Preview</strong></label><br>
                        <img id="blah" alt="Image" style="height: 150px ; width:150px;">
                      </div>
                </div>

                <button type="submit" class="btn btn-success mr-2 form-control">Update</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <script>
    $(document).ready(function(){
        $('select[name="category_id"]').on('change',function(){
            var category_id=$(this).val();
            if(category_id){
                $.ajax({
                    url:"{{ url('/get/sub_category/') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $("#sub_category_id").empty();
                        $.each(data,function(key,value){
                            $("#sub_category_id").append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');
                        });
                    },
                })
            }else{
                $("#sub_category_id").empty();
            }
        })
    })
  </script>
  @if (Session::get('success_insert'))
  <script >
    window.onload=function(){
      showSwal('success-message','Product Successfully Added');
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
      showSwal('success-message','User Successfully Removed');
    }
  </script>
  @endif
@endsection
