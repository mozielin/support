@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">修改方案</h2>
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
                <div class="panel-heading" style="text-align:center;">修改方案</div>
                    <div class="panel-body">                       
                        <form class="form-horizontal" method="POST" action="{{ route('company_plan_update', $plan->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('plan_name') ? ' has-error' : '' }}">
                                <label for="plan_id" class="col-md-2 control-label" style="text-align:right;">ID:</label>
                                <div class="col-md-4">
                                <input type="text" name="plan_id" class="form-control" value="{{$plan->id}}" readonly >
                                </div>

                                <label for="name" class="col-md-1 control-label">Name</label>
                                <div class="col-md-4">
                                    <input id="plan_name" type="text" class="form-control" name="plan_name" value="{{$plan->plan_name}}" required autofocus>
                                    @if ($errors->has('plan_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('plan_name') }}</strong>
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
    <!-- onclick="if(confirm('確認要送出本表單嗎？')==true)this.form.submit();"-->



@endsection
