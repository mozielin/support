@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增聯絡人</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;">聯絡人編號:New
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          新增聯絡人</label>
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
        <form class="form-horizontal" method="POST"  onsubmit="return Confirm();" action="/applicant/store" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">
              <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                    <div class="col-md-4">
                        <input id="company_name" type="text" class="form-control" name="company_name" style="text-align: center;" value="{{$company->company_name}}" readonly>
                        <input type="hidden" id="company_id" name="company_id" value="{{$company->id}}">
                        <input type="hidden" id="company_applicant_builder"name="company_applicant_builder" value="{{Auth::user()->id}}">
                        <input type="hidden" id="create_by" name="create_by" value="1">
                    </div>
            
              <label for="company_applicant_dep" class="col-md-2 control-label" style="text-align:right;">所屬部門:</label>
              <div class="col-md-4">
                <input type="text" id="company_applicant_dep" name="company_applicant_dep" class=" col-md-4 form-control" placeholder="請輸入聯絡人所屬部門" style="width: 100%;text-align: center;" value="" >
                
             </div>
                
            </div>

            <div class="form-group col-md-12 form-horizontal">
                
              <label for="applicant_name" class="col-md-2 control-label" style="text-align:right;">聯絡人姓名:</label>
                <div class="col-md-4">
                    <input type="text" name="applicant_name" class=" col-md-4 form-control" style="width:100%;text-align:center" value="" placeholder="請輸入聯絡人姓名" required autofocus>
                </div>

              <label for="company_applicant_title" class="col-md-2 control-label" style="text-align:right;">聯絡人級職:</label>
                
                <div class="col-md-4">
                  <input type="text" name="company_applicant_title" class=" col-md-4 form-control" style="width:100%;text-align:center" value="" placeholder="請輸入聯絡人級職">
                </div>
          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_applicant_phone" class="col-md-2 control-label" style="text-align:right;">公司電話:</label>
              <div class="col-md-4">
                <input type="text" name="company_applicant_phone" class=" col-md-4 form-control" style="width:100%;text-align:center" value="" placeholder="請輸入聯絡人電話">               
              </div>
            
            <label for="company_applicant_mobile" class="col-md-2 control-label" style="text-align:right;">聯絡手機:</label>
              <div class="col-md-4">
                <input type="text" name="company_applicant_mobile" class=" col-md-4 form-control" style="width:100%;text-align:center" value="" placeholder="請輸入聯絡人手機">            
              </div>

          </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="company_applicant_email" class="col-md-2 control-label" style="text-align:right;">Email:</label>
            <div class="col-md-4">
            <input type="text" name="company_applicant_email" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{ old('company_applicant_email')}}" placeholder="請輸入聯絡人Email" required>        
            </div>

            <label for="company_applicant_email2" class="col-md-2 control-label" style="text-align:right;">Email2:</label>
            <div class="col-md-4">
            <input type="text" name="company_applicant_email2" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="{{ old('company_applicant_email2')}}" placeholder="請輸入聯絡人Email" >        
            </div>

        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="company_applicant_email" class="col-md-2 control-label" style="text-align:right;"></label>
            <div class="col-md-4">
                 
            </div>

            <label for="applicant_note" class="col-md-2 control-label" style="text-align:right;">備註:</label>
            <div class="col-md-4">
            <input type="textarea" name="applicant_note" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="" placeholder="有需要紀錄?" >                
            </div>

        </div>
  
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

              <div class="col-md-2 col-md-offset-2" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="history.back()">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
              </div> 

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
$('#company_name').autocomplete({
source : '{!!URL::route('contract_auto') !!}',
minlength : 1,
autoFocos : true,
select : function(e,ui){
//alert(ui.item.EIN);
console.log(ui);
$('#company_name').val(ui.item.value);
$('#company_id').val(ui.item.id);
$('#company_EIN').val(ui.item.EIN);

}
});
</script>
@endsection