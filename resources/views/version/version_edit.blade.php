@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">修改version</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block') 
</div>


<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading" style="text-align:center;">修改version</div>
                    <div class="panel-body">

                        <script>//彈出對話框確認
                            function Confirm()
                            {
                                if(confirm("確認修改此筆資料？")==true)   
                                    return true;
                                else  
                                    return history.back();
                            }   
                        </script>
                                                      <!--送出表單前呼叫上面的script-->
                        <form class="form-horizontal" onsubmit="return Confirm();" method="POST" action="{{ route('version_update', $version->id) }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="vernum" class="col-md-2 control-label" style="text-align:right;">版號</label>
                                <div class="col-md-4">
                                <input type="text" name="vernum" class="form-control" value="{{$version->vernum}}">
                                </div>

                                <label for="name" class="col-md-1 control-label">版別</label>
                                <div class="col-md-4">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$version->name}}" required autofocus>
                                   
                                </div>
                            </div>
                            <div class="form-group col-md-12 form-horizontal">
                              <div class="col-md-4 col-md-offset-1" style="text-align:center;">
                                  <button type="submit" class="btn btn-primary" style="align:center;">
                                        <i class="glyphicon glyphicon-check"></i>
                                        確認修改
                                    </button>
                              </div>
                              
                              <div class="col-md-3 col-md-offset-4" style="text-align:center;">
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
