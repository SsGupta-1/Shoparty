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
use App\Models\Store;
use App\Models\User;
use App\Models\UserCard;
use App\Models\UserAddress;
use App\Models\Country;
use App\Models\Voucher;
use App\Models\DeliveryPincode;
use App\Models\StaticPage;
use App\Models\Color;
use App\Models\FontName;
use App\Models\FontSize;
use App\Models\Age;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Season;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\UserWishlist;
class PartialController extends Controller
{
    /*********************List Countries **********/
    public function listCountries(Request $request)
    {
        try
        {
            $list = Country::get();
            $response=[];
            foreach($list as $row)
            {
                $result['country_id'] = $row->id;
                $result['country_name'] = $row->country_name;
                $result['phone_code'] = $row->phone_code;
                $result['country_code'] = $row->country_code;
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of countries fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No countries found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /*****************list Vouchers ************/

    public function listVouchers(Request $request)
    {
        try
        {
            $list = Voucher::where('status',1)
                        ->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now())
                        ->get();

            $response=[];
            foreach($list as $row)
            {
                $result['voucher_id']    = $row->id;
                $result['min_purchase']  = $row->min_purchase;
                $result['discount']      = $row->discount;
                $result['coupon_code']   = $row->coupon_code;
                $result['start_date']    = $row->start_date;
                $result['end_date']      = $row->end_date;
                $response[]              = $result;
            }
            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Vouchers fetch Successfully','response_code'=>200],200);

            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Vouchers found','response_code'=>204],200);
            }
        }

        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /*******************Static Pages **************/

    public function staticPages(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type'   => 'required',
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
            $type = $request->type;
            $response=[];

            if ($type == 1 || $type == 4) {
                $list = StaticPage::where(['type' => $type, 'status' => Config::get('constants.status.Active')])->get();
            } else {
                $list = array();
            }

            if(count($list)){
                foreach($list as $row)
                {
                    $result['static_id']   = $row->id;
                    $result['title']       = $row->title;
                    $result['description'] = $row->description;
                    $response[]            = $result;
                }
            }

            if(count($response))
            {
                return response()->json(['result'=>$response,'message'=>'Success','response_code'=>200],200);
            } else {
                return response()->json(['result'=>$response,'message'=>'No content','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /********************Pin Code Check***************/

    public function pinCodeCheck(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pincode'   => 'required',
                 
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
            $count =DeliveryPincode::where('pincode',$request->pincode)->count();
            if($count > 0)
            {
                return response()->json(['message'=>'Delivery facility is available','response_code'=>200],200);

            }
            else
            {
                return response()->json(['message'=>'Delivery facility is not  available','response_code'=>204],200);

            }

        }
        catch (Exception $e)
        {
          return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /****************list of colors *************/
    public function listColors(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = Color::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']        = (string)$row->id;

                if($language =='1')
                {
                  $result['color_name']= $row->color_name;

                }
                else
                {
                  $result['color_name']= $row->ar_color_name;

                }

                $result['color_code']= $row->color_code;
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of colors fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No colors found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /***************lits of font Names*********/
    public function listFontNames(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = FontName::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']           = (string)$row->id;

                if($language =='1')
                {
                   $result['font_name']    = $row->font_name;

                }
                else
                {
                   $result['font_name']    = $row->ar_font_name;

                }
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Font Name fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Fonts found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /*******************list of font Sizes******/
    public function listFontSizes(Request $request)
    {
        try
        {
            $list = FontSize::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id'] = (string)$row->id;
                
                $result['font_size']= $row->font_size;

                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Font sizes fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Font Size found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /*******************list of Ages******/
    public function listAges(Request $request)
    {
        try
        {
            $list = Age::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id'] = (string)$row->id;
                $result['age_name']= $row->name;
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Ages fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Age data found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /*************list of Categories******/
    public function listCategories(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = Category::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']               = (string)$row->id;
                if($language == '1')
                {
                   $result['category_name']= $row->category_name;

                }
                else
                {
                   $result['category_name']= $row->ar_category_name;

                }
                $result['category_image']   = $row->category_image?asset('assets/img/categories/'.$row->category_image):'';
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of categories fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No categories found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /*****************List of Seasons*********/
    public function listSeasons(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = Season::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']        = (string)$row->id;
                if($language == '1')
                {
                   $result['season_name']= $row->name;

                }
                else
                {
                   $result['season_name']= $row->ar_name;

                }
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of Seasons fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Seasons found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /******************List of Theames************/
    public function listTheames(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = Theme::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']        = (string)$row->id;
                if($language == '1')
                {
                    $result['theme_name']= $row->name;

                }
                else
                {
                    $result['theme_name']= $row->ar_name;

                }
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of theames fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No theames found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }

    /******************List of Brands************/
    public function listBrands(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(),[
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
            $language=$request->language_id;
            $list = Brand::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']        = (string)$row->id;
                if($language == '1')
                {
                  $result['brand_name']= $row->name;

                }
                else
                {
                    $result['brand_name']= $row->ar_name;

                }
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of brands fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No brand found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }    
    }
    /*************Home Screen**************/
    public function HomeScreen(Request $request)
    {
        $validator = Validator::make($request->all(),[
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
            // $language = 1 for english and 2 for arabic 
            $user_id=auth('api')->user();

            $top_banner=[];
            $bottom_banner=[];
            $upcoming_banner=[];
            $banner_list=Banner::get();
            foreach($banner_list as $banner_row)
            {
                if($banner_row->type =='1')
                {
                    $top_result['id']=(string)$banner_row->id;
                    $top_result['image']=asset('assets/img/banners/'.$banner_row->banner_image);
                    $top_banner[]=$top_result;

                }
                elseif($banner_row->type =='2')
                {
                    $bottom_result['id']=(string)$banner_row->id;
                    $bottom_result['image']=asset('assets/img/banners/'.$banner_row->banner_image);
                    $bottom_banner[]=$bottom_result;

                }
                else
                {
                    $upcoming_result['id']=(string)$banner_row->id;
                    $upcoming_result['image']=asset('assets/img/banners/'.$banner_row->banner_image);
                    $upcoming_banner[]=$upcoming_result;

                }
            }
            $data['top_banner']=$top_banner;
            $data['bottom_banner']=$bottom_banner;
            $data['upcoming_banner']=$upcoming_banner;

            $category_list = Category::get();
            $category_response=[];
            foreach($category_list as $category_row)
            {
                $category_result['category_id']      = (string)$category_row->id;
                if($language =='1')
                {
                  $category_result['category_name']    = $category_row->category_name;

                }
                else
                {
                  $category_result['category_name']    = $category_row->ar_category_name;

                }
                $category_result['category_image']   = $category_row->category_image?asset('assets/img/categories/'.$category_row->category_image):'';
                $category_response[] = $category_result;
            }

            $season_list = Season::get();
            $season_response=[];
            foreach($season_list as $season_row)
            {
                $season_result['season_id']  = (string)$season_row->id;
                if($language =='1')
                {
                  $season_result['season_name']= $season_row->name;

                }
                else
                {
                  $season_result['season_name']= $season_row->ar_name;


                }
                $season_result['season_image']=$season_row->image?asset('assets/img/seasons/'.$season_row->image):'';
                $season_response[] = $season_result;
            }

            $theme_list = Theme::get();
            $theme_response=[];
            foreach($theme_list as $theme_row)
            {
                $theme_result['theme_id']        = (string)$theme_row->id;
                if($language =='1')
                {
                  $theme_result['theame_name']= $theme_row->name;

                }
                else
                {
                  $theme_result['theame_name']= $theme_row->ar_name;


                }
                $theme_result['theame_image']=$theme_row->image?asset('assets/img/theames/'.$theme_row->image):'';
                $theme_response[] = $theme_result;
            }
            $data['category_response']=$category_response;
            $data['season_response']=$season_response;
            $data['theame_response']=$theme_response;

            $new_arrival_list=  Product::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->take(4)->get();
            $new_arrival_response=[];
            foreach($new_arrival_list as $new_row)
            {
                $new_result['arrival_id']=(string)$new_row->id;
                if($language == '1')
                {
                    $new_result['arrival_name']=$new_row->name;
                    $new_result['arrival_description']=$new_row->description;


                }
                else
                {
                    $new_result['arrival_name']=$new_row->ar_name;
                    $new_result['arrival_description']=$new_row->ar_description;


                }
                $new_result['price']=$new_row->price;
                $product_image=ProductImage::where('product_id',$new_row->id)->first();
                if(!empty($product_image))
                {
                $new_result['arrival_image']=asset('assets/img/products/'.$product_image->image);

                }
                else
                {
                    $new_result['arrival_image']=asset('assets/sidebg.jpg');
                }
                $new_arrival_response[]=$new_result;
            }
            $data['arrival_response']=$new_arrival_response;

            $brand_list=Brand::get();
            $brand_response=[];
            foreach($brand_list as $brand_row)
            {
                $brand_result['brand_id']=(string)$brand_row->id;
                if($language =='1')
                {
                  $brand_result['brand_name']=$brand_row->name;

                }
                else
                {
                  $brand_result['brand_name']=$brand_row->ar_name;


                }
                $brand_result['brand_image']=$brand_row->image?asset('assets/img/brands/'.$brand_row->image):'';
                $brand_response[]=$brand_result;
            }
            $data['brand_response']=$brand_response;
           
            return response()->json(['result'=>$data,'message'=>'Home list fetch Successfully','response_code'=>200],200);     
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }
    }
    /****************list of branches********/
    public function ListBranches(Request $request)
    {
        $validator = Validator::make($request->all(),[
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
            $list = Store::get();
            $response=[];
            foreach($list as $row)
            {
                $result['id']           = (string)$row->id;
                if($language =='1')
                {
                     $result['store_name']   = $row->en_store_name;
                     $result['store_address']= $row->en_store_address;

                }
                else
                {
                     $result['store_name']   = $row->ar_store_name;
                     $result['store_address']= $row->ar_store_address;
                }

               
                $response[] = $result;
            }

            if(count($list) > 0)
            {
                return response()->json(['result'=>$response,'message'=>'List of stores fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['result'=>$response,'message'=>'No Stores found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }  
    }
    /************Side Bar Categories**********/
    public function sideBarCategories(Request $request)
    {
         $validator = Validator::make($request->all(),[
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
            $list = Category::get();
            $side_response=[];
            foreach($list as $row)
            {
                if(empty($row->parent_category_id))
                {
                    $result['product_category_id']=(string)$row->id;
                    if($language == '1')
                    {
                        $result['product_category_name']=$row->category_name;

                    }
                    else
                    {
                      $result['product_category_name']=$row->ar_category_name;
                    }
                    $parent_response=[];
                    $parent_data =Category::where('parent_category_id',$row->id)->get();
                    foreach($parent_data as $parent_row)
                    {
                        $parent_result['parent_id']=(string)$parent_row->id;
                        if($language == '1')
                        {
                            $parent_result['parent_category_name']=$row->category_name;

                        }
                        else
                        {
                            $parent_result['parent_category_name']=$row->ar_category_name;
                        }

                        $child_data =Category::where('parent_category_id',$parent_row->id)->get();
                        $child_response=[];
                        foreach($child_data as $child_row)
                        {
                            $child_result['child_id']=(string)$child_row->id;
                             if($language == '1')
                            {
                                $child_result['child_category_name']=$child_row->category_name;

                            }
                            else
                            {
                                $child_result['child_category_name']=$child_row->ar_category_name;
                            }
                            // $child_result['child_category_image']=$child_row->category_image?asset('assets/img/categories/'.$child_row->category_image):'';
                            $child_response[]=$child_result;

                        }
                        $parent_result['child_category']=$child_response;
                        $parent_response[]=$parent_result;
                    }
                    $result['parent_category']=$parent_response;
                    $side_response[]=$result;
                }             
            }

            if(count($side_response) > 0)
            {
                return response()->json(['product_cat_result'=>$side_response,'message'=>'List of categories fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['product_cat_result'=>$side_response,'message'=>'No categories found','response_code'=>204],200);
            }
        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        }  
    }
    /*************list of deals****************/
    public function listDeals(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offset'=>'required',
            'limit'=>'required',
            'language_id'=> 'required',
            'user_id'=>'sometimes|nullable'
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
            $user_id=$request->user_id;
            $response=[];
            $list=ProductDetail::whereDate('created_at', '=', date('Y-m-d'))->offset($offset)->limit($limit)->get();

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
    /************list of CategoryProducts*******/
    public function listCategoriesProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offset'=>'required',
            'limit'=>'required',
            'language_id'=> 'required',
            'user_id'=>'sometimes|nullable',
            'category_id'=>'required'
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
            $category =$request->category_id;
            $user_id=$request->user_id;
            $response=[];
            $list=ProductDetail::whereDate('status','1')->offset($offset)->limit($limit)->get();

            foreach($list as $row)
            {
                $product_details=Product::where(['category_id'=>$category_id,'id'=>$row->product_id])->first();
                if(!empty($product_details))
                {
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
    /************Home Search*******************/
    public function HomeScreenSearch(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offset'=>'required',
            'limit'=>'required',
            'language_id'=> 'required',
            'user_id'=>'sometimes|nullable',
            'search_data'=>'sometimes|nullable'
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
            $offset=$request->offset;
            $limit=$request->limit;
            $language=$request->language_id;
            $search =$request->search_data;
            $user_id=$request->user_id;
            if($language == '1')
            {
                $list = Product::where('en_name','like','%'.$search.'%')->with('productDetails')->offset($offset)->limit($limit)->get();
            
            }
            else
            {
                 $list = Product::where('ar_name','like','%'.$search.'%')->with('productDetails')->offset($offset)->limit($limit)->get();

            }
            $response=[];
            foreach($list as $row)
            {
                foreach($row->productDetails as $detail_row)
                {
                    $product_details=Product::where('id',$detail_row->product_id)->first();
                    $result['id']=(string)$row->id;
                    if($language =='1')
                    {

                        $result['product_name']=$product_details->en_name;
                        $result['product_desc']=$detail_row->en_description;
                    }
                    else
                    {
                        $result['product_name']=$product_details->ar_name;
                        $result['product_desc']=$detail_row->ar_description;
                    }
                    $result['cost_price']=$product_details->cost_price;
                    $result['sale_price']=$product_details->sale_price;
                    $product_image=ProductImage::where(['product_id'=>$detail_row->product_id,'product_detail_id'=>$detail_row->id])->first();
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
                            $count = UserWishlist::where(['user_id'=>$user_id,'product_id'=>$detail_row->product_id,'product_detail_id'=>$detail_row->id])->count();
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
                return response()->json(['home_result'=>$response,'message'=>'Product fetch Successfully','response_code'=>200],200);
            }
            else
            {
                return response()->json(['home_result'=>[],'message'=>'No Product found','response_code'=>200],200);
            }
            
           

        }
        catch (Exception $e)
        {
            return \Response::json(['error'=> ['message'=>$e->getMessdob()]], HttpResponse::HTTP_CONFLICT)->setCallback(Input::get('callback'));
        } 
    }
}
