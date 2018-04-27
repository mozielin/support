@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">修改客戶資料</h2>
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
            {{$data->id}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
            {{$data->company_name}}</label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>           
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
                <form class="form-horizontal" method="POST" action="{{ route('company_update',$data->id) }}">
                {{ csrf_field() }}
                <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                <div class="col-md-4">
                  <input type="text" name="company_name" class=" col-md-4 form-control" value="{{$data->company_name}}" required>
                </div>  
                        
                <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
                <div class="col-md-4">
                  <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{$data->company_EIN}}">
                </div>
              </div> 

              <div class="form-group col-md-12 form-horizontal">
                <label for="company_engname" class="col-md-2 control-label" style="text-align:right;">英文名稱:</label>
                <div class="col-md-4">
                  <input type="text" name="company_engname" class=" col-md-4 form-control" value="{{$data->company_engname}}">   
                </div>

                <label for="company_sales" class="col-md-2 control-label" style="text-align:right;">負責業務:</label>
                <div class="col-md-4">
                  <select class="form-control" style="padding-left:70px;" name="company_sales">
                        @foreach ($user as $users)                                
                            @if($data->com_sales_id == $users->id)
                            //如果迴圈的產業別ID符合公司產業別ID則預設選取
                            <option selected="true" value="{{$users->id}}">{{$users->name}} </option>
                            @else
                            //如果不符合就跑一般選項
                            <option value="{{$users->id}}">{{$users->name}} </option>
                            @endif
                        @endforeach
                    </select>      
                </div>
              </div>

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_create" class="col-md-2 control-label" style="text-align:right;">申請日期:</label>
                <div class="col-md-4">
                  <input type="text" id="company_create" name="company_create" style="padding-left:50px;" class=" col-md-4 form-control" value="{{$data->company_create}}" placeholder="請選擇申請日期" required>   
                </div>

                <label for="plan_name" class="col-md-2 control-label" style="text-align:right;">申請方案:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_plan" required>              
                        @foreach ($plandata as $plan)
                            @if($data->com_plan_id == $plan->id)
                                //如果迴圈的PLANID符合公司PLANID則預設選取
                                <option selected="true" value="{{$plan->id}}">{{$plan->plan_name}}</option>
                            @else
                                //如果不符合就跑一般選項
                                <option value="{{$plan->id}}">{{$plan->plan_name}}</option>
                            @endif                                
                        @endforeach
                    </select>        
                </div>
              </div>
                
                <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_industry_name" class="col-md-2 control-label" style="text-align:right;">公司產業:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_industry" required>
                        @foreach ($industrydata as $industry)                                
                            @if($data->com_industry_id == $industry->id)
                            //如果迴圈的產業別ID符合公司產業別ID則預設選取
                            <option selected="true" value="{{$industry->id}}">{{$industry->company_industry_name}} </option>
                            @else
                            //如果不符合就跑一般選項
                            <option value="{{$industry->id}}">{{$industry->company_industry_name}} </option>
                            @endif
                        @endforeach
                    </select>                         
                </div> 
                        
                <label for="company_type_name" class="col-md-2 control-label" style="text-align:right;">公司型態:</label>
                <div class="col-md-4">
                    <select class="form-control" style="padding-left:20px;" name="company_type" required>
                        @foreach ($typedata as $type)
                            @if($data->com_type_id == $type->id)
                                //如果迴圈的產業別ID符合公司產業別ID則預設選取
                                <option selected="true" value="{{$type->id}}">{{$type->company_type_name}}</option>
                            @else
                                //如果不符合就跑一般選項
                                <option value="{{$type->id}}">{{$type->company_type_name}}</option>
                            @endif  
                                
                        @endforeach
                    </select>               
                </div>

              </div>

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_capital" class="col-md-2 control-label" style="text-align:right;">公司資本:</label>
                <div class="col-md-4">
                  <input type="text" name="company_capital" class=" col-md-4 form-control" value="{{$data->company_capital}}" >
                </div>  
                        
                <label for="company_population" class="col-md-2 control-label" style="text-align:right;">公司規模:</label>
                <div class="col-md-4">
                  <input type="text" name="company_population" class=" col-md-4 form-control" value="{{$data->company_population}}" >   
                </div>
              </div> 
              
              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_cel" class="col-md-2 control-label" style="text-align:right;">公司電話:</label>
                <div class="col-md-4">
                  <input type="text" name="company_cel" class=" col-md-4 form-control" value="{{$data->company_cel}}" >
                </div>  
                        
                <label for="company_url" class="col-md-2 control-label" style="text-align:right;">公司網站:</label>
                <div class="col-md-4">
                  <input type="text" name="company_url" class=" col-md-4 form-control" value="{{$data->company_url}}">
                </div>
              </div>

              <div class="form-group col-md-12 form-horizontal">
                <label for="note" class="col-md-2 control-label" style="text-align:right;">公司地區:</label>
                <div class="col-md-2">
                    <select name="company_area" class="form-control" style="padding-left:20px;" required>
                            @foreach ($area as $sdata)                                
                            @if($data->company_area == $sdata->id)
                            //如果迴圈的產業別ID符合公司產業別ID則預設選取
                            <option selected="true" value="{{$sdata->id}}">{{$sdata->area_name}} </option>
                            @else
                            //如果不符合就跑一般選項
                            <option value="{{$sdata->id}}">{{$sdata->area_name}} </option>
                            @endif
                        @endforeach
                      </select>
                </div> 
                
                <div class="col-md-2">
                <input type="text" name="company_area2" class=" col-md-2 form-control inputs" placeholder="地區" value="{{$data->company_area2}}" >
                </div> 

                <label for="company_status" class="col-md-2 control-label" style="text-align:right;">案件狀態:</label>
                <div class="col-md-4">
                  <select class="form-control" style="padding-left:20px;" name="company_status" required>
                        @foreach ($status as $sdata)                                
                            @if($data->company_status == $sdata->id)
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

              <div class="form-group col-md-12 form-horizontal" >
        
                <label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
                <div class="col-md-10">

                  <textarea name="note" style="height:100px;" id="note" class=" col-md-4 form-control noresize " value="{{$data->note}}">{{$data->note}}</textarea>
                     <script type="text/javascript"> 
                       autosize($('#note'));
                      </script>
                </div>
              </div>


                <div class="form-group col-md-12 form-horizontal">

                <div class="col-md-3 col-md-offset-1">
                <button type="submit" class="btn btn-primary" >
                <i class="glyphicon glyphicon-check"></i>
                    確認修改
                </button>
                </div>
                <div class="col-md-3 col-md-offset-5">
                <button type="button" class="btn btn-primary" style="float:right;" onclick="history.back()">
                <i class="glyphicon glyphicon-backward"></i>
                返回
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
  });
</script>
@endsection