@extends('layouts.master')
@section('contentm')


<div class="container" style="width:780px;height:80px;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
      <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;">
          <p>Group Info</p>
        </div>    
        <div class="panel-body">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="text-align:center;">
              <p><label for="id" style="margin-left: 8px;">henry'wife : {{$group->user_group_name}}</label></p>
          </div>
            <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_group_edit', $group->id)}}'" style="margin-left:298px;"> 
              修改
            </button>
        
            <button type="button"  class="btn btn-primary" onclick="return Confirm();">
            刪除
            </button>
              <script>//彈出對話框確認 

                function Confirm()
                {
                  if(confirm("確認刪除此資料？")==true)   
                    window.location="{{URL::route('user_group_delete', $group->id)}}";
                  else  
                    return false;
                }   
              </script>
        </div>           
      </div>
    </div>
  </div>
</div>              

@endsection


