<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaticPage;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;

class CMSController extends Controller
{
    public function index()
    {
        $static = StaticPage::where('status', Config::get('constants.status.Active'))->whereIn('type', [1, 4])->orderby('title', 'ASC')->get();

        $data['list'] = $static;

        return view('admin.cms.index', $data);
    }

    public function edit(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'type'   => 'required',
                'title'    => 'required',
                'description' => 'required'
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

            StaticPage::where(['status' => Config::get('constants.status.Active'), 'type' => $request->type])->update(['status' => Config::get('constants.status.Inactive')]);

            $data['type']                   = $request->type;
            $data['title']                  = $request->title;
            $data['description']            = $request->description;

            $static                         = StaticPage::create($data);

            Toastr::success(Config::get('constants.static.'.$request->type).' Updated Successfully', 'Success', ['timeOut' => 5000]);
            return redirect('admin/cms');
        } else {
            $data['static'] = StaticPage::where(['id' => $id, 'status' => Config::get('constants.status.Active')])->first();
            return view('admin.cms.edit', $data);
        }
    }

    public function listPolicy()
    {
        $static = StaticPage::where('status', Config::get('constants.status.Active'))->whereIn('type', [2, 3])->orderby('title', 'ASC')->get();

        $data['list'] = $static;

        return view('admin.policy.index', $data);
    }

    public function editPolicy(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'type'   => 'required',
                'title'    => 'required',
                'description' => 'required'
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

            $static = StaticPage::where('id', $id)->first();

            $static->type                   = $request->type;
            $static->title                  = $request->title;
            $static->description            = $request->description;

            $static->save();

            Toastr::success(Config::get('constants.static.'.$request->type).' Updated Successfully', 'Success', ['timeOut' => 5000]);
            return redirect('admin/policy');
        } else {
            $data['static'] = StaticPage::where(['id' => $id, 'status' => Config::get('constants.status.Active')])->first();
            return view('admin.policy.edit', $data);
        }
    }

    public function addPolicy(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'type'   => 'required',
                'title'    => 'required',
                'description' => 'required'
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

            $data['type']                   = $request->type;
            $data['title']                  = $request->title;
            $data['description']            = $request->description;

            $static                         = StaticPage::create($data);

            Toastr::success(Config::get('constants.static.'.$request->type).' Added Successfully', 'Success', ['timeOut' => 5000]);
            return redirect('admin/policy');
        } else {
            return view('admin.policy.add');
        }
    }

    public function deletePolicy(Request $request, $id)
    {
        $static = StaticPage::where('id', '=', $id)->first();

        $static->status = Config::get('constants.status.Deleted');

        $static->save();

        Toastr::success(Config::get('constants.static.'.$static->type).' Deleted Successfully', 'Success', ['timeOut' => 5000]);
        return redirect('admin/users');
    }
}
