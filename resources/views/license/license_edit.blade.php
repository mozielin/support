@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">修改License</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;">Lic編號:
          {{$data->id}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9;">
          修改License</label>
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
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="{{ route('license_update',$data->id) }}" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">

                <label for="lic_name" class="col-md-2 control-label" style="text-align:right;">LicenseTitle:</label>
                <div class="col-md-4">
                    <input type="text" name="lic_name" class=" col-md-4 form-control" style="width:100%;text-align:center" value="{{$data->lic_name}}" required autofocus>
                </div>

                <label for="status_name" class="col-md-2 control-label" style="text-align:right;">Lic狀態:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:70px;" name="status_id">
                        @foreach ($statusdata as $sdata)                                
                            @if($data->status_id == $sdata->id)
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
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                <div class="col-md-4">
                    <input type="text" name="company_name" id="company_name" class=" col-md-4 form-control" value="{{$data->company_name}}" readonly>
                </div>
            
            <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
              <div class="col-md-4">
                <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{$data->company_EIN}}" readonly>
                
             </div>

          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="start_at" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
              <div class="col-md-4">
                <input type="text" id="start_at" name="start_at" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$data->start_at}}" placeholder="請選擇開始日期" required>               
              </div>
            
            <label for="expir_at" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
              <div class="col-md-4">
                <input type="text" id="expir_at" name="expir_at" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$data->expir_at}}" placeholder="請選擇結束日期" required>           
              </div>

          </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="update_id" class="col-md-2 control-label" style="text-align:right;">Updateby:</label>
            <div class="col-md-4">
              <input type="text" name="updateby" class=" col-md-4 form-control" value="{{Auth::user()->name}}" readonly>    
              <input type="hidden" name="update_id" value="{{Auth::user()->id}}">            
            </div>

            <label for="lic" class="col-md-2 control-label">上傳附件:</label>
            <div class="col-md-4">
            <input type="file" multiple class="form-control" name='lic' placeholder="上傳Lic" accept=".tpls" value="Upload">
            
            </div>
        </div>
        
    </div>

    <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

        <div class="col-md-12" style="border-bottom: 2px solid;border-bottom-color:#d3e0e9;margin-bottom:10px;">
          <label for="display_name" class="col-md-offset-2 col-md-2 control-label" style="text-align:right;">選購功能:</label>
          <label for="display_name" class="col-md-offset-3 col-md-2 col-md-offset-1 control-label" style="text-align:center;">Name</label>
          </div>

            @foreach($function as $pedata)  
            <div class="form-group col-md-12 form-horizontal">

              <div class="col-md-offset-2 col-md-2">
                <input type="radio" name="{{$pedata->id}}" id="{{$pedata->id}}" class=" col-md-2 form-control ColorOrange"  value="{{$pedata->id}}">
              </div>

              <div class="col-md-offset-2 col-md-4">
                <input type="text" name="display_name_{{$pedata->id}}" class=" col-md-4 form-control ColorOrange"  value="{{$pedata->function_name}}" readonly required>  
              </div>

            </div>  

          
          @foreach($ldata as $lfdata)
          @if($pedata->id == $lfdata->pivot->function_id)
            <script type="text/javascript">
              $().ready(function () {
                  $('#{{$pedata->id}}').attr('checked', true);
                  $('#{{$pedata->id}}').attr('checkSelect', 'Y');
               
              });
            </script>
          @endif 
          @endforeach
          
          @endforeach

          <div id="TLC" style="display:none;">

          <div class="col-md-12" style="border-bottom: 2px solid;border-bottom-color:#d3e0e9;margin-bottom:10px;">
          <label for="display_name" class="col-md-2 control-label" style="text-align:right;">TLC設定:</label>
          </div>

          <div class="form-group{{ $errors->has('tlc_company_name') ? ' has-error' : '' }}">
                            <label for="tlc_company_name" class="col-md-3 col-md-offset-1 control-label">公司名稱</label>

                            <div class="col-md-5">
                                <input id="tlc_company_name" type="text" class="form-control" name="tlc_company_name" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_tlc_start') ? ' has-error' : '' }}">
                            <label for="company_tlc_start" class="col-md-3 col-md-offset-1 control-label">TLC開始時間</label>

                            <div class="col-md-5">
                                <input id="company_tlc_start" type="text" class="form-control" style="padding-left: 0px;" name="company_tlc_start" value="" placeholder="請選擇開始日期" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_tlc_end') ? ' has-error' : '' }}">
                            <label for="company_tlc_end" class="col-md-3 col-md-offset-1 control-label">TLC關閉時間</label>

                            <div class="col-md-5">
                                <input id="company_tlc_end" type="text" class="form-control" style="padding-left: 0px;" name="company_tlc_end" value="" placeholder="請選擇關閉日期" >
                            </div>
                        </div>
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">
          </div>
          
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

              <div class="col-md-2 col-md-offset-2" style="text-align:center;">
                <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-check"></i>
                確認修改
                </button>
              </div> 

              <div class="col-md-3 col-md-offset-5" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="history.back()">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div>
           
          </div><!--區塊內容結束-->
          </form>
        </div>
      </div>
    </div><!--第一區塊結束-->

    </div>
  </div>     

  <script type="text/javascript">
       $().ready(function () {

        if ($('#1').attr('checkSelect') == 'Y'){
                  $('#TLC').fadeIn(500);
               }
               else{
                  $('#TLC').fadeOut(300);
               }

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
               }
               else{
                  $('#TLC').fadeOut(300);
               }
           });
       });
</script>

<script type="text/javascript">
  $('#company_name').ready(function(){               
    $value = $('#company_name').val();
    $.ajax({
    type : 'get',
    url : '{!!URL::route('seadmin_tlc')!!}',
    data : {'seadmin_tlc' : $value},
      success : function(data){
      console.log(data[0].name);
      $('#tlc_company_name').val(data[0].name);
      $('#company_tlc_start').val(data[0].start);
      $('#company_tlc_end').val(data[0].end);
      }
    })
  })

        $(function(){
            var today = new Date();
            var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

            
            $('#expir_at').datepicker();
            $('#company_tlc_end').datepicker();

            $('#company_tlc_start').datepicker({
            //minDate: 0, //從今天後日期才可選
              minDate: tomorrow, //從明天日期才可選
                onLoad: function (dat, inst) {
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