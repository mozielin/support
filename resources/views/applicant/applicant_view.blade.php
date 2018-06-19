@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">瀏覽聯絡人</h2>
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
          <label for="id" class="col-md-3" style="text-align:left;">聯絡人編號:{{$data->id}}
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; "><a href="{{route('company_view',$data->company_id)}}">
                    {{$data->company_name}}</a>
          --{{$data->company_applicant_dep}}</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{Auth::user()->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">

            <div class="form-group col-md-12 form-horizontal">
                
              <label for="applicant_name" class="col-md-2 control-label" style="text-align:right;">聯絡人姓名:</label>
                <div class="col-md-4">
                    <input type="text" name="applicant_name" class=" col-md-4 form-control ColorOrange"  value="{{$data->applicant_name}}" readonly>
                </div>

              <label for="company_applicant_title" class="col-md-2 control-label" style="text-align:right;">聯絡人級職:</label>
                
                <div class="col-md-4">
                  <input type="text" name="company_applicant_title" class=" col-md-4 form-control ColorOrange" value="{{$data->company_applicant_title}}" readonly>
                </div>
          </div>
          
          <div class="form-group col-md-12 form-horizontal">

            <label for="company_applicant_phone" class="col-md-2 control-label" style="text-align:right;">公司電話:</label>
              <div class="col-md-4">
                <input type="text" name="company_applicant_phone" class=" col-md-4 form-control ColorOrange" value="{{$data->company_applicant_phone}}" readonly>               
              </div>
            
            <label for="company_applicant_mobile" class="col-md-2 control-label" style="text-align:right;">聯絡手機:</label>
              <div class="col-md-4">
                <input type="text" name="company_applicant_mobile" class=" col-md-4 form-control ColorOrange"value="{{$data->company_applicant_mobile}}" readonly>            
              </div>

          </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="company_applicant_email" class="col-md-2 control-label" style="text-align:right;">Email:</label>
            <div class="col-md-4">
            <input type="text" name="company_applicant_email" class=" col-md-4 form-control ColorOrange" value="{{$data->company_applicant_email}}" readonly>        
            </div>

            <label for="company_applicant_email2" class="col-md-2 control-label" style="text-align:right;">Email2:</label>
            <div class="col-md-4">
            <input type="text" name="company_applicant_email2" class=" col-md-4 form-control ColorOrange" value="{{$data->company_applicant_email2}}" readonly>        
            </div>

        </div>

        <div class="form-group col-md-12 form-horizontal">

            <label for="vip" class="col-md-2 control-label" style="text-align:right;">很重要嗎?</label>
            @if($data->vip == 1 ) 
            <div class="col-md-4">
            <label for="vip" class="col-md-2 control-label" style="text-align:right;">YES</label>
            </div>

            @else
            <div class="col-md-4">
            <label for="vip" class="col-md-2 control-label" style="text-align:right;">NO</label>
          
            </div>
            @endif

            <label for="applicant_note" class="col-md-2 control-label" style="text-align:right;">備註:</label>
            <div class="col-md-4">
            <input type="textarea" name="applicant_note" class=" col-md-4 form-control ColorOrange"  value="{{$data->applicant_note}}" readonly>                
            </div>

        </div>


  
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('applicant_delete', $data->id)}}";
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
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('applicant_edit', $data->id)}}'">
                <i class="glyphicon glyphicon-pencil"></i>
                修改
                </button>     
              </div>

              <div class="col-md-2 col-md-offset-3" style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('company_view',$data->company_id)}}'">
                <i class="glyphicon glyphicon-backward"></i>
                返回
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