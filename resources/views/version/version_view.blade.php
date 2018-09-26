@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">version瀏覽</h2>
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
          <p>Type Info</p>
        </div>    
        <div class="panel-body">
            <div class="form-group col-md-12 form-horizontal"> 
                <label for="status_id" class="col-md-1 control-label" style="text-align:right;">ID:</label>
                <div class="col-md-4">
                  <input type="text" name="status_id" class="form-control" value="{{$version->vernum}}" readonly >
                </div>

                 <label for="status_class" class="col-md-3 control-label" style="text-align:right;">Name:</label>
                <div class="col-md-4">
                  <input type="text" name="status_class" class="form-control" value="{{$version->name}}" readonly >
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
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('version_edit', $version->id)}}'">
                    <i class="glyphicon glyphicon-pencil"></i> 
                修改
                </button>
            </div>
            <div class="col-md-4" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('version_index')}}'">
              <i class="glyphicon glyphicon-backward"></i>
              返回
                </button>
            </div> 
            </div>
          
          <script>//彈出對話框確認 

          function Confirm()
          {
                  if(confirm("確認刪除此資料？")==true)   
                    window.location="{{URL::route('version_delete', $version->id)}}";
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


