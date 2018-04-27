@extends('layouts.master')
@section('title')
  <h2 style="margin-top: 2px">修改狀態</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block') 
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">修改Status_ID:{{$status->id}}</div>
                    <div class="panel-body">                       
                        <form class="form-horizontal" method="POST" action="{{ route('status_update', $status->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('status_name') ? ' has-error' : '' }}">

                                <label for="status_class" class="col-md-1 control-label" style="text-align:center;">Class:</label>
                                <div class="col-md-5">
                                    <select class="form-control" style="padding-left:70px;" name="status_class" placeholder="請輸入" required>                                                       
                                            <option value="合約">合約</option>
                                            <option value="Lic">Lic</option>
                                            <option value="方案">方案</option>
                                            <option value="申請">申請</option>
                                            <option value="案件">案件</option>
                                    </select>
                                    
                                </div>

                                <label for="name" class="col-md-1 control-label" style="text-align:center;">Name:</label>
                                <div class="col-md-5">
                                    <input id="status_name" type="text" class="form-control" name="status_name" value="{{$status->status_name}}" required autofocus>
                                    
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary" style="align:center;">
                                    <i class="glyphicon glyphicon-check"></i>
                                        確認修改
                                    </button>
                                </div>
                                <div class="col-md-3 col-md-offset-3 ">
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
    </div>
</div>
    <!-- onclick="if(confirm('確認要送出本表單嗎？')==true)this.form.submit();"-->



@endsection
