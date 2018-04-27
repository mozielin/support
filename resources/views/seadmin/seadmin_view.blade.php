@extends('layouts.master')

@section('title')
<h2 style="margin-top:2px;">使用者資訊</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  <div class="panel panel-default">
    <div class="panel-heading" style="height:100%;">
      <div class="row-menu" style="height:40px;">
        <ul class="drop-down-menu1">
          <li style="border-color:#D3E0E9;"><a href="http://192.168.1.95/company">客戶總覽</a>
          </li>
          <li><a href="http://192.168.1.95/plan">客戶方案</a>
          </li>
          <li><a href="#">Server info</a>
          </li>
          <li><a href="#">案件型態</a>
          </li>
          <li><a href="http://192.168.1.95/type">公司型態</a>
          </li>
          <li><a href="http://192.168.1.95/industry">公司產業別</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container" style="width:780px;height:80px;margin-right:218px;">
  <div class="panel panel-default">
    <div class="panel-heading" style="height:40px;display:flex;justify-content:center;text-align:center;">
          <p>User Info</p>
    </div>    
      <div class="panel-body" style="height:440px;" >
        <div class="upper-content" style="height:330px;width:auto;">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="height:360px;text-align:center;float:left;margin-bottom:0px !important;">
            <div class="hexa">
              <div class="hex1">
                <div class="hex2">
                  <img src="{{$img}}" alt="" width="320" height="313" />
                </div>
              </div>
            </div> 
            <p><label for="test">{{$user->user_img}}</label></p>

            <form class="form-horizontal" method="post" action="{{route('user_upload',$user->id)}}" enctype="multipart/form-data"> 
                      {{csrf_field()}}
                      <div class="123" style="width:325px;height:50px;" >
                        <div class="123-left" style="width:230px;float:left;">
                             <input type="file" class="form-control"  name="image" accept=".jpg, .jpeg, .png" value="Upload" style="width:225px;">
                        </div>
                        <div class="123-right" style="width:85px;float:left;">
                          <button type="submit" class="btn btn-primary" style="width:80px;">Upload</button>
                        </div>
                      </div>
            </form>
          </div>

          <div class="right-side-content" style="width:379px;height:360px;float:right;">
              <table border="0" style="width:100%;">
                <tr >
                　<td style="width:40%;text-align:right;padding-bottom:10px;padding-right:10px;">Group:</td>
                　<td style="padding-bottom:10px;">{{$user->user_group_name}}</td>
              　</tr>
              　<tr>
                　<td style="text-align:right;padding-bottom:10px;padding-right:10px">User Name:</td>
                　<td style="padding-bottom:10px;">{{$user->name}}</td>
              　</tr>
                <tr>
                　<td style="text-align:right;padding-bottom:10px;padding-right:10px">E-mail:</td>
                　<td style="padding-bottom:10px;">{{$user->email}}</td>
              　</tr>
                <tr>
                  　<td style="text-align:right;padding-bottom:10px;padding-right:10px">用戶權限:</td>
                  　<td style="padding-bottom:10px;">{{$user->display_name}}</td>
                　</tr>
                <tr>
                  　<td style="text-align:right;padding-bottom:10px;padding-right:10px">最後登入:</td>

                  　<td style="padding-bottom:10px;">{{$user->login_at}}</td>
                　</tr>
              </table>
             
          </div>
        </div>


        <div class="container-fuild" >
            <div class="col-md-3"> 
              <button type="button" class="btn btn-primary" onclick="return Confirm();">
                刪除
              </button>
            </div>
            <div class="col-md-3">     
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_reset', $user->id)}}'">
                修改密碼
              </button> 
            </div> 
            <div class="col-md-3">  
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_edit', $user->id)}}'" >
                修改資料
              </button>
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
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('seadmin_index')}}'">
                返回
              </button>
          </div>  
        </div> 
    </div>
  </div>
</div>
                  

@endsection


