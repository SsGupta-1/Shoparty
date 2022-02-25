@extends('admin.layouts.admin_master_after_login')
@section('content')
<h1>Add Brand</h1>

<form method="post" action="{{ url('admin/store/add') }}" autocomplete="off">
    @csrf
    <div class="datablk mtop">
        <div class="datainner"> 
            <ul class="frmlist">
                <li> <span>Store Name</span> <input type="text" class="form-control" name="en_store_name" value="{{ old('en_store_name') }}" placeholder="Enter Store Name"></li>
                <li> <span>Arabic Name</span> <input type="text" class="form-control" name="ar_store_name" value="{{ old('ar_store_name') }}" placeholder="Enter Arabic Name"></li>
            </ul>

            <ul class="frmlist">
                <li> <span>Address</span> <input type="text" class="form-control" name="en_store_address" value="{{ old('en_store_address') }}" placeholder="Enter Store Address"></li>
                <li> <span>Arabic Address</span> <input type="text" class="form-control" name="ar_store_address" value="{{ old('ar_store_address') }}" placeholder="Enter Arabic Address"></li>
            </ul>
        </div>

    </div>

    <div class="mfooter fbleft">
        <a href="{{ url('admin/stores') }}" class="btn">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
@endsection