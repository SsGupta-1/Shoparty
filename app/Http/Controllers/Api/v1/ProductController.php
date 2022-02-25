<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\UserAddress;
use App\Models\ProductImage;
use App\Models\UserWishlist;
use App\Models\Color;
use App\Models\OrderDetail;
use Validator;
use Carbon\Carbon;
use Hash;
use Session;
use Helper;
use Config;
use Image;

class ProductController extends Controller
{
    /****************Product detail*********/
    public function productDetail(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'language_id'=>'required'
                
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

            $product_id = $request->product_id;
            $language   = $request->language_id;

            $product         = ProductDetail::where('id',$product_id);
            $count           = $product->count();
            if($count > 0)
            {
                $product_details=$product->first();

                $image_response=[];
                $images = ProductImage::where(['product_id'=>$product_details->product_id,'product_detail_id'=>$product_details->id])->get();

                if(count($images) > 0)
                {
                    foreach($images as $image_row)
                    {
                        $image_result['image_id']   =$image_row->id;
                        $image_result['image_name'] =$image_row->name ? url('/assets/img/products').'/'.$image_row->name : '';
                        $image_response[]           =$image_result;

                    }
                }
                else
                {
                    $image_result['image_id']='1';
                    $image_result['image_name']=asset('assets/sidebg.jpg');
                    $image_response[]           =$image_result;
                }

                $product_colors=ProductDetail::where('product_id',$product_details->product_id)->get();
                $color_response=[];
                foreach($product_colors as $color_row)
                {
                    $color_details = Color::where('id',$color_row->color_id)->first();
                    $color_result['color_id']  = $color_row->color_id;
                    $color_result['color_name']= $color_details->color_code;
                    $color_result['color_code']= $color_details->color_code;

                    if($color_row->color_id == $product_details->color_id)
                    {
                        $color_result['status']    = '1';

                    }
                    else
                    {
                        $color_result['status']    = '0';

                    }
                    
                    $color_response[]          = $color_result;
                }

                $product =Product::where('id',$product_details->product_id)->first();

                if($language == '1')
                {
                    $data['product_name']=$product->en_name;
                    $data['product_desc']=$product_details->en_description;

                }
                else
                {
                    $data['product_name']=$product->ar_name;
                    $data['product_desc']=$product_details->ar_description;

                }
                $data['cost_price']=$product->cost_price;
                $data['sale_price']=$product->sale_price;
                $data['image_response']=$image_response;
                $data['color_response']=$color_response;

                $count = UserWishlist::where(['product_id'=>$product_details->product_id,'product_detail_id'=>$product_id])->count();
                if($count > 0)
                {
                    $data['fav_status']='1';

                }
                else
                {
                    $data['fav_status']='0';
                }
                return response()->json(['result'=>$data,'message'=>'Product details fetch Successfully!','response_code'=>200],200);
            }
            else
            {
                return response()->json(['message'=>'Product does not exists','response_code'=>204],200);
            }

        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /**************List of Products**********/
    public function ProductList(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'filter_id' => 'required',
            'type'=>'required',
            'language_id'=>'required',
            'offset'=>'required',
            'limit'=>'required',
            'user_id'=>'sometimes|nullable'
                
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
        try
        {
            $filter_id = $request->filter_id;
            $type      = $request->type;
            $list      =Product::where('status','1');
            $user_id   =  $user_id   =$request->user_id;


            if($type == '1')
            {
                //List of categories
                $list =$list->where('category_id',$filter_id)->get();
            }
            elseif($type =='2')
            {
                //list of brands
                $list =$list->where('brand_id',$filter_id)->get();

            }
            else
            {
                $list =$list->where('theme_id',$filter_id)->get();
            }


            foreach($list as $row)
            {
                $response=[];
                $product_details=ProductDetail::where('product_id',$row->id)->get();
                foreach($product_details as $product_row)
                {
                    $result['product_id']  = (string)$product_row->id;
                    $result['cost_price']  = $row->cost_price;
                    $result['sale_price']  = $row->sale_price;

                    $product_image         =ProductImage::where(['product_id'=>$row->id,'product_detail_id'=>$product_row->id])->first();
                    if(!empty($product_image))
                    {
                        $result['product_image']=asset('assets/img/products/'.$product_image->name);

                    }
                    else
                    {
                        $result['product_image']=asset('assets/sidebg.jpg');
                    }

                    if($request->language_id == '1')
                    {
                        $result['product_name']=$row->en_name;
                        $result['product_descripion']=$product_row->en_description;

                    }
                    else
                    {
                        $result['product_name']=$row->ar_name;
                        $result['product_descripion']=$product_row->ar_description;

                    }

                    if(!empty($user_id))
                    {
                        $count = UserWishlist::where(['user_id'=>$user_id,'product_id'=>$row->id,'product_detail_id'=>$product_row->id])->count();
                        if($count > 0)
                        {
                            $result['fav_status']= '1';

                        }
                        else
                        {
                            $result['fav_status']= '0';

                        }
                    }
                    else
                    {
                        $result['fav_status']= '0';
       
                    }
                    $response[] = $result;
                }


            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of products fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>[],'message'=>'No products found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /****************Arrival and Top List*****/
    public function ArrivalAndTopList(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'type'=>'required',
            'offset'=>'required',
            'limit'=>'required',
            'language_id'=>'required',
            'user_id'=>'sometimes|nullable'
                
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
        try
        {
            $type=$request->type;
            $language=$request->language_id;
            $offset=$request->offset;
            $limit=$request->limit;
            $user_id   =$request->user_id;


            if($type == '1')
            {
                $product_detaills_array=array_unique(OrderDetail::where('status','1')->pluck('product_detail_id')->toArray());

                $list=ProductDetail::whereIn('id',$product_detaills_array)->offset($offset)->limit($limit)->get();


            }
            else
            {
                $dateS = Carbon::now()->startOfMonth()->subMonth(1);
                $dateE = Carbon::now();    
                $list  = ProductDetail::whereBetween('created_at',[$dateS,$dateE])->offset($offset)->limit($limit)->get();

            }

            $response=[];
            foreach($list as $row)
            {
                $result['id']=(string)$row->id;
                $product_details=Product::where('id',$row->product_id)->first();
                if($language =='1')
                {

                    $result['product_name']=$product_details->en_name;
                    $result['product_desc']=$row->en_description;


                }
                else
                {
                    $result['product_name']=$product_details->ar_name;
                    $result['product_desc']=$row->ar_description;



                }
                $result['cost_price']=$product_details->cost_price;
                $result['sale_price']=$product_details->sale_price;
                $product_image=ProductImage::where(['product_id'=>$row->product_id,'product_detail_id'=>$row->id])->first();
                if(!empty($product_image))
                {
                    $result['product_image']=asset('assets/img/products/'.$product_image->name);

                }
                else
                {
                    $result['product_image']=asset('assets/sidebg.jpg');
                }

                if(!empty($user_id))
                {
                        $count = UserWishlist::where(['user_id'=>$user_id,'product_id'=>$row->id,'product_detail_id'=>$product_row->id])->count();
                        if($count > 0)
                        {
                            $result['fav_status']= '1';

                        }
                        else
                        {
                            $result['fav_status']= '0';

                        }
                }
                else
                {
                    $result['fav_status']= '0';

                }

                $total=$product_details->cost_price;
                $upper_total=$product_details->cost_price-$product_details->sale_price;
                if($upper_total == '0' && $total == $product_details->cost_price)
                {
                    $result['discount']='';

                }
                else
                {
                    $result['discount']=$upper_total / $total * 100;
                }

                $response[]=$result;     
            }

            if(count($response) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Products fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>[],'message'=>'No products found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /*******************Offers and discounted Items********/
    public function OffersAndDiscountedItems(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offset'=>'required',
            'limit'=>'required',
            'language_id'   => 'required',
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors()->getMessages();
            $transformed = [];
            foreach ($errors as $field => $messages)
            {
                 $transformed[$field] = $messages[0];
            }
            $result['data']=$transformed;
             return response()->json(
            [
                'response_code' => 400,
                'message' => 'Validation Error',
                'result' =>$result
                ],
                200
            );
        }
        try
        {
            $language=$request->language_id;
            $offset  =$request->offset;
            $limit   =$request->limit;
            $user_id=auth('api')->user();
            $response=[];
            $list=ProductDetail::where('status','1')->get();

            foreach($list as $row)
            {
                $product_details=Product::where('id',$row->product_id)->first();
                $cp=$product_details->cost_price;
                $sp=$product_details->sale_price;
                if($sp < $cp)
                {

                    $result['id']=(string)$row->id;
                    $product_details=Product::where('id',$row->product_id)->first();
                    if($language =='1')
                    {

                        $result['product_name']=$product_details->en_name;
                        $result['product_desc']=$row->en_description;
                    }
                    else
                    {
                        $result['product_name']=$product_details->ar_name;
                        $result['product_desc']=$row->ar_description;
                    }
                    $result['cost_price']=$product_details->cost_price;
                    $result['sale_price']=$product_details->sale_price;
                    $product_image=ProductImage::where(['product_id'=>$row->product_id,'product_detail_id'=>$row->id])->first();
                    if(!empty($product_image))
                    {
                        $result['product_image']=asset('assets/img/products/'.$product_image->name);

                    }
                    else
                    {
                        $result['product_image']=asset('assets/sidebg.jpg');
                    }

                    if(!empty($user_id))
                    {
                            $count = UserWishlist::where(['user_id'=>$user_id->id,'product_id'=>$row->id,'product_detail_id'=>$product_row->id])->count();
                            if($count > 0)
                            {
                                $result['fav_status']= '1';

                            }
                            else
                            {
                                $result['fav_status']= '0';

                            }
                    }
                    else
                    {
                        $result['fav_status']= '0';

                    }

                    $total=$product_details->cost_price;
                    $upper_total=$product_details->cost_price-$product_details->sale_price;
                    if($upper_total == '0' && $total == $product_details->cost_price)
                    {
                        $result['discount']='';

                    }
                    else
                    {
                        $result['discount']=$upper_total / $total * 100;
                    }

                    $response[]=$result;     

                }      
            }

            if(count($response) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Products fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No products found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }  
    }
    /*******************checkCustomizedProduct**********/
    public function checkCustomizedProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'=>'required',
    
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors()->getMessages();
            $transformed = [];
            foreach ($errors as $field => $messages)
            {
                 $transformed[$field] = $messages[0];
            }
            $result['data']=$transformed;
             return response()->json(
            [
                'response_code' => 400,
                'message' => 'Validation Error',
                'result' =>$result
                ],
                200
            );
        }
        try
        {
               $language=$request->language_id;
           
                $product_details=ProductDetail::where('id',$request->product_id)->first();
                $count =Product::where(['id'=>$product_details->product_id,'is_customizable'=>'1'])->count();
                if($count > 0)
                {
                    return response()->json(['message'=>'Product is not customizableble','response_code'=>200],200);


                }
                else
                {
                    return response()->json(['message'=>'Product is not customizableble','response_code'=>400],200);

                }
        
            
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }  
    }
}
