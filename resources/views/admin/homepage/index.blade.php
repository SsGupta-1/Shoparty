@extends('admin.layouts.admin_master_after_login')
@section('content')


    <div class="rightblk">
		<h1>Home Page Management</h1>
	    <div class="datablk mtop">
			<div class="datainner nopadding">
             <form action=" " id="imgform" enctype="multipart/form-data" method="post">
             @csrf
                <div class="setbp">	
                        <div class="thead">Top Banners</div>
                        
                        <ul class="addbanlist">

                            @foreach($top as $topimg)
                          
                            <li>    
                          
                                <div class="imgdiv" id="d1" >
                                    <div class="imgbc"><img  src="{{ isset($topimg) ?   asset('uploads/banners/'.$topimg->banner_image) : ''}}"  id="imgprv_1"  alt="img" class="imgview" style="height:80px; width:70px; "> </div>
                                    <div class="baty">
                                         <label  class="custom-file-input smallb">
                                         <input type="file" name="edit_image[{{isset($topimg) ? $topimg->id : ''}}]" multiple="true" class="edit_img">
                                         <input type="hidden" name="banner_id" >
                                        </label>
                                        <a href="{{isset($topimg) ?  url('admin/homepage/delete/'.$topimg->id) : '' }}"><img src="{{ asset('assets/img/deleteicon.svg') }}" ></a>
                                    </div>
                                </div>                            
                               
                            </li>
                            @endforeach

                            <?php $num= count($top); ?>
                          @for($i=0; $i<(6-$num); $i++ )
                            <li> 
                           
                                <div class="imginput" >
                                    <label class="custom-file-input">
                                        <input type="file" multiple="true" class="img_input_tag" name="image[]" id="inpimg">
                                    </label>
                                </div> 
                           
                            </li>
                          @endfor 
                          
                          
                           
                        </ul>
                    </div>
                    <div class="setbp bgs">	
                        <div class="thead">Bottom Banners</div>
                        <ul class="addbanlist">
                    
                            <li> 
                            <div class="imgdiv" id="d7">
                                    <div class="imgbc"><img src="{{ isset($buttom) ?   asset('uploads/banners/'.$buttom->banner_image) : ''}}"   class="imgview"  alt="img" style="height:80px; width:70px;"> </div>
                                    <div class="baty">
                                    <label  class="custom-file-input smallb">
                                         <input type="file" name="edit_image[{{ isset($buttom) ? $buttom->id : '' }}]" multiple="true" class="edit_img">
                                         <input type="hidden" name="banner_id" >
                                        </label>
                                        <a href="{{isset($buttom) ?  url('admin/homepage/delete/'.$buttom->id) : '' }}"><img src="{{ asset('assets/img/deleteicon.svg') }}" ></a>
                                    </div>
                                </div>
                               
                                <div class="imginput" id="i7"> 
                                    <label class="custom-file-input">
                                        <input type="file" multiple="true" class="img_input_tag"  name="image[{{'A2'}}]" id="inpimg">
                                    </label>
                                </div>
                            </li>
            
                        </ul>
                    </div>

                    <div class="setbp">	
                        <div class="thead">Upcoming Season</div>
                        <ul class="addbanlist">
                        
                            <li> 
                                <div class="imgdiv" id="d8">
                                    <div class="imgbc"><img src="{{ isset($upcomming) ?   asset('uploads/banners/'.$upcomming->banner_image) : ''}}"  id="imgprv_8" class="imgview"  alt="img" style="height:80px; width:70px;"> </div>
                                    <div class="baty">
                                    <label  class="custom-file-input smallb">
                                        <input type="file" name="edit_image[{{ isset($upcomming) ? $upcomming->id : '' }}]" multiple="true" class="edit_img">
                                        <input type="hidden" name="banner_id" >
                                        </label>
                                        <a href="{{isset($upcomming) ?  url('admin/homepage/delete/'.$upcomming->id) : '' }}"><img src="{{ asset('assets/img/deleteicon.svg') }}" ></a>
                                    </div>
                                </div>
                                
                                <div class="imginput" id="i8"> 
                                    <label class="custom-file-input">
                                        <input type="file" multiple="true" class="img_input_tag"  name="image[{{'A3'}}]" value="3" id="inpimg">            
                                    </label>
                                
                                </div>
                            </li>
            
                        </ul>
                    </div>
                    <input type="submit" name="submit" class="submitBtn" value="SUBMIT" style="display:none;"/>
                 </form>
            </div>
        </div>    
    </div>
@endsection

@section('script')

<script>
       
       
        $(function() {
        if($(' #d7 .imgbc img').attr('src') == ''){
            $('#d7').hide();
        }
        else{
             
            $('#i7').hide();
        }
        });

        $(function() {
        if($(' #d8 .imgbc img').attr('src') == ''){
            $('#d8').hide();
        }
        else{
             
            $('#i8').hide();
        }
        });

    
    $(document).ready(function (e){
        
        $(':input').change(function(e){
            console.log("submit");      
                             
            $(".submitBtn:hidden").trigger('click');
             $("#imgform").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url:" {{route('/homepage')}}" ,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('.submitBtn').attr("disabled","disabled");
                        $('#imgform').css("opacity",".5");
                    },
                
                
                });
            });           
                                                                     
        });

        $('.edit_img').change(function(e){
            console.log('clicked');
            $(".submitBtn:hidden").trigger('click');
            $("#imgform").on('submit', function(e){
                e.preventDefault();
                var id=$("input:hidden[name='banner_id']").val();    
                $.ajax({
                    type: 'post',
                    url:"{{url('/homepage')}}" ,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                
                    
                });
            });

        });




    });

     
 </script>
@endsection