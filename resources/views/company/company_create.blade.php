@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">新增客戶資料</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
  <!--最外框-->
  <div class="panel panel-default"> 
    <!--第一區塊-->
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;">ID:
            New</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
            新增客戶資料</label>
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
                <form class="form-horizontal" method="POST" action="{{ route('company_store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="company_builder" value="{{Auth::user()->id}}" required> 
                <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                <div class="col-md-4">
                  <input type="text" name="company_name" class=" col-md-4 form-control" value="{{ old('company_name') }}" placeholder="請輸入公司名稱" required>
                </div>  
                        
                <label for="company_engname" class="col-md-2 control-label" style="text-align:right;">英文名稱:</label>
                <div class="col-md-4">
                  <input type="text" name="company_engname" class=" col-md-4 form-control" value="{{ old('company_engname') }}" placeholder="請輸入公司英文名稱">
                </div>
              </div> 

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
                <div class="col-md-4">
                  <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{ old('company_EIN') }}" placeholder="請輸入公司統編" maxlength="9" >
                </div>
                

                <label for="plan_name" class="col-md-2 control-label" style="text-align:right;">客戶方案:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_plan" required placeholder="請選擇客戶申請方案">              
                        @foreach ($plandata as $plan)
                                <option value="{{$plan->id}}" 
                                @if(old('company_plan') == $plan->id) {{ 'selected' }} @endif>{{$plan->plan_name}}</option>
                        @endforeach
                    </select>        
                </div>
              </div>
                
                <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_industry_name" class="col-md-2 control-label" style="text-align:right;">公司產業:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_industry" placeholder="請輸入公司產業" required>
                        @foreach ($industrydata as $industry)                                
                            <option value="{{$industry->id}}" 
                            @if(old('company_industry') == $industry->id) {{ 'selected' }} @endif>{{$industry->company_industry_name}} </option>
                        @endforeach
                    </select>                         
                </div> 
                        
                <label for="company_type_name" class="col-md-2 control-label" style="text-align:right;">公司型態:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_type" placeholder="請輸入公司型態" required>
                        @foreach ($typedata as $type)
                                <option value="{{$type->id}}" 
                                @if(old('company_type') == $type->id) {{ 'selected' }} @endif>{{$type->company_type_name}}</option>        
                        @endforeach
                    </select>               
                </div>

              </div>

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_capital" class="col-md-2 control-label" style="text-align:right;">公司資本:</label>
                <div class="col-md-4">
                  <input type="text" name="company_capital" class=" col-md-4 form-control" value="" placeholder="請輸入公司資本額">
                </div>  
                        
                <label for="company_population" class="col-md-2 control-label" style="text-align:right;">公司規模:</label>
                <div class="col-md-4">
                  <input type="text" name="company_population" class=" col-md-4 form-control" value="{{ old('company_population') }}" placeholder="請輸入公司規模" autofocus >                   
                </div>
              </div> 
              
              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_cel" class="col-md-2 control-label" style="text-align:right;">公司電話:</label>
                <div class="col-md-4">
                  <input type="text" name="company_cel" class=" col-md-4 form-control inputs" value="{{ old('company_cel') }}" placeholder="請輸入公司電話">
                </div>  
                        
                <label for="company_url" class="col-md-2 control-label" style="text-align:right;">公司網站:</label>
                <div class="col-md-4">
                  <input type="text" name="company_url" class=" col-md-4 form-control inputs" placeholder="請輸入公司網站" value="{{ old('company_url') }}" >
                </div>
              </div> 

              <div class="form-group col-md-12 form-horizontal">

                <label for="company_create" class="col-md-2 control-label" style="text-align:right;">申請日期:</label>
                <div class="col-md-4">
                  <input type="text" id="company_create" name="company_create" class=" col-md-4 form-control" style="padding-left:0px;" value="{{ old('company_create') }}" placeholder="請選擇申請日期" required >
                </div> 

                 <label for="company_sales" class="col-md-2 control-label" style="text-align:right;">負責業務:</label>
                <div class="col-md-4">
                  <select class="form-control" style="padding-left:70px;" name="company_sales" placeholder="請選擇負責業務">
                        @foreach ($userdata as $users)                                
                            <option value="{{$users->id}}" 
                            @if(old('company_sales') == $users->id) {{ 'selected' }} @endif>{{$users->name}}</option>
                        @endforeach
                    </select>
                </div> 

              </div>

              <div class="form-group col-md-12 form-horizontal">
                <label for="note" class="col-md-2 control-label" style="text-align:right;">公司地區:</label>
                <div class="col-md-4" style="">
                    <select name="company_area" class="col-md-2 form-control" style="width:60%;"  required>
                            @foreach ($area as $data)
                                <option value="{{$data->id}}" 
                                @if(old('company_area') == $data->id) {{ 'selected' }} @endif>
                                {{$data->area_name}}</option>
                            @endforeach
                      </select>
                
                <input type="text" name="company_area2" class=" col-md-2 form-control inputs" style="width:40%;" placeholder="地區" value="{{ old('company_area2') }}" >
                </div> 

                <label for="company_status" class="col-md-2 control-label" style="text-align:right;">案件狀態:</label>
                <div class="col-md-4">
                        <select name="company_status" class="form-control" style="padding-left:20px;" required>
                            @foreach ($status as $data)
                                <option value="{{$data->id}}" 
                                @if(old('company_status') == $data->id) {{ 'selected' }} @endif>
                                [{{$data->status_class}}]-{{$data->status_name}}</option>
                            @endforeach
                        </select>
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



                <div class="form-group col-md-12 form-horizontal" style="border-top:2px solid; border-color:#d3e0e9; padding-top:10px; ">

                <div class="col-md-2 col-md-offset-2">
                <button type="button" class="btn btn-primary" onclick="history.back()">
                <i class="glyphicon glyphicon-backward"></i>
                返回
                </button>
                </div>
                <div class="col-md-2 col-md-offset-6">
                <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-check"></i>
                    確認
                </button>
                </div>
                </div>
                </form>
            </div>
            
</div><!--區塊內容結束-->
</div>
    </div>
  </div><!--第一區塊結束-->

  <script type="text/javascript">
$(function() {
    $('#company_create').datepicker();
    $.datepicker.setDefaults({ dateFormat: 'yy-mm-dd' });
    $(".inputs").keyup(function () {
        if (this.value.length == this.maxLength) {
          $(this).next('.inputs').focus();
        }
    });
});</script>
@endsection

