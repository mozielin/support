@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">產業瀏覽</h2>
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
                <div class="panel-heading" style="text-align:center;">新增使用者</div>
                    <div class="panel-body">                       
                        <form class="form-horizontal" method="POST" action="{{ route('company_industry_update', $industry->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="status_id" class="col-md-2 control-label" style="text-align:right;">ID:</label>
                                <div class="col-md-4">
                                <input type="text" name="status_id" class="form-control" value="{{$industry->id}}" readonly >
                                </div>

                                <label for="name" class="col-md-1 control-label">Name</label>
                                <div class="col-md-4">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$industry->company_industry_name}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
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
    

</body>
</html>


@endsection
