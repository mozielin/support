@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">修改選購功能</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block') 
</div>


<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading" style="text-align:center;">修改選購功能</div>
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
                        <form class="form-horizontal" onsubmit="return Confirm();" method="POST" action="{{ route('function_update', $function->id) }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('function_id') ? ' has-error' : '' }}">
                                <label for="status_id" class="col-md-2 control-label" style="text-align:right;">ID:</label>
                                <div class="col-md-4">
                                <input type="text" name="function_id" class="form-control" value="{{$function->id}}" readonly >
                                </div>

                                <label for="function_name" class="col-md-1 control-label">Name</label>
                                <div class="col-md-4">
                                    <input id="function_name" type="text" class="form-control" name="function_name" value="{{$function->function_name}}" required autofocus >
                                    @if ($errors->has('function_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('function_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-2 control-label" style="text-align:right;">代碼:</label>
                                <div class="col-md-4">
                                <input type="text" name="code" class="form-control" value="{{$function->code}}" required>
                                </div>

                                <label for="select" class="col-md-1 control-label">綁定</label>
                                <div class="col-md-4">
                                  <select id="status_class" name="status_class" style="width:80px;padding-right:15px;" class="form-control" required placeholder="請選擇">
                                      
                                      <option value="0" 
                                      @if($function->select == 0)selected="true"
                                      @endif>
                                      是
                                      </option>
                                      <option value="1"
                                      @if($function->select == 1)selected="true"
                                      @endif>否</option>
                                  </select>
                                    
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
