<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {

        return view('exampleHosted');
    }

    public function index(Request $data)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        if($data->payment==2){
            $d1 = date('Y-m-d', strtotime("+7 days"));
            $points = 0 ;
            $remaining = 0 ;
            $tp = 0;
            $pnt_use = 0;
            if($data->my_points!=NULL){
                if($data->my_points>$data->total_payment){
                    $remaining = $data->my_points-$data->total_payment;
                    $pnt_use = $data->total_payment;
                    $tp = 60 ;
                }else{
                    $pnt_use = $data->my_points;
                    $tp = ($data->total_payment-$data->my_points)+60;
                }
            }
            DB::table('customer_orders')->insert([
                'customer_id' => Session::get('LoggedUser')->id,
                'customer_name' => $data->customer_name,
                'customer_email' => $data->customer_email,
                'customer_phone' => $data->customer_phone,
                'customer_address1' => $data->customer_division.",".$data->customer_district.",".$data->customer_thana,
                'customer_address2' => $data->customer_address,
                'total_price' => $tp,
                'point_use' => $pnt_use,
                'payment_method' => $data->payment,
                'payment_status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' =>$d1,
            ]);
            $last_id = DB::getPdo()->lastInsertId();
            $carts = DB::table('cart')->join('products','cart.cart_product_id','products.id')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->select('products.*','cart.id as cart_id','cart.cart_product_color','cart.cart_product_size','cart.cart_product_quantity')->get();
            foreach($carts as $cart){
                if($cart->product_discount>0){
                    $price = $cart->product_discount_price;
                }else{
                    $price = $cart->product_price;
                }
                DB::table('order_products')->insert([
                    'order_id' => $last_id,
                    'order_product_id' => $cart->id,
                    'order_product_quantity' => $cart->cart_product_quantity,
                    'order_product_price' => $price,
                    'order_product_size' => $cart->cart_product_size,
                    'order_product_color' => $cart->cart_product_color,
                    'created_at' => Carbon::now(),
                ]);
                $prod = DB::table('products')->where('id',$cart->id)->first();
                DB::table('products')->where('id',$cart->id)->update([
                    'product_quantity' => $prod->product_quantity-$cart->cart_product_quantity,
                ]);
            }
            DB::table('visitors')->where('id',Session::get('LoggedUser')->id)->update([
                'visitor_points' => $remaining,
            ]);
            DB::table('cart')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->delete();
            return redirect('/orders')->with('success_order',1);

        }else{
            $points = 0 ;
            $remaining = 0 ;
            $tp = 0;
            $pnt_use = 0;
            if($data->my_points!=NULL){
                if($data->my_points>$data->total_payment){
                    $remaining = $data->my_points-$data->total_payment;
                    $pnt_use = $data->total_payment;
                    $tp = 60 ;
                }else{
                    $pnt_use = $data->my_points;
                    $tp = ($data->total_payment-$data->my_points)+60;
                }
            }
            $post_data = array();
            $post_data['total_amount'] = $tp; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid(); // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_id'] = Session::get('LoggedUser')->id;
            $post_data['cus_name'] = Session::get('LoggedUser')->visitor_name;
            $post_data['cus_email'] = $data->customer_email;
            $post_data['cus_add1'] = $data->customer_division.",".$data->customer_district.",".$data->customer_thana;
            $post_data['cus_add2'] = $data->customer_address;
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $data->customer_phone;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            #Before  going to initiate the payment order status need to insert or update as Pending.
            $update_product = DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'cus_id' => $post_data['cus_id'],
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'pnt' => $pnt_use,
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'address2' => $post_data['cus_add2'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency']
                ]);

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                    $d1 = date('Y-m-d', strtotime("+7 days"));
                    DB::table('customer_orders')->insert([
                        'customer_id' => $order_detials->cus_id,
                        'customer_name' => $order_detials->name,
                        'customer_email' => $order_detials->email,
                        'customer_phone' => $order_detials->phone,
                        'customer_address1' => $order_detials->address,
                        'customer_address2' => $order_detials->address2,
                        'total_price' => $order_detials->amount,
                        'point_use' => $order_detials->pnt,
                        'payment_method' => 1,
                        'payment_status' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => $d1,
                    ]);
                    $last_id = DB::getPdo()->lastInsertId();
                    $carts = DB::table('cart')->join('products','cart.cart_product_id','products.id')->where('cart_status',0)->where('visitor_id',$order_detials->cus_id)->select('products.*','cart.id as cart_id','cart.cart_product_color','cart.cart_product_size','cart.cart_product_quantity')->get();
            foreach($carts as $cart){
                if($cart->product_discount>0){
                    $price = $cart->product_discount_price;
                }else{
                    $price = $cart->product_price;
                }
                DB::table('order_products')->insert([
                    'order_id' => $last_id,
                    'order_product_id' => $cart->id,
                    'order_product_quantity' => $cart->cart_product_quantity,
                    'order_product_price' => $price,
                    'order_product_size' => $cart->cart_product_size,
                    'order_product_color' => $cart->cart_product_color,
                    'created_at' => Carbon::now(),
                ]);
                $vis = DB::table('visitors')->where('id',Session::get('LoggedUser')->id)->first();
                DB::table('visitors')->where('id',Session::get('LoggedUser')->id)->update([
                    'visitor_points' => $vis->visitor_points-$order_detials->pnt,
                ]);
                $prod = DB::table('products')->where('id',$cart->id)->first();
                DB::table('products')->where('id',$cart->id)->update([
                    'product_quantity' => $prod->product_quantity-$cart->cart_product_quantity,
                ]);
            }
            DB::table('cart')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->delete();
            return redirect('/orders')->with('success_order',1);
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            DB::table('cart')->where('cart_status',0)->where('visitor_id',Session::get('LoggedUser')->id)->delete();
            return redirect('/')->with('success_order',1);
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
