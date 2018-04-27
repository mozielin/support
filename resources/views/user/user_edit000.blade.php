@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改資料</h2>
@endsection
@section('contentm')

<body>
<div class="container" style="width:780px;height:80px;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading" style="text-align:center;">修改使用者</div>
                <div class="panel-body">                             
                    <script>//彈出對話框確認
                        function Confirm()
                        {
                            if(confirm("確認修改此筆資料？")==true)   
                                return true;
                            else  
                                return false;
                              }   
                    </script>                                             <!--送出表單前呼叫上面的script-->
                    <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('user_update',$user->id) }}">
                        {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    @role('admin')
                    <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                        <label for="user_role" class="col-md-4 control-label">使用者權限</label>
                        <div class="col-md-6">
                            <select name="user_role">
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
                    
                                @if ($errors->has('user_role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_role') }}</strong>
                                    </span>
                                @endif
                        </div>                    
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="user_group" class="col-md-4 control-label">User.group</label>
                        <div class="col-md-6">
                           <select name="user_group">
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
                    @endrole
        
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"  style="align:center;">
                                    確認修改
                                </button>
                            </div>
                            <div class="col-md-4 ">
                                <button type="button" class="btn btn-primary" onclick="history.back()">
                                    返回
                                </button>
                            </div>
                        </div>
                    </form>
                </div>          
        </div>
    </div>
</div>
    

</body>
</html>


@endsection
