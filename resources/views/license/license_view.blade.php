@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">License</h2>
@endsection
@section('contentm')
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block')
</div>
<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <!--最外框-->
  <div class="panel panel-default">
    <!--第一區塊-->
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px">
          <!--區塊標題-->
          <label for="id" class="col-md-2" style="text-align:left;">lic編號:
          {{$data->id}}</label>
          <label for="company_name" class="col-md-8 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          {{$data->lic_name}}</label>
          <label for="nothing" class="col-md-2" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">

          <div class="form-group col-md-12 form-horizontal"> 

            <label for="lic_name" class="col-md-2 control-label" style="text-align:right;">LicenseTitle:</label>
                <div class="col-md-4">
                    <input type="text" name="lic_name" class=" col-md-4 form-control" style="width:100%;text-align:center" value="{{$data->lic_name}}" readonly>
                </div>
            
            <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">Lic狀態:</label>
              <div class="col-md-4">
                <input type="text" name="contract_plan" class=" col-md-4 form-control" value="{{$data->status_name}}" readonly>
                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal"> 

            <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
              <div class="col-md-4">
                <input type="text" name="company_name" class=" col-md-4 form-control" value="{{$data->company_name}}" readonly>
              </div>
            
            <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
              <div class="col-md-4">
                <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{$data->company_EIN}}" readonly>
                
              </div>

          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_start" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
              <div class="col-md-4">
                <input type="text" name="company_contract_start" class=" col-md-4 form-control" value="{{$data->start_at}}" readonly >               
              </div>
            
            <label for="company_contract_end" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" name="company_contract_end" class=" col-md-4 form-control" value="{{$data->expir_at}}" readonly>           
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="builder" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
              <div class="col-md-4">
                <input type="text" name="builder" class=" col-md-4 form-control" value="{{$updateby}}" readonly>                
              </div>
              @if($data->lic_file != '0')
            <label for="lic_file" class="col-md-2 control-label" style="text-align:right;">附件內容: </label>
              
              <div class="col-md-4"><a href="{{$filepath}}" download="{{$data->lic_file}}" data-toggle="tooltip" data-placement="bottom" title="點此下載:{{$data->lic_file}}">
                <input type="text" name="lic_file" class="form-control" style="cursor:pointer;" value="{{$data->lic_file}}" readonly onclick="return Download();">
                </a>       
              </div>
              @endif

          </div>

      </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

        <div class="col-md-12" style="border-bottom: 2px solid;border-bottom-color:#d3e0e9;margin-bottom:10px;">
          
          <label for="display_name" class="col-md-4 control-label" style="text-align:center;">選購功能</label>
          <label for="tlc_start" class="col-md-4 control-label" style="text-align:center;">開始時間</label>
          <label for="tlc_end" class="col-md-4 control-label" style="text-align:center;">結束時間</label>
          </div>

             @foreach($ldata as $pedata)  
            <div class="form-group col-md-12 form-horizontal">
              @if($tlcdata != null && $data->company_name == $tlcdata->company_name)
              <div class="col-md-4">
                <input type="text" name="company_name" class=" col-md-4 form-control ColorOrange"  value="{{$pedata->function_name}}" readonly required>  
              </div>
              <div class="col-md-4">
                <input type="text" name="tlc_start" class=" col-md-4 form-control ColorOrange"  value="{{$tlcdata->company_tlc_start}}" readonly required>  
              </div>
              <div class="col-md-4">
                <input type="text" name="tlc_end" class=" col-md-4 form-control ColorOrange"  value="{{$tlcdata->company_tlc_end}}" readonly required>  
              </div>
              @else
                <div class="col-md-4">
                  <input type="text" name="display_name_{{$pedata->id}}" class=" col-md-4 form-control ColorOrange"  value="{{$pedata->function_name}}" readonly required>  
                </div>
              @endif
            </div>  

          @endforeach
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('license_delete', $data->id)}}";
                    else  
                      return false;
                  }

                  function Download()
                  {
                    if(confirm("確認下載此檔案？")==true)   
                        return true;
                    else  
                      return false;
                  }   

                </script>
              <div class="col-md-2" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                <i class="glyphicon glyphicon-trash"></i>
                刪除
                </button>
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
              @role('nono')
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('license_edit', $data->id)}}'">
                <i class="glyphicon glyphicon-pencil"></i>
                修改
                </button>
              @endrole       
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('license_index')}}'">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div>
           
          </div><!--區塊內容結束-->
        </div>
      </div>
    </div><!--第一區塊結束-->

    </div>
  </div>           
@endsection