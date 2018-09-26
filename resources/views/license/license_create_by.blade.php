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
        <div id="drop" class="panel-body" style="height:100%">
    <div class="form-horizontal">
          
 <form class="form-horizontal" method="POST" enctype="multipart/form-data" onsubmit="return Confirm();" action="/license/upload_create" >
{{ csrf_field() }}

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
            
            <label for="lic" class="col-md-2 control-label">上傳附件:</label>
            <div class="col-md-8">
            <input type="file" multiple class="form-control" id="lic" name='lic' placeholder="上傳Lic" accept=".tpls" value="Upload" >
            <input type="hidden" id="builder_id" name="builder_id" value="{{Auth::user()->id}}">
            </div>

            <button type="submit" class="btn btn-primary">
                Submit
                </button>
        </div>
        </form>

          </div><!--區塊內容結束-->
        
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


$('#lic').change(function(event){
  //Filelist Object
  var filelist = event.target.files;
  var str = "";
  for(var i = 0; i < filelist.length ; i++ ) {
    var file = filelist[i]
    str += "name：" + escape(file.name) + "\n" + //檔名
         "type：" + file.type + "\n" +  //檔案類型
         "size：" + file.size + "\n" +  //檔案大小
         "lastModifiedDate：" + file.lastModifiedDate.toLocaleDateString() + "\n\n\n"; //最後修改日期
  }
  console.log(str);
});

jQuery.event.props.push('dataTransfer');
$('#drop').on('dragover', function(event){
  //停止開啟檔案及其他動作
  event.stopPropagation();
  event.preventDefault();
  //複製拖移的物件
  event.dataTransfer.dropEffect = 'copy';
});
$('#drop').on('drop', function(event){
  //停止開啟檔案及其他動作
  event.stopPropagation();
  event.preventDefault();

  //取得原始檔案
  var filetmp = event.originalEvent.dataTransfer.files;

  //複數檔案
  for (var i = 0; i < filetmp.length; i++) {
    var file = filetmp[i];

    //取得檔案內容
    var reader = new FileReader();
    //讀取中執行的function
    reader.onprogress = function (evt) {
      //確定evt 是 ProgressEvent.
      if (evt.lengthComputable) {
        //計算百分比
        var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
        //注意，percentLoaded不會在onprogress中達到100
        if (percentLoaded < 100) {
          console.log(percentLoaded);
        }
      }
    };
    reader.onload = (function(file){
      return function(event) {
        //如果前端有做進度條，onload要手動調成100%
        //檔案類型
        console.log(file.type);
        //檔案內容
        console.log(event.target.result);
      };
    })(file);
    reader.readAsText(file);
  }
});

</script>

<script type="text/javascript">
       $().ready(function () {
        document.getElementById("lic").value="";
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