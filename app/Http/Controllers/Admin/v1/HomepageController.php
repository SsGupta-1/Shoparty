<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DB;
use Config;

class HomepageController extends Controller
{
    public function index(){

        $top=Banner::where('type','1')
                    ->where('deleted_at',NULL)
                    ->get();
        //dd($top);
        $buttom=Banner::where('type','2')
                        ->where('deleted_at',NULL)
                        ->first();
                        //->get();
                        //dd($buttom);
        $upcomming=Banner::where('type','3')
                        ->where('deleted_at',NULL)
                        ->first();
                       // ->get();
                       // dd($upcomming);
        return view('admin.homepage.index',compact('top','buttom','upcomming'));
    }


    public function save_image(Request $request ){
        
        $image = [];
        if($request->hasFile('image')){
          // dd($_FILES['image']);
          
            foreach($_FILES['image']['name'] as $keys=>$values){
                if(empty($values)||$values==''){
                    continue;
                }
               
                //dd($values);
           //dd($type);
                $files = $request->file('image');
                foreach($files as $file){
                    $extenstion = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extenstion;
                    $file->move('uploads/banners/', $filename);
                    $image[] = $filename;
                }
                //dd($keys);
                    $data = new Banner;
                    if($keys == 'A2'){
                        $data->type = 2; //Config::get('constants.type.Bottom');
                    }else if($keys == 'A3'){
                        $data->type = 3; //Config::get('constants.type.Upcoming');
                    }else{
                        $data->type = 1; //Config::get('constants.type.Top');
                    }
                  //  dd($type);
                    //$data->type = $type;
                    $data->banner_image = implode('' ,$image);
                    $data->save();
                    return back();
            }
        
        }else if($request->hasFile('edit_image')) {   
            //dd($_FILES['edit_image']);  
            foreach($_FILES['edit_image']['name'] as $key=>$value ){
                if(empty($value)||$value==''){
                    continue;
                }
               //dd($key);
               $result = Banner::Find($key);
               //dd($result->type);
                $files = $request->file('edit_image');
                foreach($files as $file){
                    $extenstion = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extenstion;
                    $file->move('uploads/banners/', $filename);
                    $image[] = $filename;
                }
                $data=Banner::find($key);
                $data->type = $result->type;
                $data->banner_image = implode(',' ,$image);    
                $data->save();
            }
                
             return back();
           
         }else {
             //return back();
         }

    } 
        

    public function delete_img(Request $request , $id){
        $data = Banner::where('id', $id)->first(); 
        $data->status = Config::get('constants.status.Deleted');
        if($data->save()){
         $data->delete();
        }
       
        return redirect('admin/homepage');
    }
   
}
