@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改合約內容</h2>
@endsection
@section('contentm')
<!--中間選單-->
    <div class="container" style="width:780px;height:75px;margin-right:218px;">
        @include('layouts.center_block')
    </div>
<!--最外框-->
<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <div class="panel panel-default">
<!--第一區塊-->
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px">
    <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;">合約編號:
          {{$data->id}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          修改合約內容</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
    <div class="form-horizontal">
                <script>//彈出對話框確認
                  function Confirm()
                  {
                    if(confirm("確認修改此筆資料？")==true)   
                      return true;
                    else  
                      return false;
                  }   
                </script>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="{{ route('contract_update',$data->id) }}" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">

                <label for="contract_title" class="col-md-2 control-label" style="text-align:right;">合約名稱:</label>
                <div class="col-md-4">
                    <input type="text" name="contract_title" class=" col-md-4 form-control" style="width:100%;text-align:center" value="{{$data->contract_title}}" required autofocus>
                </div>

                <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">合約方案:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="contract_plan">
                        @foreach ($plandata as $sdata)                                
                            @if($data->contract_plan == $sdata->id)
                            //如果迴圈的產業別ID符合公司產業別ID則預設選取
                            <option selected="true" value="{{$sdata->id}}">{{$sdata->plan_name}} </option>
                            @else
                            //如果不符合就跑一般選項
                            <option value="{{$sdata->id}}">{{$sdata->plan_name}} </option>
                            @endif
                        @endforeach
                    </select>      
                </div>
            </div>

            <div class="form-group col-md-12 form-horizontal">
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                <div class="col-md-4">
                    <input type="text" name="company_name" class=" col-md-4 form-control" value="{{$data->company_name}}" readonly required>
                </div>
            
            <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
              <div class="col-md-4">
                <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{$data->company_EIN}}" readonly required>
                
             </div>

          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_start" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
              <div class="col-md-4">
                <input type="text" id="company_contract_start" name="company_contract_start" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" placeholder="請選擇開始日期" value="{{$data->company_contract_start}}" required>               
              </div>
            
            <label for="company_contract_end" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" id="company_contract_end" name="company_contract_end" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" placeholder="請選擇結束日期" value="{{$data->company_contract_end}}" required>           
              </div>

          </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="contract_price" class="col-md-2 control-label" style="text-align:right;">合約金額:</label>
            <div class="col-md-4">
            <input type="text" name="contract_price" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->contract_price}}">        
            </div>

            <label for="contract_quantity" class="col-md-2 control-label" style="text-align:right;">授權數:</label>
            <div class="col-md-4">
            <input type="text" name="contract_quantity" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{$data->contract_quantity}}" required>                
            </div>

        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_date" class="col-md-2 control-label" style="text-align:right;">簽約日期:</label>
            <div class="col-md-4">
            <input type="text" id="company_contract_date" name="company_contract_date" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$data->company_contract_date}}" placeholder="請選擇簽約日期" required></div>

            <label for="company_contract_check" class="col-md-2 control-label" style="text-align:right;">驗收日期:</label>
            <div class="col-md-4">
            <input type="text" id="company_contract_check" name="company_contract_check" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$data->company_contract_check}}" placeholder="請選擇驗收日期" >                
            </div>
        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="contract_update" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
            <div class="col-md-4">
              <input type="text" name="contract_updates" class=" col-md-4 form-control" value="{{Auth::user()->name}}" readonly required>    
              <input type="hidden" name="contract_update" value="{{Auth::user()->id}}">            
            </div>

            <label for="company_contract_check" class="col-md-2 control-label">合約狀態:</label>
            <div class="col-md-4">
            <select class="form-control" style="padding-left:20px;" name="contract_status">
                        @foreach ($status as $sdata)                                
                            @if($data->contract_status == $sdata->id)
                            //如果迴圈的產業別ID符合公司產業別ID則預設選取
                            <option selected="true" value="{{$sdata->id}}">{{$sdata->status_name}} </option>
                            @else
                            //如果不符合就跑一般選項
                            <option value="{{$sdata->id}}">{{$sdata->status_name}} </option>
                            @endif
                        @endforeach
                    
                    </select>
            
            </div>
            </div>

            <div class="form-group col-md-12 form-horizontal">

              <label for="contract_upload" class="col-md-2 control-label" style="text-align:right;"></label>
            <div class="col-md-4">
              <input type="hidden"  value="">            
            </div>

              <label for="contract_upload" class="col-md-2 control-label" style="text-align:right;">上傳附件:</label>
            <div class="col-md-4">
              <input type="file" multiple class="form-control" name='files[]' placeholder="上傳圖片" accept=".jpg, .jpeg, .png, .pdf" value="Upload">            
            </div>

            </div>

            <div class="form-group col-md-12 form-horizontal" >
        
                <label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
                <div class="col-md-10">

                  <textarea name="note" style="height:100px;" id="note" class=" col-md-4 form-control noresize " value="{{$data->note}}">{{$data->note}}</textarea>
                     <script type="text/javascript"> 
                       autosize($('#note'));
                      </script>
                </div>
              </div>

        

    </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

              <div class="col-md-2 col-md-offset-2" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('contract_view', $data->id)}}'">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div> 

              <div class="col-md-3 col-md-offset-5" style="text-align:center;">
                <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-check"></i>
                確認修改
                </button>
              </div>
           
          </div><!--區塊內容結束-->
          </form>
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

                    <div class="col-md-1" style="border-right:1px solid black;">  
                        ID
                      </div>
                    
                    <div class="col-md-7" style="border-right:1px solid black;">  
                        檔案名稱
                      </div>  

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        Uploadby
                      </div>
                    <div class="col-md-2" style="border-right:1px solid black;">  
                        功能
                    </div>                 
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($contract_file as $data)
            <div class="panel panel-default test" style="cursor:pointer;" >
              <div class="panel-heading " style="height:100%;">       
                <div class="row" style="text-align:center;">

                  <div class="col-md-1" style="height:35px;padding-top:10px;border-right:1px solid black;" onclick="window.open('{{route('contract_show', $data->file_name, $data->id)}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->id}}
                  </div>

                  <div class="col-md-7" style="height:35px;padding-top:10px;border-right:1px solid black;" onclick="window.open('{{route('contract_show', $data->file_name, $data->id)}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->file_name}} 
                  </div>

                  <div class="col-md-2" style="height:35px;padding-top:10px;border-right:1px solid black;" onclick="window.open('{{route('contract_show', $data->file_name, $data->id)}}','合約內容',config = 'height=900,width=1200,location=no');">  
                    {{$data->name}}  
                  </div>

                  <script>//彈出對話框確認 
                  function delConfirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('contract_filedelete', $data->id)}}";
                    else  
                      return false;
                  }   

                </script>

                  <div class="col-md-2" style="border-right:1px solid black;" >  
                    <button type="button" class="btn btn-primary" style="z-index:1;" onclick="location.href='{{route('contract_filedelete', $data->id)}}'">
                      <i class="glyphicon glyphicon-trash"></i>
                        刪除
                    </button> 
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

              var today = new Date();
              var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

                $('#company_contract_date').datepicker();
                $('#company_contract_check').datepicker();
                $('#company_contract_end').datepicker();

                $('#company_contract_start').datepicker({
                //minDate: 0, //從今天後日期才可選
                  minDate: tomorrow, //從明天日期才可選
                  onSelect: function (dat, inst) {
                  $('#company_contract_end').datepicker('option', 'minDate', dat);
                  }
                });

                  $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' }); //全局設置日期格式

            });
            </script>

    </div>
  </div>     

@endsection