<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Processing(){
        $orders = DB::table('customer_orders')->where('order_status','Processing')->orderBy('id','DESC')->get();
        return view('admin.processing',compact('orders'));
    }
    public function UpdateStatus(Request $data){
        DB::table('customer_orders')->where('id',$data->id)->update([
            'order_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function OnTheWay(){
        $orders = DB::table('customer_orders')->where('order_status','On the way')->orderBy('id','DESC')->get();
        return view('admin.on_the_way',compact('orders'));
    }
    public function UpdateStatus2(Request $data){
        DB::table('customer_orders')->where('id',$data->id)->update([
            'order_status' => $data->status,
            'delevered_at' => date('Y-m-d'),
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function Delevered(){
        $orders = DB::table('customer_orders')->where('order_status','Delevered')->orderBy('id','DESC')->get();
        return view('admin.delevered',compact('orders'));
    }
    //exchange

    public function PendingExchange(){
        $exchanges = DB::table('exchanges')->where('exchange_status','Pending')->get();
        return view('admin.pending_exchange',compact('exchanges'));
    }
    public function ExchangeDelete(Request $data){
        DB::table('exchanges')->where('exc_id',$data->id)->delete();
        return redirect()->back()->with('success_delete',1);
    }
    public function ExchangeUpdate(Request $data){
        DB::table('exchanges')->where('exc_id',$data->id)->update([
            'exchange_status' => $data->status,
            'exchange_last_date' => date('Y-m-d', strtotime("+7 days")),
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function AcceptedExchange(){
        $exchanges = DB::table('exchanges')->where('exchange_status','Accepted')->get();
        return view('admin.accepted_exchange',compact('exchanges'));
    }
    public function AcceptedExchangeInsert(Request $data){
        DB::table('exchanges')->where('exc_id',$data->exc_id)->update([
            'exchange_product_sell_price' => $data->sell_price,
            'exchange_method' => $data->exchange_method,
            'exchange_status' => 'Completed',
            'updated_at' => Carbon::now()
        ]);

        if($data->exchange_method=='Point'){
            $check = DB::table('visitors')->where('id',$data->exchanger_id)->first();
            DB::table('visitors')->where('id',$data->exchanger_id)->update([
                'visitor_points' => $check->visitor_points+$data->sell_price,
            ]);
        }
        return redirect()->back()->with('success_updated',1);
    }
    public function ExchangeUpdate1(Request $data){
        DB::table('exchanges')->where('exc_id',$data->id)->update([
            'exchange_status' => $data->status,
        ]);
        return redirect()->back()->with('success_updated',1);
    }
    public function CompleteExchange(){
        $exchanges = DB::table('exchanges')->where('exchange_status','Completed')->get();
        return view('admin.completed_exchange',compact('exchanges'));
    }

}
