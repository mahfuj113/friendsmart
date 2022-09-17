<?php

namespace App\Http\Controllers\visitors;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class VisitorController extends Controller
{
    public function VisitorRegister(){
        return view('visitors.visitor_register');
    }
    public function VisitorInsert(Request $data){
        $data->validate([
            'visitor_name' => 'required',
            'visitor_gender' => 'required',
            'visitor_email' => 'email|required|unique:visitors,visitor_email',
            'visitor_phone' => 'min:11|max:14|required|unique:visitors,visitor_email',
            'visitor_address' => 'required',
            'visitor_password' => 'required'
        ]);
        DB::table('visitors')->insert([
            'visitor_name' => $data->visitor_name,
            'visitor_gender' => $data->visitor_gender,
            'visitor_email' => $data->visitor_email,
            'visitor_phone' => $data->visitor_phone,
            'visitor_address' => $data->visitor_address,
            'visitor_password' => md5($data->visitor_password),
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success_insert',1);
    }
    public function VisitorLogin(){
        return view('visitors.visitor_login');
    }
    public function LogIn(Request $data){
        $check_email=DB::table('visitors')->where('visitor_email',$data->visitor_email)->first();
        if($check_email){
            $check = DB::table('visitors')->where('visitor_email',$data->visitor_email)->where('visitor_password',md5($data->visitor_password))->first();
            if($check){
                session()->put('LoggedUser', $check);
                return redirect('/');
            }else{
                return redirect()->back()->with('err_password',1)->withInput($data->all());
            }
        }else{
            return redirect()->back()->with('err_email',1)->withInput($data->all());
        }
    }

    public function Logout(){
        Session::flash('LoggedUser');
        return redirect()->route('visitor_register');
    }
    public function ProductDetails(Request $data){
        $product = DB::table('products')->where('id',$data->product_id)->first();
        return view('visitors.product_details',compact('product'));
    }
    public function CategoryProducts(Request $data){
        $products = DB::table('products')->where('category_id',$data->category_id)->get();
        return view('visitors.category_product',compact('products'));
    }
    public function SubcategoryProducts(Request $data){
        $products = DB::table('products')->where('category_id',$data->category_id)->where('sub_category_id',$data->sub_category_id)->get();
        return view('visitors.sub_category_product',compact('products'));
    }
    public function AddCart(Request $data){
        $check = DB::table('cart')->where('visitor_id',Session::get('LoggedUser')->id)->where('cart_product_id',$data->product_id)->where('cart_status',0)->first();
        $cart = array();
        $prod = DB::table('products')->where('id',$data->product_id)->first();

        $color = explode(',',$prod->product_color);
        $size = explode(',',$prod->product_size);

        if($check){
            $cart['cart_product_quantity'] = $check->cart_product_quantity + 1;
            DB::table('cart')->where('id',$check->id)->update($cart);
        }else{
            $cart['cart_product_id'] = $data->product_id;
            $cart['cart_product_color'] = $color[0];
            $cart['cart_product_size'] = $size[0];
            $cart['created_at'] = Carbon::now();
            $cart['cart_product_quantity'] = 1;
            $cart['visitor_id'] = Session::get('LoggedUser')->id;
            DB::table('cart')->insert($cart);
        }
        return redirect()->back();
    }
    public function Cart(){
        $carts = DB::table('cart')->join('products','cart.cart_product_id','products.id')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->select('products.*','cart.id as cart_id','cart.cart_product_color','cart.cart_product_size','cart.cart_product_quantity')->get();
        if($carts->count()>0){
            return view('visitors.cart',compact('carts'));
        }else{
            return redirect('/')->with('empty_cart',1);
        }

    }
    public function AddCartInsert(Request $data){

        $check = DB::table('cart')->where('cart_product_id',$data->product_id)->where('cart_product_color',$data->product_color)->where('cart_product_size',$data->product_size)->where('visitor_id',Session::get('LoggedUser')->id)->where('cart_status',0)->first();
        if($check){
            DB::table('cart')->where('id',$check->id)->update([
                'cart_product_quantity' => $data->product_quantity+$check->cart_product_quantity,
            ]);
            return redirect()->back();
        }else{
            $cart =array();
            $cart['cart_product_id'] = $data->product_id;
            $cart['cart_product_color'] = $data->product_color;
            $cart['cart_product_size'] = $data->product_size;
            $cart['created_at'] = Carbon::now();
            $cart['cart_product_quantity'] = $data->product_quantity;
            $cart['visitor_id'] = Session::get('LoggedUser')->id;
            DB::table('cart')->insert($cart);
            return redirect()->back();
        }
    }
    public function DeleteCart(Request $data){
        DB::table('cart')->where('id',$data->id)->delete();
        return redirect()->back();
    }
    public function UpdateCart(Request $data){
        $check = DB::table('cart')->where('id',$data->cart_id)->first();
        if($check){
            $quantity = $check->cart_product_quantity+1;
            DB::table('cart')->where('id',$data->cart_id)->update([
                'cart_product_quantity' => $quantity,
            ]);
            $cart = DB::table('cart')->where('id',$data->cart_id)->first();
            $c_q = $cart->cart_product_quantity;
            return response()->json($c_q);
        }
    }
    public function UpdateCartMinus(Request $data){
        $check = DB::table('cart')->where('id',$data->cart_id)->first();
        if($check){
            $quantity = $check->cart_product_quantity-1;
            DB::table('cart')->where('id',$data->cart_id)->update([
                'cart_product_quantity' => $quantity,
            ]);
            $cart = DB::table('cart')->where('id',$data->cart_id)->first();
            $c_q = $cart->cart_product_quantity;
            return response()->json($c_q);
        }
    }
    public function CheckOut(){
        $carts = DB::table('cart')->join('products','cart.cart_product_id','products.id')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->select('products.*','cart.id as cart_id','cart.cart_product_color','cart.cart_product_size','cart.cart_product_quantity')->get();
        return view('visitors.checkout',compact('carts'));
    }
    public function Orders(){
        $orders = DB::table('customer_orders')->where('customer_id',Session::get('LoggedUser')->id)->orderBy('id','DESC')->get();
        return view('visitors.orders',compact('orders'));
    }
    public function Exchange(){
        $exchanges = DB::table('exchanges')->where('exchanger_id',Session::get('LoggedUser')->id)->get();
        return view('visitors.exchange',compact('exchanges'));
    }
    public function ExchangeInsert(Request $data){
        $image = $data->exchange_product_image;

        if($image){
            $file = Image::make($image);
            $size = $file->filesize();
            $image_ext = $image->getClientOriginalExtension();
            $format = array('jpg','jpeg','png');
            if(in_array($image_ext,$format)){
                if($size<20097152){
                    $post_image = time().".".$image_ext;
                    Image::make($image)->resize(500,500)->save('public/exchange_images/'.$post_image);
                    $exchange_image='public/exchange_images/'.$post_image;
                }else{
                    return redirect()->back()->with('err_file_format','1');
                }
            }else{
                return redirect()->back()->with('err_file_size','1');
            }

        }else{
            $exchange_image = NULL;
        }

        DB::table('exchanges')->insert([
            'exchanger_id' => Session::get('LoggedUser')->id,
            'exchange_product_name' => $data->exchange_product_name,
            'exchange_product_details' => $data->exchange_product_details,
            'exchange_product_image' => $exchange_image,
            'exchange_product_asking_price' => $data->exchange_product_asking_price,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success_request',1);
    }
    public function ExchangeDelete(Request $data){
        DB::table('exchanges')->where('exc_id',$data->id)->delete();
        return redirect()->back()->with('success_delete',1);
    }
    public function ExchangeUpdate(Request $data){
        DB::table('exchanges')->where('exc_id',$data->id)->update([
            'exchange_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }
}
