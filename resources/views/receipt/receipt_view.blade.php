@extends('layouts.master')
    @section('title')
        <h2 style="margin-top:2px;">發票瀏覽</h2>
    @endsection
@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.user_center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
	
        <div class="panel-heading">
                <div class="panel-heading">發票瀏覽</div>
				 <!--區塊標題-->
                <div class="panel-heading" style="text-align:center; height:40px">              
                    <label for="id" class="col-md-3" style="text-align:left;">ID:
                    New</label>
                    <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    <a href="{{route('company_view',$data->company_id)}}">
                    {{$data->company_name}}</a></label>
                    <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
                </div>
                <div class="panel-body">

                         <div class="form-group col-md-12 form-horizontal">

                            <label for="contract_title" class="col-md-2 control-label" style="text-align:right;">合約標題:</label>
                              <div class="col-md-4">
                                <input type="text" name="contract_title" class=" col-md-4 form-control" value="{{$data->contract_title}}" readonly>                 
                              </div>
                            
                            <label for="rcpdate" class="col-md-2 control-label" style="text-align:right;">發票日期:</label>
                              <div class="col-md-4">
                                <input type="text" id="rcpdate" name="rcpdate" class=" col-md-4 form-control" style="width: 100%;text-align: center;padding-left:0px;" value="{{$data->rcpdate}}" readonly>           
                              </div>

                        </div>

                        <div class="form-group col-md-12 form-horizontal"> 
							<label for="rcpnum" class="col-md-2 control-label" style="text-align:right;">發票號碼:</label>
							<div class="col-md-4">
							  <input type="text" name="rcpnum" class=" col-md-4 form-control" value="{{$data->rcpnum}}"  readonly>
							</div>  
									
							<label for="price" class="col-md-2 control-label" style="text-align:right;">發票金額:</label>
							<div class="col-md-4">
							  <input type="text" name="price" class=" col-md-4 form-control" value="{{$data->price}}" readonly>                   
							</div>
						 </div> 
						  
						<div class="form-group col-md-12 form-horizontal" >
        
							<label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
							<div class="col-md-10">

							  <textarea name="note" style="height:100px;" id="alert_note" class=" col-md-4 form-control noresize " value="" readonly>{{$data->note}}</textarea>
								 <script type="text/javascript"> 
								   autosize($('#note'));
								  </script>
							</div>
						</div> 
						 
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">


                        <div class="form-group">
                              <div class="col-md-2" style="text-align:center;">
                              @permission('contract_delete')
                                <button type="button" class="btn btn-primary" onclick="return Confirm();">
                                <i class="glyphicon glyphicon-trash"></i>
                                刪除
                                </button>
                                @endpermission
                              </div>

                              <script>//彈出對話框確認 
                                  function Confirm()
                                  {
                                    if(confirm("確認刪除此資料？")==true)   
                                      window.location="{{URL::route('receipt_delete', $data->id)}}";
                                    else  
                                      return false;
                                  }   

                              </script>
                                
                              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                              @permission('contract_edit')
                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('receipt_edit', $data->id)}}'">
                                <i class="glyphicon glyphicon-pencil"></i>
                                修改
                                </button>
                                @endpermission
                              </div>

                            <div class="col-md-2 col-md-offset-3" style="text-align: center;">
                                <button type="button" class="btn btn-primary" onclick="history.back()">
                                <i class="glyphicon glyphicon-backward"></i>
                                 返回
                                </button>
                            </div>
                        </div>
 
                </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
 $(function(){
            var today = new Date();
            var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);

            $('#rcpdate').datepicker();

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
