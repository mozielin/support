@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增合約</h2>
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
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          新增合約</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{Auth::user()->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
    <div class="form-horizontal">
                <script>//彈出對話框確認
                  function Confirm()
                  {
                    if(confirm("確認新增此筆資料？")==true)   
                      return true;
                    else  
                      return false;
                  }   
                </script>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="/contract/upload" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">

                <label for="contract_title" class="col-md-2 control-label" style="text-align:right;">合約標題:</label>
                <div class="col-md-4">
                    <input type="text" name="contract_title" class=" col-md-4 form-control" style="width:100%;text-align:center" value="" placeholder="請輸入合約標題" required autofocus>
                </div>

                <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">合約方案:</label>
                
                    <div class="col-md-4">
                        <select name="contract_plan" class="form-control" style="padding-left:20px;">
                            @foreach ($plandata as $plan)
                                <option value="{{$plan->id}}">{{$plan->plan_name}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="form-group col-md-12 form-horizontal">
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                    <div class="col-md-4">
                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{$company->company_name}}" readonly required>
                        <input type="hidden" id="company_id" name="company_id" value="{{$company->id}}">
                    </div>
            
            <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
              <div class="col-md-4">
                <input type="text" id="company_EIN" name="company_EIN" class=" col-md-4 form-control" value="{{$company->company_EIN}}" readonly required>
                
             </div>

          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_start" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
              <div class="col-md-4">
                <input type="text" id="company_contract_start" name="company_contract_start" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_start') }}" placeholder="請選擇開始日期" required>               
              </div>
            
            <label for="company_contract_end" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" id="company_contract_end" name="company_contract_end" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_end') }}" placeholder="請選擇結束日期" required>           
              </div>

          </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="contract_price" class="col-md-2 control-label" style="text-align:right;">合約總價:</label>
            <div class="col-md-4">
            <input type="text" name="contract_price" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{ old('contract_price') }}" placeholder="請輸入合約總價">        
            </div>

            <label for="contract_quantity" class="col-md-2 control-label" style="text-align:right;">授權人數:</label>
            <div class="col-md-4">
            <input type="text" name="contract_quantity" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{ old('contract_quantity') }}" placeholder="請輸入授權人數" required>                
            </div>

        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="company_contract_date" class="col-md-2 control-label" style="text-align:right;">簽約日期:</label>
            <div class="col-md-4">
            <input type="text" id="company_contract_date" name="company_contract_date" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_date') }}" placeholder="請選擇簽約日期" required></div>

            <label for="company_contract_check" class="col-md-2 control-label" style="text-align:right;">驗收日期:</label>
            <div class="col-md-4">
            <input type="text" id="company_contract_check" name="company_contract_check" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_check') }}" placeholder="請選擇驗收日期">                
            </div>
        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="contract_status" class="col-md-2 control-label" style="text-align:right;">合約狀態:</label>
            <div class="col-md-4">
                <select class="form-control" style="padding-left:20px;" name="contract_status" required placeholder="請選擇合約狀態">              
                        @foreach ($status as $data)
                                <option value="{{$data->id}}">{{$data->status_name}}</option>
                        @endforeach
                    </select>               
            </div>

            <label for="company_contract_check" class="col-md-2 control-label">上傳附件:</label>
            <div class="col-md-4">
            <input type="file" multiple class="form-control" name='files[]' placeholder="上傳圖片" accept=".jpg, .jpeg, .png, .pdf" value="Upload">
            <input type="hidden" id="builder" name="builder" value="{{Auth::user()->id}}">
            </div>
        </div>

        <div class="form-group col-md-12 form-horizontal" >
        
                <label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
                <div class="col-md-10">

                  <textarea name="note" style="height:100px;" id="note" class=" col-md-4 form-control noresize " value="" placeholder="請輸入備註"></textarea>
                     <script type="text/javascript"> 
                       autosize($('#note'));
                      </script>
                </div>
              </div>


          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

              <div class="col-md-2 col-md-offset-2" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="history.back()">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div> 

              @if (Session::has('check_message'))
                <div class="alert alert-danger fade in" style="width:250px;position:absolute;right:190px;top:3px;text-align:center;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;
                </button>
                {{ Session::get('check_message') }}
                </div>
              @endif

              <div class="col-md-3 col-md-offset-5" style="text-align:center;">
                <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-check"></i>
                Submit
                </button>
              </div>
            </div>
           
          </div><!--區塊內容結束-->
        </form>
        </div>
      </div>
    </div><!--第一區塊結束-->

    
    </div>

           

    </div>
  </div>  

<script type="text/javascript">
  $(function(){
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
        });

        $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' }); //全局設置日期格式


</script>   

@endsection