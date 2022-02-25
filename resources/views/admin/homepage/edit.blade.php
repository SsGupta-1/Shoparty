@extends('admin.layouts.admin_master_after_login')
@section('content')

  <div>
      <form action="{{url('admin/homepage/edit/'.$data['id']) }} " enctype="multipart/form-data" method="post">
     @csrf
      <label for="id">id</label>
  <input readonly value="{{$data->id}} "></br>
     <label for="image">Image</label>
  <img src="{{asset('uploads/banners/'.$data->banner_image)}}"   style="height:100px; width:80px; "></br>
  <label for="change-image"> Change image</label>
  <input type="file" name="image" id="image" >
  <button type="submit"> submit</button>
  

  </form>
  
  </div>



@endsection