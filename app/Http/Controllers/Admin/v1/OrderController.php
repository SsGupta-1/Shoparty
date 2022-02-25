<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\UserAddress;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $list = Order::get();

        if($list->count()){
            for ($i=0; $i < $list->count(); $i++) { 
                $list[$i]['order_status'] = OrderStatus::select('order_status')->where(['status' => Config::get('constants.status.Active'), 'order_id' => $list[$i]['id']])->first()['order_status'];
                
                $list[$i]['en_name'] = OrderDetail::select(DB::raw('GROUP_CONCAT(en_name) as product_name'))->leftjoin('products', 'products.id', '=', 'order_details.product_id')->where(['order_details.status' => Config::get('constants.status.Active'), 'order_id' => $list[$i]['id']])->first()['product_name'];

                $list[$i]['status_url'] = url('admin/order/status/'.$list[$i]['id']);
            }
        }

        view()->share('list',$list);

        return view('admin.orders.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $order_status = OrderStatus::where(['order_id' => $id, 'status' => Config::get('constants.status.Active')])->first();

        $order_status->status = Config::get('constants.status.Inactive');

        $order_status->save();

        $in['order_id'] = $id;
        $in['order_status'] = $request->status;
        $in['status_date'] = date('Y-m-d');

        OrderStatus::create($in);

        return TRUE;
    }

    public function view(Request $request, $id)
    {
        $detail = Order::select('orders.*', 'order_details.quantity', 'order_details.price', 'order_status.order_status', 'products.en_name', 'products.ar_name', 'user_addresses.first_name', 'user_addresses.last_name', 'user_addresses.city', 'user_addresses.street_no', 'user_addresses.building_no', 'user_addresses.mobile', 'countries.country_name', 'product_sizes.name as product_size')
            ->leftjoin('order_details', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('user_addresses', 'user_addresses.id', '=', 'orders.address_id')
            ->leftjoin('countries', 'countries.id', '=', 'user_addresses.country_id')
            ->leftjoin('order_status', 'order_status.order_id', '=', 'orders.id')
            ->leftjoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftjoin('product_details', 'products.id', '=', 'product_details.product_id')
            ->leftjoin('product_sizes', 'product_sizes.id', '=', 'product_details.product_size_id')
            ->where('order_status.status', Config::get('constants.status.Active'))
            ->where('orders.id', $id)
            ->get();

        if ($detail->count()) {
            $data['user'] = User::select('users.*', 'user_addresses.first_name', 'user_addresses.last_name', 'user_addresses.city', 'user_addresses.street_no', 'user_addresses.building_no', 'user_addresses.mobile', 'countries.country_name')->leftjoin('user_addresses', 'user_addresses.user_id', '=', 'users.id')->leftjoin('countries', 'countries.id', '=', 'user_addresses.country_id')->where('users.id', $detail[0]['user_id'])->get()->first();
            $data['detail'] = $detail;

            return view('admin.orders.view', $data);
        }else{
            Toastr::error("Order not found", 'Failed', ['timeOut' => 5000]);
            return redirect()->back();
        }

    }
}
