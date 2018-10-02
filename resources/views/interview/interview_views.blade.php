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
          <label for="id" class="col-md-3" style="text-align:left;">編號:{{$data->id}}
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; "><a href="{{route('company_view',$data->company_id)}}">
                    {{$data->company_name}}</a></label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
        <div class="panel-body" style="height:100%">
          <div class="form-horizontal">

            <div class="form-group col-md-12 form-horizontal">
              <label for="company_name" class="col-md-2 control-label" style="text-align:right;">聯繫時間:</label>
                    <div class="col-md-4">
                        <input id="company_name" type="text" class="form-control" name="company_name" style="text-align: center;" value="{{$data->created_at}}" readonly>
                        <input type="hidden" id="company_id" name="company_id" value="{{$data->id}}">
                        <input type="hidden" id="company_applicant_builder"name="builder" value="{{Auth::user()->id}}">
                        <input type="hidden" id="create_by" name="create_by" value="1">
                    </div>
            
              <label for="text" class="col-md-2 control-label" style="text-align:right;">聯絡方式:</label>
              <div class="col-md-4">
                <input id="text" type="text" class="form-control" name="company_name" style="text-align: center;" value="{{$data->text}}" readonly>  
               
                
             </div>
                
            </div>

            <div class="form-group col-md-12 form-horizontal">
                
              <label for="note" class="col-md-2 control-label" style="text-align:right;">聯絡事項:</label>
                <div class="col-md-10">
                    <textarea  id="note" type="textarea" class="form-control vresize"   name="note" readonly>{{$data->note}}
                    </textarea>
                </div>

             
          </div>
          
          <div class="form-group col-md-12 form-horizontal">            
            
            <label for="todo" class="col-md-2 control-label" style="text-align:right;">ToDo:</label>
              <div class="col-md-10">
                <textarea  id="todo" type="textarea" class="form-control vresize"   name="todo" readonly>{{$data->todo}}
                </textarea>         
              </div>

          </div>
  
            <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                <script>//彈出對話框確認 
                  function Confirm()
                  {
                    if(confirm("確認刪除此資料？")==true)   
                      window.location="{{URL::route('interview_delete', $data->id)}}";
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