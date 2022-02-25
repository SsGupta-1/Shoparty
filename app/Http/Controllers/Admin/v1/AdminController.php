<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // return view('welcome');
        return redirect('admin/users');
    }
}
