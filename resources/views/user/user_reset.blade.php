@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改資料</h2>
@endsection
@section('contentm')

<body>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading" style="text-align:center;">修改密碼</div>
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
                    <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('user_resetpwd',$user->id) }}">
                        {{ csrf_field() }}
                    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">New Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="請輸入新密碼" required autofocus>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" placeholder="請再次輸入密碼" required autofocus>
                            </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"  style="align:center;">
                                <i class="glyphicon glyphicon-check"></i>
                                    確認修改
                                </button>
                            </div>
                            <div class="col-md-4 ">
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
    

</body>
</html>


@endsection
