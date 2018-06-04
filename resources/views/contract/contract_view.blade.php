@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">合約內容</h2>
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
          <label for="id" class="col-md-2" style="text-align:left;">ID:
          {{$data->id}}</label>
          <label for="company_name" class="col-md-8 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          {{$data->contract_title}}</label>
          <label for="nothing" class="col-md-2" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">

          <div class="form-group col-md-12 form-horizontal"> 

            <label for="contract_title" class="col-md-2 control-label" style="text-align:right;">合約標題:</label>
              <div class="col-md-4">
                <input type="text" name="contract_title" class=" col-md-4 form-control" value="{{$data->contract_title}}" readonly>
              </div>
            
            <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">合約方案:</label>
              <div class="col-md-4">
                <input type="text" name="contract_plan" class=" col-md-4 form-control" value="{{$data->plan_name}}" readonly>
                
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
                <input type="text" name="company_contract_start" class=" col-md-4 form-control" value="{{$data->company_contract_start}}" readonly >               
              </div>
            
            <label for="company_contract_end" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" name="company_contract_end" class=" col-md-4 form-control" value="{{$data->company_contract_end}}" readonly>           
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="contract_price" class="col-md-2 control-label" style="text-align:right;">合約金額:</label>
              <div class="col-md-4">
                <input type="text" name="contract_price" class=" col-md-4 form-control" value="{{$data->contract_price}}" readonly>        
              </div>

            <label for="contract_quantity" class="col-md-2 control-label" style="text-align:right;">授權人數:</label>
              <div class="col-md-4">
                <input type="text" name="contract_quantity" class=" col-md-4 form-control" value="{{$data->contract_quantity}}" readonly>                
              </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_date" class="col-md-2 control-label" style="text-align:right;">簽約日期:</label>
              <div class="col-md-4">
              <input type="text" name="company_contract_date" class=" col-md-4 form-control" value="{{$data->company_contract_date}}" readonly></div>

            <label for="company_contract_check" class="col-md-2 control-label" style="text-align:right;">驗收日期:</label>
            <div class="col-md-4">
              <input type="text" name="company_contract_check" class=" col-md-4 form-control" value="{{$data->company_contract_check}}" readonly>                
            </div>
          </div>

          <div class="form-group col-md-12 form-horizontal">

            <label for="contract_status" class="col-md-2 control-label" style="text-align:right;">合約狀態:</label>
              <div class="col-md-4">
              <input type="text" name="contract_status" class=" col-md-4 form-control" value="{{$data->status_name}}" readonly></div>

            <label for="contract_update" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
            <div class="col-md-4">
              <input type="text" name="contract_update" class=" col-md-4 form-control" value="{{$updateby}}" readonly>                
            </div>
          </div>

          <div class="form-group col-md-12 form-horizontal" >
        
                <label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
                <div class="col-md-10">

                  <textarea name="note" style="height:100px;" id="note" class=" col-md-4 form-control noresize " value="" readonly >{{$data->note}}</textarea>
                     <script type="text/javascript"> 
                       autosize($('#note'));
                      </script>
                </div>
              </div>

      </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('contract_delete', $data->id)}}";
                    else  
                      return false;
                  }   

                </script>
                
              <div class="col-md-2" style="text-align:center;">
              @permission('contract_delete')
                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                <i class="glyphicon glyphicon-trash"></i>
                刪除
                </button>
                @endpermission
              </div>
                
              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
              @permission('contract_edit')
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('contract_edit', $data->id)}}'">
                <i class="glyphicon glyphicon-pencil"></i>
                修改
                </button>
                @endpermission
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('contract_index')}}'">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div>
           
          </div><!--區塊內容結束-->
        </div>
      </div>
    </div><!--第一區塊結束-->

    <!--第二區塊-->
    <div id="accordion2">
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$filenum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        附件列表
    </h3>
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px;padding-top:2px;">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;padding-top:10px;"></label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px; ">
          附件列表</label>
              
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;"">

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        ID
                      </div>
                    
                    <div class="col-md-6" style="border-right:1px solid black;">  
                        檔案名稱
                      </div>  

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        Uploadby
                      </div>

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        下載
                      </div>   
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container col-md-12" style="width:100%;height:100%;margin-right:218px;">
            @foreach($contract_file as $data)
            <div class="panel panel-default test" style="cursor:pointer;" >
            
              <div class="panel-heading " style="height:100%;">       
                <div class="row" style="text-align:center;">

                  <div class="col-md-2" style="border-right:1px solid black;height:36px;padding-top:8px;"onclick="window.open('/storage/contract/{{$data->origin_file}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->id}}
                  </div>

                  <div class="col-md-6" style="border-right:1px solid black;height:36px;padding-top:8px;"onclick="window.open('/storage/contract/{{$data->origin_file}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->file_name}} 
                  </div>

                  <div class="col-md-2" style="border-right:1px solid black; height:36px;padding-top:8px;"onclick="window.open('/storage/contract/{{$data->origin_file}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->name}}  
                  </div>
                  <div class="col-md-2" style="text-align:center;border-right:1px solid black;z-index:100;">
                <a href="/storage/contract/{{$data->origin_file}}" download="{{$data->file_name}}" data-toggle="tooltip" data-placement="bottom" title="點此下載附件">
                <button type="button" style="width:80px;" class="btn btn-primary" onclick="return Download();">
                <i class="glyphicon glyphicon-download-alt"></i>
                </button>
                </a>
              </div> 

                  </div>                      
              </div>
                 
            </div>
    
            @endforeach
          </div>

        </div><!--區塊內容結束-->
        </div>
      </div><!--第二區塊結束-->
    </div>

            <script>

                function Download()
                  {
                    if(confirm("確認下載此檔案？")==true)   
                        return true;
                    else  
                      return false;
                  }

              $( function() {

              $( "#accordion" ).accordion({

                active:false,
                collapsible: true

              });

              $( "#accordion2" ).accordion({

                collapsible: true

              });

              $( "#accordion3" ).accordion({

                active:false,
                collapsible: true

              });


            } );
            </script>

    </div>
  </div>           
@endsection
