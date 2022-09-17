@extends('layouts.app')
@section('title')
Add Product
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">

      <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card" style="box-shadow: 0px 0px 10px black">
          <div class="card-body">
            <h4 class="card-title text-center">Add New Product</h4>

            <form class="forms-sample" method="POST" action="{{ route('add_product') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Select Category</strong></label>
                        <select class="form-control border-danger" name="category_id" required>
                            <option value="" selected disabled>Select Category</option>
                            @php
                                $cats = DB::table('categories')->where('category_status','Enable')->where('category_delete',1)->get();
                            @endphp
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Select Sub Category</strong></label>
                        <select class="form-control border-danger" name="sub_category_id" id="sub_category_id" required>
                            <option value="" selected disabled>Select Sub Category</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><strong>Product Name</strong></label>
                        <input type="text" class="form-control border-danger" name="product_name" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product_code</strong></label>
                        <input type="text" class="form-control border-danger" name="product_code">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleInputPassword1"><strong>Product Brand</strong></label>
                          <input type="text" class="form-control border-danger" name="product_brand">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product Color</strong></label>
                        <input type="text" class="form-control border-danger" name="product_color">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1"><strong>Product Size</strong></label>
                        <select class="form-control border-danger" name="product_size[]" multiple>
                            <option value="No" selected>No Need</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="3XL">3XL</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Price</strong></label>
                        <input type="text" class="form-control border-danger" name="product_price">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Quantity</strong></label>
                        <input type="text" class="form-control border-danger" name="product_quantity">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputPassword1"><strong>Product Discount(%)</strong></label>
                        <input type="number" class="form-control border-danger" min="0" max="100" value="0" name="product_discount">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleInputPassword1"><strong>Product Details</strong></label>
                        <textarea class="form-control border-danger" rows="4" name="product_details" id="summernoteExample"></textarea>
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

                <button type="submit" class="btn btn-success mr-2 form-control">ADD</button>
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
      showSwal('success-message','My Profile Info Successfully Updated');
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
