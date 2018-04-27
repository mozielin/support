@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改資料</h2>
@endsection
@section('contentm')

<body>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading" style="text-align:left;">修改TLC</div>
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
                    <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('seadmin_update',$data->id) }}">
                        {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                        <label for="company_name" class="col-md-4 control-label">公司名稱</label>
                        <div class="col-md-6">
                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{$data->company_name}}" required autofocus>
                            @if ($errors->has('company_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('company_tlc_start') ? ' has-error' : '' }}">
                        <label for="company_tlc_start" class="col-md-4 control-label">TLC開始日期</label>
                        <div class="col-md-6">
                            <input id="company_tlc_start" type="date" class="form-control" style="padding-left:50px;" name="company_tlc_start" value="{{$data->company_tlc_start}}" required>
                                @if ($errors->has('company_tlc_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_tlc_start') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('company_tlc_end') ? ' has-error' : '' }}">
                        <label for="company_tlc_end" class="col-md-4 control-label">TLC結束日期</label>
                        <div class="col-md-6">
                            <input id="company_tlc_end" type="date" class="form-control" style="padding-left:50px;" name="company_tlc_end" value="{{$data->company_tlc_end}}" required>
                                @if ($errors->has('company_tlc_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_tlc_end') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">編輯者</label>
                        <div class="col-md-6">
                            <input id="builder" type="text" class="form-control" name="builder" value="{{$data->name}}" readonly>
                                                  
                        </div>
                    </div>

                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">
                
        
                        <div class="form-group">
                            <div class="col-md-4" style="text-align:center;">
                                <button type="button" class="btn btn-primary" onclick="return delConfirm();">
                                <i class="glyphicon glyphicon-trash"></i>
                                刪除
                              </button>
                              <script>//彈出對話框確認 
                                function delConfirm()
                                  {
                                  if(confirm("確認刪除此資料？")==true)   
                                    window.location="{{URL::route('seadmin_delete', $data->id)}}";
                                    else  
                                    return false;
                                  }   
                              </script>
                            </div>
                            <div class="col-md-4" style="text-align:center;">
                                <button type="submit" class="btn btn-primary"  style="align:center;">
                                <i class="glyphicon glyphicon-check"></i>
                                    確認修改
                                </button>
                            </div>
                            <div class="col-md-4" style="text-align:center;">
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
