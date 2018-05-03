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
      <div class="panel-body" style="height:440px;" >
        <div class="upper-content" style="height:330px;width:auto;">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="height:360px;width:325px;text-align:center;float:left;margin-bottom:0px !important;">
            <div class="hexa">
              <div class="hex1">
                <div class="hex2">
                  <img src="{{$img}}" alt="" width="320" height="313" />
                </div>
              </div>
            </div> 
            <p><label for="test">{{$user->user_img}}</label></p>

            <form class="form-horizontal input-group" method="post" action="{{route('user_upload',$user->id)}}" enctype="multipart/form-data"> 
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
              <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('user_update',$user->id) }}">
                        {{ csrf_field() }}

              <div class="form-group col-md-12 form-horizontal">         
              <label for="user_group_name" class="col-md-4 control-label" style="text-align:right;">用戶組別:</label>
              <div class="col-md-8">
              <select name="user_group" class="form-control" style="width: 100%;text-align: center;padding-left:95px " required>
                            @foreach ($user_group as $group)
                                @if($group->id == $user->user_group)
                                    //如果迴圈的PLANID符合公司PLANID則預設選取
                                    <option selected="true" value="{{$group->id}}">{{$group->user_group_name}}</option>
                                @else
                                    //如果不符合就跑一般選項
                                    <option value="{{$group->id}}">{{$group->user_group_name}}</option>
                                @endif                                
                            @endforeach
                            </select>     
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">
              <label for="name" class="col-md-4 control-label" style="text-align:right;">用戶名稱:</label>
              <div class="col-md-8">
              <input type="text" name="name" class=" col-md-8 form-control" style="width: 100%;text-align: center" value="{{$user->name}}" required>
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="display_name" class="col-md-4 control-label" style="text-align:right;">用戶權限:</label>
              <div class="col-md-8 " >
              <select name="user_role" class="form-control" style="width: 100%;text-align: center;padding-left:85px " required>
                            @foreach ($data as $roledata)
                                @foreach ($user_role as $roles)
                                   @foreach ($roles ->roles as $role)
                                        @if($role->id == $roledata->id)
                                            <option selected="true" value="{{$role->id}}">{{$role->display_name}}</option>
                                        @else
                                            <option  value="{{$roledata->id}}">{{$roledata->display_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                            </select>            
              </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">         
              <label for="email" class="col-md-4 control-label" style="text-align:right;">電子郵件:</label>
              <div class="col-md-8">
              <input type="text" name="email" class=" col-md-8 form-control" style="width: 100%;text-align: center" value="{{$user->email}}" required>            
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
              <button type="button" class="btn btn-primary" onclick="return delConfirm();">
              <i class="glyphicon glyphicon-trash"></i>
                刪除
              </button>
            </div>
            <div class="col-md-3">     
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_reset', $user->id)}}'">
              <i class="glyphicon glyphicon-magnet"></i>
                修改密碼
              </button> 
            </div> 
            <div class="col-md-3">  
              <button type="submit" class="btn btn-primary" onclick="location.href='{{route('user_edit', $user->id)}}'" >
              <i class="glyphicon glyphicon-check"></i>
                確認修改
              </button>
              <script>//彈出對話框確認 
                function delConfirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                    window.location="{{URL::route('user_delete', $user->id)}}";
                    else  
                    return false;
                  }   

                function Confirm()
                  {
                    if(confirm("確認修改此筆資料？")==true)   
                      return true;
                    else  
                      return false;
                  } 
              </script>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary" onclick="history.back()">
              <i class="glyphicon glyphicon-backward"></i>
                返回
              </button>
          </div>  
          </div>
          </form>
        </div> 
    </div>
  </div>
</div>

@endsection


