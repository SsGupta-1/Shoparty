<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\ProductDetail;
use Validator;
use Carbon\Carbon;
use Hash;
use Session;
use Helper;
use Config;
use Image;

class OrderController extends Controller
{
    /**************list of orders***********/
    public function myOrders(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [

                'language_id' =>'required',
                
            ]);
          

            if ($validator->fails())
            {
                $errors = $validator->errors()->getMessages();
                $transformed = [];
                foreach ($errors as $field => $messages) {
                     $transformed[$field] = $messages[0];
                }
                $result['data']=$transformed;
                return response()->json(
                [
                    'response_code' => 400,
                    'message' => 'Validation Error',
                    'result'  =>$result
                    ],
                    200
                );
            }
           
            $user_id = auth('api')->user()->id;
            $language=$request->language_id;
            if($user_id)
            {
                $details = User::where('id',$user_id)->with('myOrders')->first();
                $response=[];
                foreach($details['myOrders'] as $row)
                {
                    $result['order_id']= $row->id;

                    if($language =='1')
                    {
                        if($row->action_status == '4')
                        {
                           $result['order_title']='Delivered';


                        }
                        elseif($row->action_status =='5')
                        {
                           $result['order_title']='Cancelled';


                        }
                        else
                        {
                          $result['order_title']='Ongoing';
                        }

                    }
                    else
                    {
                        if($row->action_status == '4')
                        {
                           $result['order_title']='Delivered';


                        }
                        elseif($row->action_status =='5')
                        {
                           $result['order_title']='Cancelled';


                        }
                        else
                        {
                          $result['order_title']='Ongoing';
                        }
                    }

                    
                    $order_details = Order::where('id',$row->id)->with('listOrderDetails')->first();
                    $order_details = $order_details->listOrderDetails;
                    $order_name_array=[];
                    $product_image_array=[];
                    foreach($order_details as $order_row)
                    {
                        $products=Product::where('id',$order_row->product_id)->first();
                        if(!empty($products))
                        {
                            $product_details=ProductDetail::where('id','product_detail_id')->first();
                            $product_image  =ProductImage::where(['product_id'=>$order_row->product_id,'product_detail_id'=>$order_row->product_detail_id])->first();

                            if($language == '1')
                            {
                                $product_name=$products->en_name;

                            }
                            else
                            {
                                $product_name=$products->ar_name;

                            }

                            array_push($order_name_array,$product_name);
                            if(!empty($product_image))
                            {
                                array_push($product_image_array,$product_image);

                            }
                        }
                        

                    }
                    $result['order_name']= implode(' + ',$order_name_array);
                    if(count($product_image_array) > 0)
                    {
                        $result['order_image']=asset('assets/img/products/'.$product_image_array[0]);

                    }
                    else
                    {
                      $result['order_image']=asset('assets/sidebg.jpg');

                    }

                    $result['order_date']=date('M d',strtotime($row->action_date));
                    $response[] = $result;
                }
                return response()->json(
                [
                    'response_code' => 200,
                    'message' => 'list of Orders fetch Successfully',
                    'result'  =>$response
                    ],
                    200
                );

            }
            else
            {
                return response()->json(
                [
                    'response_code' =>401,
                    'message' => 'User does not Authenticate',
                    ],
                    200
                );

            }            
        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /******************cancel Order***********/

    public function cancelOrder(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [

                'order_id'           =>'required',
                'cancellation_reason'=>'required'
                
            ]);
          

            if ($validator->fails())
            {
                $errors = $validator->errors()->getMessages();
                $transformed = [];
                foreach ($errors as $field => $messages) {
                     $transformed[$field] = $messages[0];
                }
                $result['data']=$transformed;
                return response()->json(
                [
                    'response_code' => 400,
                    'message' => 'Validation Error',
                    'result'  =>$result
                    ],
                    200
                );
            }

            $user_id  = auth('api')->user()->id;
            $order_id = $request->order_id;
            $order    = Order::where(['user_id'=>$user_id,'id'=>$order_id]);
            $count    = $order->count();

            if(!empty($user_id))
            {
                if($count > 0)
                {
                    $details = $order->first();
                    if($details->action_status == 2 || $details->action_status == 3 || $details->action_status == 4)
                    {
                        return response()->json(['message'=>'This order cannot cancelled','response_code'=>204],200);
                    }

                    $order->update(['action_status'=>5,'cancellation_reason'=>$request->cancellation_reason]);
                    return response()->json(['message'=>'This order is cancelled Successfully','response_code'=>200],200);
                }
                else
                {
                    return response()->json(['message'=>'This order is not exst ','response_code'=>204],200);

                }

            }
            else
            {
                return response()->json(
                [
                    'response_code' =>401,
                    'message' => 'User does not Authenticate',
                    ],
                    200
                );

            }
               

        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /**************Order Details****************/

    public function orderDetails(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'order_id'           => 'required|integer',
                'language_id'        => 'required'
                
            ]);
          

            if ($validator->fails())
            {
                $errors = $validator->errors()->getMessages();
                $transformed = [];
                foreach ($errors as $field => $messages) {
                     $transformed[$field] = $messages[0];
                }
                $result['data']=$transformed;
                return response()->json(
                [
                    'response_code' => 400,
                    'message' => 'Validation Error',
                    'result'  =>$result
                    ],
                    200
                );
            }

            $user_id=auth('api')->user()->id;

            $order_id = $request->order_id;
            $language =$request->language_id;
            $order    = Order::where(['user_id'=>$user_id,'id'=>$order_id]);
            $count    = $order->count();

            if($count > 0)
            {   
                $details = $order->first();
                $order_details = Order::where('id',$order_id)->with('listOrderDetails')->first();
                $product_response =[];
                foreach($order_details->listOrderDetails as $row)
                {
                    $product_result['id']   = (string)$row->product_detail_id;

                    $product_result['product_id']   = (string)$row->product_id;


                    $product_details                = Product::where('id',$row->product_id)->first();
                    $product_image                  = ProductImage::where(['product_id'=>$row->product_id,'product_detail_id'=>$row->product_detail_id])->first();
                    if(!empty($product_image))
                    {
                        $product_result['product_image']=asset('assets/img/products/'.$product_image->name);
                    }
                    else
                    {
                        $product_result['product_image']=asset('assets/sidebg.jpg');

                    }

                    if($language =='1')
                    {
                        $product_result['product_name'] = $product_details->en_name;

                    }
                    else
                    {
                        $product_result['product_name'] = $product_details->ar_name;

                    }
                   
                    $product_result['product_qnty'] = (string)$row->quantity;
                    $product_result['product_price']= (string)$row->price;
                    $product_response[]             = $product_result;                   
                }
                $data['product_response'] = $product_response;
                $data['order_id']         = $details->order_number;
                $data['total_qnty']       = (string)count($order_details->listOrderDetails);

                if($row->action_status == '4')
                {
                   $data['order_title']='Order Details';


                }
                elseif($row->action_status =='5')
                {
                   $data['order_title']='Cancelled';


                }
                else
                {
                  $data['order_title']='Ongoing';
                }

                $data['action_status']    =(string)$details->action_status;

                $data['total_amount']     =$details->total_amount;
                $data['tax']              =$details->tax;
                $data['amount_to_paid']   =$details->amount_to_paid;

                return response()->json(['result'=>$data,'message'=>'Order details fetch Successfully','response_code'=>200],200);

                
            }
            else
            {
                return response()->json(['message'=>'This order is not exst ','response_code'=>204],200);

            }

        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }


}
