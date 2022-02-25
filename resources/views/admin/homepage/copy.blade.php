@extends('admin.layouts.admin_master_after_login')
@section('content')


<div class="rightblk">
				<h1>Home Page Management</h1>
	
				<div class="datablk mtop">
				<div class="datainner nopadding">
				<div class="setbp">	
				<div class="thead">Top Banners</div>

				<ul class="addbanlist">
                            
                    <li>
                        <form action=" {{route('/homepage')}} " id="imgform" enctype="multipart/form-data" method="post">
                        @csrf
                            <div class="imgdiv" >
                                <div class="imgbc"><img src="{{asset('uploads/banners/'.$last->banner_image)}} "  id="img_prv"  alt="img" style="height:100px; width:80px; "> </div>
                                <div class="baty">
                                    <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                    <a href="{{url()}} "><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                                </div>
                            </div>
                            <div class="imginput">
                                <label class="custom-file-input">
                                   
                                    <input type="file" onchange="readUrl(this)"  name="image" id="image" >
                                </label>
                               
                            </div>
                        </form>
                    </li>

                    <li>
                        <div>
                            <div class="imgbc"><img src=""  id="img_prv1"  alt="img"> </div>
                            <div class="baty">
                                <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                <a href="#"><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                            </div>
                        </div>
                        <div>
                            <label class="custom-file-input">
                                <input type="file" onchange="readUrl(this)"  name="imgage" id="imgage">
                            </label>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="imgbc"><img src=""  id="img_prv2"  alt="img"> </div>
                            <div class="baty">
                                <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                <a href="#"><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                            </div>
                        </div>
                        <div>
                            <label class="custom-file-input">
                                <input type="file" onchange="readUrl(this)"  name="imgage" id="imgage">
                            </label>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="imgbc"><img src=""  id="img_prv3"  alt="img"> </div>
                            <div class="baty">
                                <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                <a href="#"><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                            </div>
                        </div>
                        <div>
                            <label class="custom-file-input">
                                <input type="file" onchange="readUrl(this)"  name="imgage" id="imgage">
                            </label>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="imgbc"><img src=""  id="img_prv4"  alt="img"> </div>
                            <div class="baty">
                                <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                <a href="#"><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                            </div>
                        </div>
                        <div>
                            <label class="custom-file-input">
                                <input type="file" onchange="readUrl(this)"  name="imgage" id="imgage">
                            </label>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="imgbc"><img src=""  id="img_prv5"  alt="img"> </div>
                            <div class="baty">
                                <a href="#"><img src="{{asset('assets/img/icon-material-edit.png')}}" ></a>
                                <a href="#"><img src="{{asset('assets/img/icon-material-delete.png')}}" ></a>
                            </div>
                        </div>
                        <div>
                            <label class="custom-file-input">
                                <input type="file" onchange="readUrl(this)"  name="imgage" id="imgage">
                            </label>
                        </div>
                    </li>
				</ul>
				</div>
					<div class="setbp bgs">	
				<div class="thead">Bottom Banners</div>
				<ul class="addbanlist">
			
				<li><label  class="custom-file-input">
					<input type="file"></label></li>
	
				</ul>
				</div>

				<div class="setbp">	
				<div class="thead">Upcoming Season</div>
				<ul class="addbanlist">
				
				<li><label  class="custom-file-input">
					<input type="file"></label></li>
	
				</ul>
				</div>





	
			</div>
@endsection

@section('script')

<script>
    var a =document.getElementById("img_prv");
    // var b =document.getElementById("img_prv1");
    // var c =document.getElementById("img_prv2");
    // var d =document.getElementById("img_prv3");
    // var e =document.getElementById("img_prv4");
    // var f =document.getElementById("img_prv5");
    function readUrl(input){
        if(input.files){
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = (e) => {                                             
               
                a.src = e.target.result;
                a.src = imgform.submit();

                if(a.src){
                    $('.imgdiv').css("display","block");
                    $('.imginput').css("display","none");
                    // document.getElementById("imgform").submit();
                    
                }else{
                    $('.imgdiv').css("display","none");
                    
                }
              
                        // b.src = e.target.result;
                        // c.src = e.target.result;
                        // d.src = e.target.result;
                        // e.src = e.target.result;
                        // f.src = e.target.result;
                
            }
        }
    }


//    function submitform(e){
//        e.preventDefault();
//        console.log("hello");
//        document.getElementById("imgform").submit();

//    }


//     $(document).ready(function() {
//     $('#image').change(function(){
//         var file_data = $('#image').prop('files')[0];   
//         var form_data = new FormData();                  
//         form_data.append('file', file_data);
//         $.ajax({
//             url: "{{url('/admin/homepage')}}",
//             type: "POST",
//             data: form_data,
//             contentType: false,
//             cache: false,
//             processData:false,
//             success: function(data){
//                 console.log(data);
//             }
//         });
//     });
// });



            // $.ajax({
            //     type: "POST",
            //     data: $('#imgform').serialize(),
            //     url: "{{url('admin/homepage')}}",
            //     success:function(data){
            //         //window.location.href = window.location.href;
            //         console.log(data);
            //     },

        //     });
        // });
        
 
                               
 </script>
@endsection




function edit_img(e){
       
       var id = $(e).attr('id');
       console.log(id);

       if(e.files){
       var fileReader = new FileReader();
           fileReader.onload = function () {
              var data = fileReader.result;  
              console.log(data);
           };
            fileReader.readAsDataURL(e.files[0]);     
       }
            $.ajax({
               type: 'POST',
               url:" {{url('/homepage/edit',['id'])}}" ,
               data: {id:id, image:data},
               dataType: 'json',
            });

       
   };