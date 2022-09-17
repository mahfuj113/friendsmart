<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddProduct(){
        return view('admin.product.add_product');
    }
    public function AddProductInsert(Request $data){
        $data->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_brand' => 'required',
            'product_color' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_discount' => 'required',
            'product_details' => 'required',
        ]);
        $sz=sizeof($data->product_size);
        $i =0;
        $r =NULL;
        foreach($data->product_size as $key){
            $r=$r.$key;
            if($i<$sz-1){
                $r = $r.",";
            }
            $i++;
        }
        $sub = DB::table('subcategories')->where('id',$data->sub_category_id)->first();
        $discount_price = 0;
        if($data->product_discount>0){
            $discount_price = ceil($data->product_price-(($data->product_price*$data->product_discount)/100));
        }
        $image = $data->product_image;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(500,500)->save('public/product_images/'.$post_image);
                    $product_image='public/product_images/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $product_image = NULL;
        }
        DB::table('products')->insert([
            'category_id' => $sub->category_id,
            'category_name' => $sub->category_name,
            'sub_category_id' => $sub->id,
            'sub_category_name' => $sub->sub_category_name,
            'product_code' => $data->product_code,
            'product_name' => $data->product_name,
            'product_brand' => $data->product_brand,
            'product_color' => $data->product_color,
            'product_size' => $r,
            'product_price' => $data->product_price,
            'product_quantity' => $data->product_quantity,
            'product_discount' => $data->product_discount,
            'product_discount_price' => $discount_price,
            'product_details' => $data->product_details,
            'product_image' => $product_image,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success_insert',1);
    }
    public function ViewProduct(){
        $products=DB::table('products')->where('product_delete',1)->get();
        return view('admin.product.view_product',compact('products'));
    }
    public function UpdateProductStatus(Request $data){
        DB::table('products')->where('id',$data->id)->update([
            'product_status' => $data->status
        ]);
        return redirect()->back()->with('success_updated',1);
    }

    public function DeleteProduct(Request $data){
        DB::table('products')->where('id',$data->id)->update([
            'product_delete' => 0
        ]);
        return redirect()->back()->with('success_delete',1);
    }
    public function EditProduct(Request $data){
        $product = DB::table('products')->where('id',$data->id)->first();
        return view('admin.product.edit_product',compact('product'));
    }
    public function UpdateProduct(Request $data){
        $data->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_brand' => 'required',
            'product_color' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_discount' => 'required',
            'product_details' => 'required',
        ]);
        $sz=sizeof($data->product_size);
        $i =0;
        $r =NULL;
        foreach($data->product_size as $key){
            $r=$r.$key;
            if($i<$sz-1){
                $r = $r.",";
            }
            $i++;
        }
        $sub = DB::table('subcategories')->where('id',$data->sub_category_id)->first();
        $discount_price = 0;
        if($data->product_discount>0){
            $discount_price = ceil($data->product_price-(($data->product_price*$data->product_discount)/100));
        }
        $pr = DB::table('products')->where('id',$data->product_id)->first();
        $image = $data->product_image;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(500,500)->save('public/product_images/'.$post_image);
                    $product_image='public/product_images/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $product_image = $pr->product_image;
        }
        DB::table('products')->where('id',$data->product_id)->update([
            'category_id' => $sub->category_id,
            'category_name' => $sub->category_name,
            'sub_category_id' => $sub->id,
            'sub_category_name' => $sub->sub_category_name,
            'product_code' => $data->product_code,
            'product_name' => $data->product_name,
            'product_brand' => $data->product_brand,
            'product_color' => $data->product_color,
            'product_size' => $r,
            'product_price' => $data->product_price,
            'product_quantity' => $data->product_quantity,
            'product_discount' => $data->product_discount,
            'product_discount_price' => $discount_price,
            'product_details' => $data->product_details,
            'product_image' => $product_image,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success_updated',1);
    }
}
