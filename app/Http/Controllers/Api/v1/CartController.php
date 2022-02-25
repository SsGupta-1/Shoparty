<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Hash;
use Session;
use Helper;
use Config;
use Image;
use Auth;
use App\Models\User;
use App\Models\UserCard;
use App\Models\UserAddress;
use App\Models\Country;
use App\Models\CustomizedOrder;
use App\Models\ShoppingCart;
use App\Models\UserWishlist;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDetail;

class CartController extends Controller
{
    /*********Save customized Product  to Bag**********/
    public function saveCustomizedProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'   => 'sometimes|nullable|min:1|max:70',
            'product_id'  =>'required|integer',
            'add_image' => 'sometimes|nullable',
            'background_image'=>'sometimes|nullable',
            'font_name_id' => 'sometimes|nullable|integer',
            'font_color_id' => 'sometimes|nullable|integer',
            'font_size_id' => 'sometimes|nullable|integer',
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
                    'status' => 0,
                    'message' => 'Validation Error',
                    'result' =>$result
                ],
                200
            );
        }
        try
        {
            $data['user_id']                               =auth('api')->user()->id;
            $data['name']                                  =strip_tags(trim($request->name));
            $data['product_detail_id']                     =strip_tags(trim($request->product_id));


            if(!empty($request->font_name_id))
            {
               $data['font_name_id']                        = strip_tags(trim($request->font_name_id));
 
            }

            if(!empty($request->font_color_id))
            {
               $data['font_color_id']                        = strip_tags(trim($request->font_color_id));
 
            }

            if(!empty($request->font_size_id))
            {
               $data['font_size_id']                          = strip_tags(trim($request->font_size_id));
 
            }
           
            // for upload image
            if($request->hasFile('add_image'))
            {
                $image_tmp =$request->file('add_image');
                if($image_tmp->isValid())
                {
                    $extension =$image_tmp->getClientOriginalExtension();
                    $filename  =rand(111,99999).'.'.$extension;
                    $image_path = 'uploads/customized/'.$filename;
                    //store images in images folder
                    Image::make($image_tmp)->save($image_path); 

                    $data['add_image']     =$filename;
                }
            }
            
            // upload background image

            if($request->hasFile('background_image'))
            {
                $back_image_tmp =$request->file('background_image');
                if($back_image_tmp->isValid())
                {
                    $back_extension =$back_image_tmp->getClientOriginalExtension();
                    $back_filename  =rand(111,99999).'.'.$back_extension;
                    $back_image_path = 'uploads/customized/'.$back_filename;
                    //store images in images folder
                    Image::make($back_image_tmp)->save($back_image_path); 

                    $data['background_image']     =$back_filename;
                }
            }
           
            if(!empty($data['user_id']))
            {
                $product_details=ProductDetail::where('id',$data['product_detail_id'])->first();
                $data['product_id']=$product_details->product_id;
                $custom=CustomizedOrder::create($data);

                // Add this product into shopping cart too
                $shopping               = new ShoppingCart;
                $shopping->customized_id =$custom->id;
                $shopping->user_id      = $data['user_id'];
                $shopping->quantity     = '1';
                $shopping->save();

       

                return response()->json(['result' => $result,'message'=>"Product saved into bag  Successfully",'response_code' => 200], 200);   
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }

        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /************Add to wishlist*******************/
    public function addToWishList(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'  =>'required|integer',
            'type'=>'required|integer'

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
                    'status' => 0,
                    'message' => 'Validation Error',
                    'result' =>$result
                ],
                200
            );
        }
        try
        {
            $data['user_id']                         =auth('api')->user()->id;
            $data['product_id']                      = strip_tags(trim($request->product_id));
            $data['status']                          ='1';

            $product_details=ProductDetail::where('id',$data['product_id'])->first();
            if(!empty($data['user_id']))
            {
                $count = UserWishlist::where(['user_id'=>$data['user_id'],'product_detail_id'=>$data['product_id']])->count();
                if($count > 0)
                {
                    if($request->type == '0')
                    {
                         UserWishlist::where(['user_id'=>$data['user_id'],'product_detail_id'=>$data['product_id']])->delete();
                          return response()->json(['message'=>"Product is remove from  your  Wishlist",'response_code' => 200], 200);

                    }
                }
                $data['product_id']=$product_details->product_id;
                UserWishlist::create($data);
                return response()->json(['message'=>"Product is add to your  Wishlist",'response_code' => 200], 200);   
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /************My WishList*********************/
    public function MyWishList(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
            'language_id'  =>'required|integer',

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
                        'status' => 0,
                        'message' => 'Validation Error',
                        'result' =>$result
                    ],
                    200
                );
            }
            $user_id                        =auth('api')->user()->id;
            $language                       =$request->language_id;
            if(!empty($user_id))
            {
                $list = UserWishlist::where(['user_id'=>$user_id,'status'=>'1'])->get();
                $response=[];

                foreach($list as $row)
                {
                    $product_details=Product::where('id',$row->product_id)->first();
                    if(!empty($product_details))
                    {
                        $product_info=ProductDetail::where(['product_id'=>$row->product_id,'id'=>$row->product_detail_id])->first();
                        $result['id']=(string)$row->product_detail_id;

                        if($language =='1')
                        {
                            $result['product_name']=$product_details->en_name;

                        }
                        else
                        {
                            $result['product_name']=$product_details->ar_name;

                        }



                        $product_image  = ProductImage::where(['product_id'=>$row->product_id,'product_detail_id'=>$row->product_detail_id])->first();
                        if(!empty($product_image))
                        {
                             $result['product_image']=asset('assets/img/products/'.$product_image->name);
                        }
                        else
                        {
                             $result['product_image']=asset('assets/sidebg.jpg');

                        }
                        $result['sale_price']=$product_details->sale_price;
                        $result['cost_price']=$product_details->cost_price;
                        $result['discount']='';
                        $count =ShoppingCart::where(['user_id'=>$user_id,'product_detail_id'=>$row->product_detail_id])->count();
                        if($count > 0)
                        {
                            $result['cart_status']='1';



                        }
                        else
                        {
                            $result['cart_status']='0';

                        }
                        $response[]=$result;
                        
                    }

                }

                if(count($response) > 0)
                {
                    return response()->json(['result' => $response,'message'=>"Wish list fetch Successfully",'response_code' => 200], 200);

                }
                else
                {
                    return response()->json(['result' => $response,'message'=>"No products in your Wishlist",'response_code' => 204], 200);

                }           
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /*********************Add to Bag **********/
    public function addToBag(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'  =>'required|integer',

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
                    'status' => 0,
                    'message' => 'Validation Error',
                    'result' =>$result
                ],
                200
            );
        }
        try
        {
            $data['user_id']                         =auth('api')->user()->id;
            $data['product_id']                      = strip_tags(trim($request->product_id));
            $data['status']                          ='1';


         
            if(!empty($data['user_id']))
            {
                $count = ShoppingCart::where(['user_id'=>$data['user_id'],'product_detail_id'=>$data['product_id']])->count();
                if($count > 0)
                {
                    return response()->json(['message'=>"This Product is already in your  Shopping Bag",'response_code' => 200], 200); 
                }
                $shop= new ShoppingCart;
                $shop->user_id=$data['user_id'];
                $shop->product_detail_id=$data['product_id'];
                $shop->quantity='1';
                $shop->status ='1';
                $shop->save();
                return response()->json(['message'=>"Product is add to your  Shopping Bag",'response_code' => 200], 200);   
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /****************Listing of Shopping carts******/
    public function ShoppingList(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
            'language_id'  =>'required|integer',

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
                        'status' => 0,
                        'message' => 'Validation Error',
                        'result' =>$result
                    ],
                    200
                );
            }
            $user_id                        =auth('api')->user()->id;
            $language                       =$request->language_id;
            if(!empty($user_id))
            {
                $list = ShoppingCart::where(['user_id'=>$user_id,'status'=>'1'])->get();
                $response=[];

                foreach($list as $row)
                {
                    $result['shopping_id']=(string)$row->id;

                    if(!empty($row->product_detail_id))
                    {
                        $product_details=ProductDetail::where('id',$row->product_detail_id)->first();

                        $product_info=Product::where('id',$product_details->product_id)->first();
                        if(!empty($product_info))
                        {
                            if($language == '1')
                            {
                              $result['shopping_name']=$product_info->en_name;

                            }
                            else
                            {
                              $result['shopping_name']=$product_info->ar_name;

                            }


                            $product_image  = ProductImage::where(['product_id'=>$product_info->id,'product_detail_id'=>$row->product_detail_id])->first();
                            if(!empty($product_image))
                            {
                                 $result['shopping_image']=asset('assets/img/products/'.$product_image->name);
                            }
                            else
                            {
                                 $result['shopping_image']=asset('assets/sidebg.jpg');

                            }
                            $result['cost_price']=$product_info->cost_price;
                        }

                    }

                    if(!empty($row->customized_id))
                    {
                        $customized_details = CustomizedOrder::where('id',$row->customized_id)->first();
                        $product_info=Product::where('id',$customized_details->product_id)->first();
                        $result['shopping_name']=$customized_details->name;
                        if(empty($customized_details->add_image) && empty($customized_details->background_image))
                        {
                             $product_image  = ProductImage::where(['product_id'=>$customized_details->product_id,'product_detail_id'=>$customized_details->product_detail_id])->first();
                            if(!empty($product_image))
                            {
                                 $result['shopping_image']=asset('assets/img/products/'.$product_image->name);
                            }
                            else
                            {
                                 $result['shopping_image']=asset('assets/sidebg.jpg');

                            }

                        }
                        else
                        {
                            if(empty($customized_details->add_image))
                            {
                                $result['shopping_image']=asset('uploads/customized/'.$customized_details->add_image);

                            }
                            else
                            {
                                $result['shopping_image']=asset('uploads/customized/'.$customized_details->background_image);


                            }
                        }
                        $result['cost_price']=$product_info->cost_price;
                    }
                    $result['shopping_qnty']=$row->quantity;
                    $result['shopping_price']=$row->price;
                    $response[]=$result;

                }

                if(count($response) > 0)
                {
                    return response()->json(['result' => $response,'message'=>"Shopping list fetch Successfully",'response_code' => 200], 200);

                }
                else
                {
                    return response()->json(['result' => $response,'message'=>"No products in your Shopping List",'response_code' => 204], 200);

                }           
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /**************Delete Cart Product****************/
    public function deleteCartProduct(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'shopping_id'  =>'required|integer',

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
                    'status' => 0,
                    'message' => 'Validation Error',
                    'result' =>$result
                ],
                200
            );
        }
        try
        {
            $user_id                        =auth('api')->user()->id;
            if(!empty($user_id))
            {
                $detail = ShoppingCart::where(['user_id'=>$user_id,'id'=>$request->shopping_id]);
                $count  =$detail->count();

                if(($count) > 0)
                {
                    $detail->delete();
                    return response()->json(['message'=>"This product is remove from your bag",'response_code' => 200], 200);

                }
                else
                {
                    return response()->json(['message'=>"This product is no more ",'response_code' => 204], 200);

                }           
            }
            else
            {
                return response()->json(['message' => 'User does not Authenticate','status' => 0,'response_code' => 500],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
}
