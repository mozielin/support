@extends('layouts.master')

@section('title')
<h2 style="margin-top:2px;">使用者資訊</h2>
@endsection

@section('contentm')

<!--中間選單-->
 <div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.center_block')
  </div>
  
<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <div class="panel panel-default">
    <div class="panel-heading" style="height:40px;display:flex;justify-content:center;text-align:center;">
          <p>User Info</p>
    </div>    
      <div class="panel-body" style="height:500px;" >
        <div class="upper-content" style="height:420px;width:auto;">
          <div name="pic"class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-left:20px;height:360px;width:325px;text-align:center;float:left;margin-bottom:0px !important;">
         
                <div class="">
                  <img src="{{$img}}" alt="" width="250" height="250" style="border-radius:50%;-webkit-border-radius: 50%;"/>
                </div>
       
            <p><label for="test">{{$img}}</label></p>

            <form class="form-horizontal" method="post" action="{{route('user_upload',$user->id)}}" enctype="multipart/form-data"> 
                      {{csrf_field()}}
                      <div class="123" style="width:325px;height:50px;" >
                        <div class="123-left" style="width:230px;float:left;">
                             <input type="file" class="form-control"  name="image" accept=".jpg, .jpeg, .png" value="Upload" style="width:235px;">
                        </div>
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-primary" >Upload  <i class="glyphicon glyphicon-arrow-up"></i></button>
                        </div>
                      </div>
            </form>
          </div>

          <div class="form-horizontal form-group" style="width:379px;height:360px;float:right;">
              
              <div class="form-group form-horizontal">

              <div class="form-group col-md-12 form-horizontal">         
              <label for="title" class="col-md-4 control-label" style="text-align:right;">職務名稱:</label>
              <div class="col-md-8">
              <input type="text" name="title" class=" col-md-8 form-control" value="{{$user->title}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="user_group_name" class="col-md-4 control-label" style="text-align:right;">用戶組別:</label>
              <div class="col-md-8">
              <input type="text" name="user_group_name" class=" col-md-8 form-control" value="{{$user->user_group_name}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">
              <label for="user_name" class="col-md-4 control-label" style="text-align:right;">用戶名稱:</label>
              <div class="col-md-8">
              <input type="text" name="user_name" class=" col-md-8 form-control" value="{{$user->name}}" readonly required>
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="display_name" class="col-md-4 control-label" style="text-align:right;">用戶權限:</label>
              <div class="col-md-8">
              <input type="text" name="display_name" class=" col-md-8 form-control" value="{{$user->display_name}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="phone" class="col-md-4 control-label" style="text-align:right;">聯絡電話:</label>
              <div class="col-md-8">
              <input type="text" name="phone" class=" col-md-8 form-control" value="{{$user->phone}}分機#{{$user->ext}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="mobile" class="col-md-4 control-label" style="text-align:right;">手機電話:</label>
              <div class="col-md-8">
              <input type="text" name="mobile" class=" col-md-8 form-control" value="{{$user->mobile}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="email" class="col-md-4 control-label" style="text-align:right;">電子郵件:</label>
              <div class="col-md-8">
              <input type="text" name="email" class=" col-md-8 form-control" value="{{$user->email}}" readonly required>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="login_at" class="col-md-4 control-label" style="text-align:right;">最後登入:</label>
              <div class="col-md-8">
              <input type="text" name="login_at" class=" col-md-8 form-control" value="{{$user->login_at}}" readonly required>            
              </div>
              </div>

          </div>


             
          </div>


        </div>


        <div class="container-fuild col-md-12" >
            <div class="col-md-3"> 
              @permission('user_delete')
              <button type="button" class="btn btn-primary" onclick="return Confirm();">
              <i class="glyphicon glyphicon-trash"></i>
                刪除
              </button>
              @endpermission 
            </div>
            <div class="col-md-3">     
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_reset', $user->id)}}'">
              <i class="glyphicon glyphicon-magnet"></i>
                修改密碼
              </button> 
            </div> 
            <div class="col-md-3"> 
              @permission('user_edit')   
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_edit', $user->id)}}'" >
              <i class="glyphicon glyphicon-pencil"></i>
                修改資料
              </button>
              @endpermission 
              <script>//彈出對話框確認 
                function Confirm()
                  {
                  if(confirm("確認刪除此資料？")==true)   
                    window.location="{{URL::route('user_delete', $user->id)}}";
                    else  
                    return false;
                  }   
              </script>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_index')}}'">
              <i class="glyphicon glyphicon-backward"></i>
                返回
              </button>
          </div>  
        </div> 
    </div>
  </div>
</div>
                  

@endsection


