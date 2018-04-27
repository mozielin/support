@extends('layouts.master')
@section('contentm')

<div class="container" style="width:780px;height:80px;margin-right:218px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;">User Info    
          </div>      
            <div class="panel-body">
             
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                @if($license == null ){
                <div class="col-md-2  ">
                  <button type="button" class="btn btn-primary" onclick="location.href=''">
                    Lic管理
                  </button>
                </div>
                }
                @elseif{
                
              </div>
              <div class="col-md-2  ">
                <button type="button" class="btn btn-primary" onclick="location.href=''">
                  刪除
                </button>
              </div>

              <div class="col-md-2 col-md-offset-8" >
                <button type="button" class="btn btn-primary" style="float:right" onclick="location.href=''">
                  修改
                </button>
              </div>}
                     
              
                 
              @endif 
        </div>
      </div>
    </div>
  </div>
</div>  
                        


@endsection


