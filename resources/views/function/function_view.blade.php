@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">選購功能瀏覽</h2>
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
        <div class="panel-heading" style="text-align:center;">
          <p>Function Info</p>
        </div>    
        <div class="panel-body">
            <div class="form-group col-md-12 form-horizontal"> 
                <label for="status_id" class="col-md-2 control-label" style="text-align:right;">ID:</label>
                <div class="col-md-4">
                  <input type="text" name="status_id" class="form-control" value="{{$function->id}}" readonly >
                </div>

                 <label for="status_class" class="col-md-2 control-label" style="text-align:right;">Name:</label>
                <div class="col-md-4">
                  <input type="text" name="status_class" class="form-control" value="{{$function->function_name}}" readonly >
                </div>  
            </div>

            <div class="form-group col-md-12 form-horizontal"> 
                <label for="code" class="col-md-2 control-label" style="text-align:right;">代碼:</label>
                <div class="col-md-4">
                  <input type="text" name="code" class="form-control" value="{{$function->code}}" required readonly>
                </div>

                <label for="select" class="col-md-2 control-label">綁定</label>
                  <div class="col-md-4">
                  @if($function->select == 0)
                    <input type="text" name="select" class="form-control" value="是" required readonly>
                  @else
                    <input type="text" name="select" class="form-control" value="否" required readonly>   
                  @endif
                  </div>
            </div>
            <div class="form-group col-md-12 form-horizontal">
            <div class="col-md-4" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                    <i class="glyphicon glyphicon-trash"></i>
                    刪除
                </button>
            </div>
            <div class="col-md-4" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('function_edit', $function->id)}}'">
                    <i class="glyphicon glyphicon-pencil"></i> 
                修改
                </button>
            </div>
            <div class="col-md-4" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('function_all')}}'">
              <i class="glyphicon glyphicon-backward"></i>
              返回
                </button>
            </div> 
            </div>
          
          <script>//彈出對話框確認 

          function Confirm()
          {
                  if(confirm("確認刪除此資料？")==true)   
                    window.location="{{URL::route('function_delete', $function->id)}}";
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


