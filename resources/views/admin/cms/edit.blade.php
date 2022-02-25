@extends('admin.layouts.admin_master_after_login')
@section('content')
<h1>Edit CMS</h1>

<form method="post" action="{{ url('admin/cms/edit/'.$static['id']) }}" autocomplete="off">
    @csrf
    <div class="datablk mtop">
        <div class="datainner">	
            <div class="fly">
                <ul class="frmlist twolist">
                    <li> <span>Used In Application</span> 
                        <select class="form-control" disabled>
                            <option value="1" {{ (old('type', $static['type']) == 1) ? 'selected' : '' }}>About Us</option>
                            <option value="4" {{ (old('type', $static['type']) == 4) ? 'selected' : '' }}>Terms & Conditions</option>
                        </select>
                        <input type="hidden" name="type" value="{{ old('type', $static['type']) }}">
                    </li>
                    <li> <span>Title</span> <input type="text" class="form-control" name="title" value="{{ old('title', $static['title']) }}" placeholder="Enter Title"></li>

                </ul>
            </div>
            <div class="frmsheadnew">Description</div>
            <div class="textblk">
                <textarea class="form-control" cols="5" name="description">{{ old('description', $static['description']) }}</textarea>
            </div>
        </div>
    </div>
    <div class="mfooter fbleft">
        <a href="{{ url('admin/cms') }}" class="btn" data-dismiss="modal">Cancel</a>
        <button type="submit" class="btn mbtn">Save</button>
    </div>
</form>
@endsection