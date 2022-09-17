@extends('main_layouts.app')
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset($product->product_image)}}" alt="Image">
                    </div>
                    {{-- <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                    </div> --}}
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <span style="font-size: 10px">{{ $product->category_name }}</span>
            <h3 class="font-weight-semi-bold">{{ $product->product_name }}</h3>
            {{-- <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Reviews)</small>
            </div> --}}
            @if ($product->product_discount>0)
            <h4 class="font-weight-semi-bold my-3 "><span class="text-primary"> {{$product->product_discount_price}} BDT </span> <del> {{$product->product_price}} BDT</del></h4>
            @else
            <h4 class="font-weight-semi-bold my-3">{{$product->product_price}} BDT</h4>
            @endif
            <p class="mb-4">
                <ul>
                    <li>14 days easy return</li>
                    <li>100 % authentic product</li>
                    <li><strong class="text-info"> Stock Availability :</strong> @if ($product->product_quantity>0)
                        <span class="text-success">In Stock</span> @else <span class="text-danger"> Out Of Stock</span>
                    @endif</li>
                </ul>
            </p>
            <div class="d-flex mb-3">

                <form action="{{ route('add_cart') }}" method="POST">
                    @csrf
                    @if ($product->product_size!='No')
                    <span class="text-dark font-weight-medium my-2 mr-3">Sizes : </span>
                    @php
                        $af_explode = explode(',',$product->product_size);
                        $i = 0;
                    @endphp
                    @foreach ($af_explode as $size)
                    @php
                        $i++;
                    @endphp
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-{{$i}}" name="product_size" value="{{ $size }}" @if($i==1) checked @endif>
                        <label class="custom-control-label" for="size-{{$i}}">{{$size}}</label>
                    </div>
                    @endforeach <br><br>
                    @endif
                    <span class="text-dark font-weight-medium my-2 mr-3">Color : </span>
                    @php
                        $af_explode = explode(',',$product->product_color);
                        $i = 0;
                    @endphp
                    @foreach ($af_explode as $color)
                    @php
                        $i++;
                    @endphp

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-{{$i}}" name="product_color" value="{{ $color }}" min="1" @if($i==1) checked @endif>
                        <label class="custom-control-label" for="color-{{$i}}">{{$color}}</label>
                    </div>
                    @endforeach <br><br>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center" value="1" name="product_quantity" required>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="#">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                {{-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> --}}
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    {!! $product->product_details !!}
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Additional Information</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <strong>Product Category : </strong> {{ $product->category_name }}
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Product Sub Category : </strong> {{ $product->sub_category_name }}
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Brand Name : </strong> {{ $product->product_brand }}
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Product Discount : </strong> {{ $product->product_discount." %" }}
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Product Quantity : </strong> {{ $product->product_quantity}}
                        </li>

                    </ul>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                            <div class="media mb-4">
                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
