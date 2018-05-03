@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增License</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;">New
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          New License</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{Auth::user()->name}}</label>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="/license/upload_store" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">

                <label for="lic_name" class="col-md-2 control-label" style="text-align:right;">LicenseTitle:</label>
                <div class="col-md-4">
                    <input type="text" name="lic_name" class=" col-md-4 form-control" style="width:100%;text-align:center" value="{{$lic_name}}" placeholder="請輸入License Title" required readonly>
                </div>

                <label for="status_id" class="col-md-2 control-label" style="text-align:right;">Lic狀態:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:60px;" name="status_id" id="status_id" required placeholder="請選擇License狀態" readonly>              
                            @foreach ($status as $data)
                                    <option value="{{$data->id}}">{{$data->status_name}}</option>
                            @endforeach
                        </select>               
                </div>
            </div>

            <div class="form-group col-md-12 form-horizontal">
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                    <div class="col-md-4">
                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{$company_name}}" required readonly>
                        <input type="hidden" id="company_id" name="company_id" value="{{$company_id}}">
                        
                    </div>
            
            <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
              <div class="col-md-4">
                <input type="text" id="company_EIN" name="company_EIN" class=" col-md-4 form-control" value="{{$company_EIN}}" readonly required>
                
             </div>

          </div>

          <div class="form-group col-md-12 form-horizontal">
                <label for="plan_name" class="col-md-2 control-label" style="text-align:right;">合約方案:</label>
                    <div class="col-md-4">
                        <input id="plan_name" type="text" class="form-control" name="plan_name" style="text-align: center;"  value="{{$contract->plan_name}}" readonly>
                        
                    </div>
            
            <label for="status_name" class="col-md-2 control-label" style="text-align:right;">合約狀態:</label>
              <div class="col-md-4">
                <input type="text" id="status_name" name="status_name" class=" col-md-4 form-control"  value="{{$contract->status_name}}" readonly>
                
             </div>

          </div>

    
          <div class="form-group col-md-12 form-horizontal" @if($clientlimit > $contract->contract_quantity){
          style="text-align:right;background-color:red;"
          }@endif>
                <label for="contract_quantity" class="col-md-2 control-label" style="text-align:right;">合約人數:</label>
                    <div class="col-md-4">
                        <input id="contract_quantity" type="text" class="form-control" name="contract_quantity" style="text-align: center;"  value="{{$contract->contract_quantity}}" readonly>
                        
                    </div>
            
            <label for="clientlimit" class="col-md-2 control-label" style="text-align:right;">Lic人數:</label>
              <div class="col-md-4">
                <input type="text" id="clientlimit" name="clientlimit" class=" col-md-4 form-control"  value="{{$clientlimit}}" readonly>
                
             </div>

          </div>

          
          <div class="form-group col-md-12 form-horizontal">

            <label for="start_at" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
              <div class="col-md-4">
                <input type="text" id="start_at" name="start_at" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$start}}" placeholder="請選擇開始日期" required readonly="">               
              </div>
            
            <label for="expir_at" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" id="expir_at" name="expir_at" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$end}}" placeholder="請選擇結束日期" required readonly="">           
              </div>

          </div>


        <div class="form-group col-md-12 form-horizontal">

            <label for="updateby" class="col-md-2 control-label" style="text-align:right;">上傳檔案:</label>
              <div class="col-md-4">
                <input type="text" id="filename" name="filename" class=" col-md-4 form-control"  value="{{$filename}}" readonly>
                
             </div>

            <label for="lic" class="col-md-2 control-label"></label>
            <div class="col-md-4" style="text-align:center;">

            @if($clientlimit > $contract->contract_quantity)
              <div class="alert alert-danger ">
                  <ul>
                      {{"授權人數不符合"}}
                  </ul>
              </div>
            @endif

            <input type="hidden" id="origin_file" name="origin_file" value="{{$filepath}}">
            <input type="hidden" id="builder_id" name="builder_id" value="{{Auth::user()->id}}">
            </div>
        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="updateby" class="col-md-2 control-label" style="text-align:right;">UpdateBy:</label>
              <div class="col-md-4">
                <input type="text" id="updateby" name="updateby" class=" col-md-4 form-control"  value="None" readonly>
                
             </div>

            <label for="lic" class="col-md-2 control-label"></label>
            <div class="col-md-4" style="text-align:center;">

            <button id="cancel" type="button" class="btn btn-primary" onclick="location.href='{{route('license_cancel',['id' => $company_id, 'filepath' => $filepath ])}}'">

                重新上傳
            </button>
            <input type="hidden" id="builder_id" name="builder_id" value="{{Auth::user()->id}}">
            </div>
        </div>
        <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

        <div class="panel panel-default" >
    <div class="panel-heading " style="height:100%;">       
      <div class="row" style="text-align:center;">

      <div class="col-md-2" style=" border-left:1px solid black;"> 
          啟用
        </div>
      
      <div class="col-md-4" style="border-left:1px solid black;">  
          名稱
        </div>  

      <div class="col-md-3" style="border-left:1px solid black;">  
          開始日期
        </div>

      <div class="col-md-3" style="border-right:1px solid black;border-left:1px solid black;">  
          結束日期
        </div> 
          
      </div>                      
    </div>    
  </div>
          

      <div class="container" style="width:103%;height:100%;margin-right:218px;">
        @foreach($function as $fkey => $pedata)
          <div class="panel panel-default test">
            <div class="panel-heading">
              <div class="row" style="text-align:center;">
                <div class="col-md-2" style="border-left:1px solid black;">
                  @if($pedata->select == '1')
                    <input type="radio" name="{{$pedata->id}}" id="{{$pedata->id}}" class=" col-md-2 form-control ColorOrange"  value="{{$pedata->id}}">  
                  @else
                    @foreach($modarray as $mkey => $modata)
                      @if($modata['mod'] == $pedata->code)
                      {{$modata['mod']}}
                        <i class="glyphicon glyphicon-ok-sign" style="margin-right:10px;"></i>
                        @break
                      @else 
                        @continue 
                      @endif
                    @endforeach 
                  @endif 
                </div>
                <div class="col-md-4" style="border-left:1px solid black;">
                  <input type="text" name="display_name_{{$pedata->id}}" class=" col-md-4 form-control ColorOrange"  value="{{$pedata->function_name}}" readonly required>  
                </div>
                
                  @if($pedata->select == '1' && $pedata->code == 'F01')
                  <div id="TLC" class="col-md-6" style="display:none;" >
                    <input id="tlc_company_name" type="hidden" class="form-control" name="tlc_company_name" value="{{$company_name}}" readonly>
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}" readonly>
                    <div class="col-md-6" style="text-align:center;border-left:1px solid black;">
                      <input id="company_tlc_start" type="text" class="form-control" style="padding-left: 0px;" name="company_tlc_start" value="{{ old('company_tlc_start') }}" maxDate="" placeholder="請選擇開始日期" >
                        @if ($errors->has('company_tlc_start'))
                          <span class="help-block">
                            <strong>{{ $errors->first('company_tlc_start') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="col-md-6" style="text-align:center;border-right:1px solid black;border-left:1px solid black;">
                      <input id="company_tlc_end" type="text" class="form-control" style="padding-left: 0px;" name="company_tlc_end" value="{{ old('company_tlc_end') }}" placeholder="請選擇關閉日期" >
                        @if ($errors->has('company_tlc_end'))
                          <span class="help-block">
                            <strong>{{ $errors->first('company_tlc_end') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>
                  @else
                  <div class="col-md-6" style="text-align:center;">
                    @foreach($modarray as $mkey => $modata)
                      @if($modata['mod'] == $pedata->code)
                        <div class="col-md-6" style="text-align:center;border-left:1px solid black;">
                          {{$modata['0']}}
                        </div>
                        <div class="col-md-6" style="text-align:center;border-right:1px solid black;border-left:1px solid black;">
                          {{$modata['1']}}
                        </div>
                        @break
                      @else 

                        @continue 
                        
                      @endif
                    @endforeach  
                  </div>
                  @endif   
               

              </div>
            </div>
          </div>    
        @endforeach
      </div>  
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

              <div class="col-md-2 col-md-offset-1" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="history.back()">
                返回
                </button>
              </div> 

              <div class="col-md-3 col-md-offset-5" style="text-align:center;">

              @if($clientlimit <= $contract->contract_quantity)
                <button type="submit" class="btn btn-primary">
                Submit
                </button>
              @endif

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
$('#company_name').autocomplete({
source : '{!!URL::route('license_auto') !!}',
autoFocos : true,
select : function(e,ui){
//alert(ui.item.EIN);
console.log(ui);
$('#company_name').val(ui.item.value);
$('#tlc_company_name').val(ui.item.value);
$('#company_id').val(ui.item.id);
$('#company_EIN').val(ui.item.EIN);
$('#plan_name').val(ui.item.plan_name);
$('#status_name').val(ui.item.status_name);


}
});
</script>

<script type="text/javascript">

        $('#cancel').on('click',function(){
          $.post('/license/cancel' + {$num}, function(response) {
            // handle your response here
            console.log(response);
          })
        })

       $().ready(function () {
       //radio點擊2次取消
           //請幫radioButton加入checkSelect='N' 的屬性，若是已被選取的加上checkSelect='Y'
           $('input[type=radio]').click(function () {
               
               if ($(this).attr('checkSelect') == 'Y') {
                   $(this).attr('checked', false);
                   $(this).attr('checkSelect', 'N');
               }
               else {
                   $(this).attr('checked', true);
                   $(this).attr('checkSelect', 'Y');
               }

               if ($('#1').attr('checkSelect') == 'Y'){
                  $('#TLC').fadeIn(500);
                  $('#tlc_company_name').attr('required', true);
                  $('#company_tlc_start').attr('required', true);
                  $('#company_tlc_end').attr('required', true);

               }
               else{
                  $('#TLC').fadeOut(300);
                  $('#tlc_company_name').attr('required', false);
                  $('#company_tlc_start').attr('required', false);
                  $('#company_tlc_end').attr('required', false);
               }
           });

       });

        $(function(){
            var today = new Date();
            var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

            
            $('#expir_at').datepicker();
            $('#company_tlc_end').datepicker();

            $('#company_tlc_start').datepicker({
            //minDate: 0, //從今天後日期才可選
              minDate: tomorrow, //從明天日期才可選
                onSelect: function (dat, inst) {
                  $('#company_tlc_end').datepicker('option', 'minDate', dat);
                }
            });

            $('#start_at').datepicker({
            //minDate: 0, //從今天後日期才可選
              minDate: tomorrow, //從明天日期才可選
                onSelect: function (dat, inst) {
                  $('#expir_at').datepicker('option', 'minDate', dat);
                }
            });
        });

        $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' }); //全局設置日期格式

</script>




@endsection