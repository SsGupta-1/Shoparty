<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Brand;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::whereIn('status', [Config::get('constants.status.Active'), Config::get('constants.status.Inactive')])->orderby('name', 'ASC')->get();

        if($brands->count()){
            for ($i=0; $i < $brands->count(); $i++) { 
                $brands[$i]['status_url'] = url('admin/brand/status/'.$brands[$i]['id'].'/'.$brands[$i]['status']);
            }
        }

        $data['list'] = $brands;

        return view('admin.brand.index', $data);
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'name'   => 'required|min:1|max:70',
                'ar_name'  => 'required|min:1|max:70'
            ],['name.required' => 'Brand Name field is required.', 'ar_name.required' => 'Arabic Name field is required.']);

            if ($validator->fails())
            {
                $messages = $validator->messages();
                foreach ($messages->all() as $message)
                {
                    Toastr::error($message, 'Failed', ['timeOut' => 5000]);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data['name'] = strip_tags(trim($request->name));
            $data['ar_name'] = strip_tags(trim($request->ar_name));

            $brand = Brand::create($data);

            Toastr::success('Brand Created Successfully', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } else {
            return view('admin.brand.add');
        }
    }

    public function updateStatus(Request $request, $id, $status)
    {
        $brand = Brand::where('id', $id)->first();

        $brand->status = ($status == 1) ? 0 : 1;

        $brand->save();

        return TRUE;
    }
}
