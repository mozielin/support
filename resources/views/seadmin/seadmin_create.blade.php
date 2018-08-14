@extends('layouts.master')
    @section('title')
        <h2 style="margin-top:2px;">新增提醒</h2>
    @endsection
@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.user_center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
	
        <div class="panel-heading">
                <div class="panel-heading">新增提醒</div>
				 <!--區塊標題-->
                <div class="panel-heading" style="text-align:center; height:40px">              
                    <label for="id" class="col-md-3" style="text-align:left;">ID:
                    New</label>
                    <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    <a href="{{route('company_view',$company->id)}}">
                    {{$company->company_name}}</a></label>
                    <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{Auth::user()->name}}</label>
                </div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('seadmin_store') }}">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12 form-horizontal"> 
							<label for="alert_type" class="col-md-2 control-label" style="text-align:right;">提醒類別:</label>
							<div class="col-md-4">
							  <input type="text" name="alert_type" class=" col-md-4 form-control" value="" placeholder="請輸入類別">
							  <input type="hidden" name="company_name" class=" col-md-4 form-control" value="{{$company->company_name}}" >
							  <input type="hidden" name="com_id" class=" col-md-4 form-control" value="{{$company->id}}" >
							</div>  
									
							<label for="alert_title" class="col-md-2 control-label" style="text-align:right;">提醒標題:</label>
							<div class="col-md-4">
							  <input type="text" name="alert_title" class=" col-md-4 form-control" value="{{ old('alert_title') }}" placeholder="請輸入提醒標題" autofocus >                   
							</div>
						 </div> 

                       <div class="form-group col-md-12 form-horizontal">

							<label for="company_tlc_start" class="col-md-2 control-label" style="text-align:right;">開始日期:</label>
							  <div class="col-md-4">
								<input type="text" id="company_tlc_start" name="company_tlc_start" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_start') }}" placeholder="請選擇開始日期" required>               
							  </div>
							
							<label for="company_tlc_end" class="col-md-2 control-label" style="text-align:right;">結束日期:</label>
							  <div class="col-md-4">
								<input type="text" id="company_tlc_end" name="company_tlc_end" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{ old('company_contract_end') }}" placeholder="請選擇結束日期" required>           
							  </div>

						</div>
						  
						<div class="form-group col-md-12 form-horizontal" >
        
							<label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
							<div class="col-md-10">

							  <textarea name="alert_note" style="height:100px;" id="alert_note" class=" col-md-4 form-control noresize " value="" placeholder="請輸入備註"></textarea>
								 <script type="text/javascript"> 
								   autosize($('#note'));
								  </script>
							</div>
						</div> 
						 
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">


                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-5" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-check"></i>
                                    確定送出
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
 $(function(){
            var today = new Date();
            var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

            $('#company_tlc_end').datepicker();

            $('#company_tlc_start').datepicker({
            //minDate: 0, //從今天後日期才可選
              minDate: tomorrow, //從明天日期才可選
                onSelect: function (dat, inst) {
                  $('#company_tlc_end').datepicker('option', 'minDate', dat);
                }
            });
        });

        $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' }); //全局設置日期格式


</script>

@endsection
