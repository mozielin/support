@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增訪談紀錄</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;">編號:New
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
          新增訪談紀錄</label>
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
        <form class="form-horizontal" method="POST"  onsubmit="return Confirm();" action="/interview/store" >
                {{ csrf_field() }}
            <div class="form-group col-md-12 form-horizontal">
              <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                    <div class="col-md-4">
                        <input id="company_name" type="text" class="form-control" name="company_name" style="text-align: center;" value="{{$company->company_name}}" readonly>
                        <input type="hidden" id="company_id" name="company_id" value="{{$company->id}}">
                        <input type="hidden" id="company_applicant_builder"name="builder" value="{{Auth::user()->id}}">
                        <input type="hidden" id="create_by" name="create_by" value="1">
                    </div>
            
              <label for="text" class="col-md-2 control-label" style="text-align:right;">聯絡方式:</label>
              <div class="col-md-4">
                <select class="form-control" name="text" style="padding-left:65px;" required>
                  <option value="主動去電">主動去電</option>
                  <option value="客戶來電">客戶來電</option>
                  <option value="到府拜訪">到府拜訪</option>
                  <option value="客戶來訪">客戶來訪</option>
                  <option value="Email">Email</option>
                  <option value="Key Message">Key Message</option>
                  <option value="其他">其他</option>
                </select>   
               
                
             </div>
                
            </div>

            <div class="form-group col-md-12 form-horizontal">
                
              <label for="note" class="col-md-2 control-label" style="text-align:right;">聯絡事項:</label>
                <div class="col-md-10">
                    <textarea  id="note" type="textarea" class="form-control vresize"   name="note" value="" required>
                    </textarea>
                </div>

             
          </div>
          
          <div class="form-group col-md-12 form-horizontal">            
            
            <label for="todo" class="col-md-2 control-label" style="text-align:right;">ToDo:</label>
              <div class="col-md-10">
                <textarea  id="todo" type="textarea" class="form-control vresize"   name="todo" value="" required>
                </textarea>         
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
           });

       });
</script>
@endsection