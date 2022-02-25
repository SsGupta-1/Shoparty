<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Store;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::whereIn('status', [Config::get('constants.status.Active'), Config::get('constants.status.Inactive')])->orderby('en_store_name', 'ASC')->get();

        if($stores->count()){
            for ($i=0; $i < $stores->count(); $i++) { 
                $stores[$i]['status_url'] = url('admin/store/status/'.$stores[$i]['id'].'/'.$stores[$i]['status']);
            }
        }

        $data['list'] = $stores;

        return view('admin.store.index', $data);
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'en_store_name'   => 'required|min:1|max:70',
                'ar_store_name'  => 'required|min:1|max:70',
                'en_store_address' => 'required',
                'ar_store_address' => 'required'
            ],[
                'en_store_name.required' => 'Store Name field is required.',
                'ar_store_name.required' => 'Arabic Name field is required.',
                'en_store_address.required' => 'Store Address field is required.',
                'ar_store_address.required' => 'Arabic Address field is required.'
            ]);

            if ($validator->fails())
            {
                $messages = $validator->messages();
                foreach ($messages->all() as $message)
                {
                    Toastr::error($message, 'Failed', ['timeOut' => 5000]);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data['en_store_name'] = strip_tags(trim($request->en_store_name));
            $data['ar_store_name'] = strip_tags(trim($request->ar_store_name));
            $data['en_store_address'] = strip_tags(trim($request->en_store_address));
            $data['ar_store_address'] = strip_tags(trim($request->ar_store_address));

            $store = Store::create($data);

            Toastr::success('Store Added Successfully', 'Success', ['timeOut' => 5000]);
            return redirect()->back();
        } else {
            return view('admin.store.add');
        }
    }

    public function updateStatus(Request $request, $id, $status)
    {
        $store = Store::where('id', $id)->first();

        $store->status = ($status == 1) ? 0 : 1;

        $store->save();

        return TRUE;
    }
}
