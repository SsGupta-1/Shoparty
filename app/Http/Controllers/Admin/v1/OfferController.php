<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Offer_map_product;
use App\Models\OffersProduct;
use Toastr;
use Config;
use Validator;

class OfferController extends Controller
{
    public function index(){

        // $result = Offer_map_product::select('offer_map_products.id','offers.*', 'products.en_name')
        //       ->join('offers', 'offers.id', '=', 'offer_map_products.offer_id')
        //       ->join('products', 'products.id', '=', 'offer_map_products.product_id')
        //       ->where('offer_map_products.deleted_at',NULL)
        //        ->groupBy('offer_map_products.offer_id')
        //     //->distinct()
        //       ->get();
    //dd($result );
     $result = Offer::all();
        return view('admin.offer.index',compact('result'));
    }

    public function addoffer(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $offer = new Offer;
            $offer->offer_code = $data['offer_code'];
            $offer->discount_percent = $data['offer_discount'];
            $offer->discount_amount = $data['discount_amount'];
            $offer->save();
            $lastId = $offer->id;
            //$getProduct = $data['product'];
            foreach($data['product'] as $values){
                $getProduct[] = [
                    'offer_id' => $lastId,
                    'product_id' => $values,

                ];
            }
            Offer_map_product::insert($getProduct);
            Toastr::success('Offer add Successfully', 'Success', ['timeOut' => 5000]);
            return back();
        }
        $product = Product::all();
        return view('admin.offer.add',compact('product'));
    }

    // public function addoffer(Request $request){
    //     if($request->isMethod('post')){
                
               
    //             $getProduct = [];
    //             $data = $request->all();
    //             $offer = new OffersProduct;   
    //             //$getProduct = $data['product'];
    //             foreach($data['product'] as $values){
    //                 $getProduct[] = $values;                 
    //             }
    //             $offer->product = implode(',' ,$getProduct);
    //             $offer->offer_code = $data['offer_code'];
    //             $offer->discount_percent = $data['offer_discount'];
    //             $offer->discount_amount = $data['discount_amount'];
    //             $offer->save();
    //             Toastr::success('Offer add Successfully', 'Success', ['timeOut' => 5000]);
    //             return redirect()->back();
            
    //     }
    //     $product = Product::all();
    //     return view('admin.offer.add',compact('product'));
    // }


    public function editoffer(Request $request, $id){

        if($request->isMethod('post')){
   
            $getProduct = [];
            $data = $request->all();
            $offer = Offer::FindorFail($id);   
         //    dd($offer->offer_code == $data['offer_code'] || $offer->discount_percent == $data['offer_discount'] ||$offer->discount_percent == $data['offer_discount']);
            $offer->offer_code = $data['offer_code'];
            $offer->discount_percent = $data['offer_discount'];
            $offer->discount_amount = $data['discount_amount'];
            $offer->save();
            foreach($data['product'] as $values){
                $getProduct[]=[
                    'offer_id' => $id,
                    'product_id' => $values, 
                ];  
                              
            }
            $saveData = Offer_map_product::where('offer_map_products.offer_id',$id)
                                           ->forcedelete();
             Offer_map_product::insert($getProduct);
          
            Toastr::success('Offer Update Successfully', 'Success', ['timeOut' => 5000]);
            return back();
            
        }
           $productlist = Product::pluck('en_name','id');
             
            $offer_id = $id;
           
           $product = Offer::select('offers.*','offer_map_products.*')
                             ->join('offer_map_products','offer_map_products.offer_id','=','offers.id')
                             ->where('offers.id',$id)
                             ->where('offer_map_products.deleted_at',NULL)
                             ->get(); 
                            
        return view('admin.offer.edit',compact('product','productlist','offer_id'));
    }

    public function deleteoffer(Request $request , $id){
        
       $deleteProduct = Offer_map_product::where('offer_id', $id)->first();
       $deleteProduct->status = Config::get('constants.status.Deleted');
       if($deleteProduct->save()){
        $deleteProduct->delete();
       }
       $deleteoffer = Offer::where('id', $id)->first();
       $deleteoffer->status = Config::get('constants.status.Deleted');
       if($deleteoffer->save()){
        $deleteoffer->delete();
       }
      
        Toastr::success('Offer deleted Successfully', 'Success', ['timeOut' => 5000]);
        return back();
    }
}
