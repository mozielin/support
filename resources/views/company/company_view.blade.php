@extends('layouts.master')

@section('title')
  <h2 style="margin-top: 2px">客戶明細</h2>
@endsection

@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
  @include('layouts.center_block') 
</div>

<script src="/js/autosize.min.js" type="text/javascript" ></script>

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
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">

            <div class="form-horizontal" style="height:100%">
            	

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_EIN" class="col-md-2 control-label" style="text-align:right;">統一編號:</label>
                <div class="col-md-4">
                  <input type="text" name="company_EIN" class=" col-md-4 form-control" value="{{$data->company_EIN}}" readonly >
                </div>  
                
                <label for="company_engname" class="col-md-2 control-label" style="text-align:right;">英文名稱:</label>
                <div class="col-md-4">
                  <input type="text" name="company_engname" class=" col-md-4 form-control" value="{{$data->company_engname}}" readonly >   
                </div>
              </div>
              
              <div class="form-group col-md-12 form-horizontal">

                <label for="company_cel" class="col-md-2 control-label" style="text-align:right;">公司電話:</label>
                <div class="col-md-4">
                  <input type="text" name="company_cel" class=" col-md-4 form-control" value="{{$data->company_cel}}" readonly >
                </div> 

                <label for="company_business" class="col-md-2 control-label" style="text-align:right;">負責業務:</label>
                <div class="col-md-4">
                  <input type="text" name="company_business" class=" col-md-4 form-control" value="{{$sales->name}}" readonly >   
                </div>

              </div>


              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_capital" class="col-md-2 control-label" style="text-align:right;">公司資本:</label>
                <div class="col-md-4">
                  <input type="text" name="company_capital" class=" col-md-4 form-control" value="{{$data->company_capital}}" readonly >
                </div>  
                        
                <label for="company_population" class="col-md-2 control-label" style="text-align:right;">公司規模:</label>
                <div class="col-md-4">
                  <input type="text" name="company_population" class=" col-md-4 form-control" value="{{$data->company_population}}" readonly >   
                </div>
              </div> 
              
              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_industry_name" class="col-md-2 control-label" style="text-align:right;">公司產業:</label>
                <div class="col-md-4">
                  <input type="text" name="company_industry_name" class=" col-md-4 form-control" value="{{$data->company_industry_name}}" readonly >
                </div>  
                        
                <label for="company_type_name" class="col-md-2 control-label" style="text-align:right;">公司型態:</label>
                <div class="col-md-4">
                  <input type="text" name="company_type_name" class=" col-md-4 form-control" value="{{$data->company_type_name}}" readonly >   
                </div>
              </div>

              <div class="form-group col-md-12 form-horizontal"> 
                <label for="company_btn" class="col-md-2 control-label" style="text-align:right;">公司地區:</label>
                <div class="col-md-4">
                  <input type="text" name="company_area" class=" col-md-4 form-control" value="{{$data->area_name.$data->company_area2}}" readonly>
                </div>
                        
                <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">合約方案:</label>
                <div class="col-md-4">               
                  <input type="text" name="contract_plan" class=" col-md-4 form-control" value="{{$contractplan}}" readonly>
                </div>
              </div> 

              <div class="form-group col-md-12 form-horizontal">
                 <label for="company_create" class="col-md-2 control-label" style="text-align:right;">申請日期:</label>
                <div class="col-md-4">
                  <input type="date" name="company_create" style="padding-left:50px;" class=" col-md-4 form-control" value="{{$data->company_create}}" readonly >   
                </div>

                <label for="contract_plan" class="col-md-2 control-label" style="text-align:right;">申請方案:</label>
                <div class="col-md-4">               
                  <input type="text" name="contract_plan" class=" col-md-4 form-control" value="{{$data->plan_name}}" readonly>
                </div> 
              </div>

              <div class="form-group col-md-12 form-horizontal" style="height:36px;">
                 @permission('none')
                  <div id="accordion" class="col-md-6" style="width:223px;text-align:left;z-index:1;">
                  <h3 style="text-align:center;margin-left:0px!important;margin-top:3px!important;overflow: visible;">進階</h3>
                    <div class="col-md-12" style="padding-left:0px!important;padding-right:0px!important;overflow: visible;">
                      <div class="col-md-6" style="text-align:center;float:left;">
                        @permission('company_delete')
                        <button type="button" class="btn btn-primary" onclick="return Confirm();">
                        <i class="glyphicon glyphicon-trash"></i>
                        刪除
                        </button>
                        @endpermission
                      </div>
                
                      <div class="col-md-6" style="text-align:center;">
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('company_edit', $data->id)}}'">
                        @permission('company_edit')
                        <i class="glyphicon glyphicon-pencil"></i>
                        修改
                        </button>
                        @endpermission
                      </div>
                    </div>
                    </div>
                    @endpermission
                <label for="company_url" class="col-md-2 control-label" style="text-align:right;">公司網站:</label>
                <div class="col-md-4">
                <input type="text" name="company_url" class=" col-md-4 form-control" value="{{$data->company_url}}" readonly >
                </div>
                
                <label for="company_status" class="col-md-2 control-label" style="text-align:right;">案件狀態:</label>
                <div class="col-md-4">
                  <input type="text" name="company_status" class=" col-md-4 form-control" value="{{$data->status_name}}" readonly style="overflow:hidden;" >
                </div>
              </div>

              <div class="form-group col-md-12 form-horizontal" >
				
              	<label for="note" class="col-md-2 control-label" style="text-align:right;">備註事項:</label>
                <div class="col-md-10">

                  <textarea name="note" style="height:100px;" id="note" class=" col-md-4 form-control noresize " value="" readonly >{{$data->note}}</textarea>
                     <script type="text/javascript"> 
    					         autosize($('#note'));
    				          </script>
                </div>
              </div>
  
                <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">
                  <div class="col-md-2" style="text-align:center;float:left;">
                  @permission('company_delete')
                    <button type="button" class="btn btn-primary" onclick="return Confirm();">
                      <i class="glyphicon glyphicon-trash"></i>
                        刪除
                    </button>
                  @endpermission
                  </div>

                   <div class="col-md-2" style="text-align:center;float:left;">
                  @role('admin' || 'devenlope')
                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('activity_custome', $data->id)}}'">
                      <i class="glyphicon glyphicon-stats"></i>
                        Log
                    </button>
                  @endrole
                  </div>
                  
                  <div class="col-md-2 col-md-offset-4" style="text-align:center;">
                  @permission('company_delete')
                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('company_edit', $data->id)}}'">
                      <i class="glyphicon glyphicon-pencil"></i>
                        修改
                      </button>
                  @endpermission
                  </div>
       
                  <div class="col-md-2 " style="text-align:center;">
                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('company_index')}}'">
                    <i class="glyphicon glyphicon-backward"></i>
                     返回
                    </button>
                  </div>

                </div>

              </div>

            </div>
    
          </div><!--區塊內容結束-->
      </div>
    </div><!--第一區塊結束-->
  

  <!--第二區塊-->
  <div id="accordion2"> 
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$applicantnum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        聯絡人列表
    </h3>
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px; padding-top:2px;">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left; padding-top:10px">Total:
            {{$applicantnum}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px">
            聯絡人列表</label>
              @role('devenlope' || 'admin')
              <a href="{{route('applicant_create_by',$data->id)}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>    
              @endrole           
        </div>
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;"">

                    <div class="col-md-1" style="border-right:1px solid black;">  
                        ID
                      </div>
                    
                    <div class="col-md-2" style="border-right:1px solid black;">  
                        姓名
                      </div>  

                    <div class="col-md-3" style="border-right:1px solid black;">  
                        聯絡電話
                      </div>

                    <div class="col-md-3" style="border-right:1px solid black;">  
                        手機號碼
                      </div>
                    <div class="col-md-3" style="border-right:1px solid black;">  
                        Email
                      </div>

                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($applicant as $adata)
            <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('applicant_view', $adata->id)}}'">
    <div class="panel-heading " style="height:100%;@if($adata->vip == '1')background-color: #4db1f3;@endif">       
      <div class="row" style="text-align:center;">
        <div class="col-md-1" style="border-right:1px solid black;border-left:1px solid black;">  
          {{$adata->id}}
        </div>
        <div class="col-md-2" style="border-right:1px solid black;">  
          {{$adata->applicant_name}} 
        </div>
        
        <div class="col-md-3" style="border-right:1px solid black;">  
          {{$adata->company_applicant_phone}}  
        </div>
          
        
        <div class="col-md-3" style="border-right:1px solid black;">
          {{$adata->company_applicant_mobile}}
        </div> 

        <div class="col-md-3" style="border-right:1px solid black;">
          {{$adata->company_applicant_email}}
        </div>   

      </div>                      
    </div>    
    </div>
            @endforeach
          </div>

          </div><!--區塊內容結束-->    
        </div>
  </div><!--第二區塊結束--></div>

  <!--第3區塊-->
  <div id="accordion3"> 
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$contractnum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        合約列表
    </h3>
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px; padding-top:2px">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left; padding-top:10px">Total:
            {{$contractnum}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px">
            合約一覽</label>
              @role('devenlope' || 'admin')
              <a href="{{route('contract_create_by',$data->id)}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>    
              @endrole           
        </div>
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;">

                    <div class="col-md-4" style="border-right:1px solid black;">  
                        合約名稱
                      </div>
                    
                    <div class="col-md-2" style="border-right:1px solid black;">  
                        合約日期
                      </div>  

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        結束日期
                      </div>

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        合約方案
                      </div>

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        合約狀態
                      </div>                 
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($contract as $cdata)
            <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('contract_view', $cdata->id)}}'">
    <div class="panel-heading " style="height:100%;">       
      <div class="row" style="text-align:center;">
        <div class="col-md-4" style="border-right:1px solid black;border-left:1px solid black;">  
          {{$cdata->contract_title}} 
        </div>
        <div class="col-md-2" style="border-right:1px solid black;">  
          {{$cdata->company_contract_date}} 
        </div>
        
        <div class="col-md-2" style="border-right:1px solid black;">  
          {{$cdata->company_contract_end}}  
        </div>

        <div class="col-md-2" style="border-right:1px solid black;">
          {{$cdata->plan_name}}
        </div>
        
        <div class="col-md-2" style="border-right:1px solid black;">
          {{$cdata->status_name}}
        </div>    

      </div>                      
    </div>    
    </div>
            @endforeach
          </div>

          </div><!--區塊內容結束-->    
        </div>
  </div><!--第3區塊結束--></div>

  <!--第4區塊-->
  <div id="accordion4"> 
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$licensenum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        License
    </h3>
    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px; padding-top:2px">
          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left; padding-top:10px">Total:
            {{$licensenum}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px">
            Lic一覽</label>
              @role('devenlope' || 'admin')
              <a href="{{route('upload_by',$data->id)}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>    
              @endrole           
        </div>
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;">

                    <div class="col-md-1" style="border-right:1px solid black; border-left:1px solid black;"> 
                      ID
                    </div>
                  
                  <div class="col-md-3" style="border-right:1px solid black;">  
                    Lic名稱
                    </div>  

                  <div class="col-md-3" style="border-right:1px solid black;">  
                      開始日期
                    </div>

                  <div class="col-md-3" style="border-right:1px solid black;">  
                      結束日期
                    </div>

                  <div class="col-md-2" style="border-right:1px solid black;">  
                      狀態
                    </div>            
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($license as $licdata)
            <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('license_view', $licdata->id)}}'">
    <div class="panel-heading " style="height:100%;">       
      <div class="row" style="text-align:center;">
        <div class="col-md-1" style="border-right:1px solid black;border-left:1px solid black;">  
          {{$licdata->id}}
        </div>
        <div class="col-md-3" style="border-right:1px solid black;">  
          {{$licdata->lic_name}} 
        </div>
        
        <div class="col-md-3" style="border-right:1px solid black;">  
          {{$licdata->start_at}} 
        </div>
          
        
        <div class="col-md-3" style="border-right:1px solid black;">
          {{$licdata->expir_at}}
        </div>

        <div class="col-md-2" style="border-right:1px solid black;">
          {{$licdata->status_name}}
        </div>    

      </div>                      
    </div>    
    </div>
            @endforeach
          </div>

          </div><!--區塊內容結束-->    
        </div>
  </div><!--第4區塊結束--></div>

  <!--第5區塊-->
  <div id="accordion5"> 
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$servernum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        Server列表
    </h3>

    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px; padding-top:2px">

          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left; padding-top:10px;">Total:
            {{$servernum}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px">
            Server一覽</label>
              @role('devenlope' || 'admin')
              <a href="{{route('server_create_by',$data->id)}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-plus"></i> 新增 </button></a>    
              @endrole           
        </div>
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;"">

                    <div class="col-md-4" style="border-right:1px solid black;">  
                        主機名稱
                      </div>
                    
                    <div class="col-md-3" style="border-right:1px solid black;">  
                        主機類型
                      </div>  

                    <div class="col-md-3" style="border-right:1px solid black;">  
                        主機MAC
                      </div>

                    <div class="col-md-2" style="border-right:1px solid black;">  
                        Sync版號
                      </div>                 
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($server as $sedata)
            <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('server_view', $sedata->id)}}'">
              <div class="panel-heading " style="height:100%;">       
                <div class="row" style="text-align:center;">

                  <div class="col-md-4">  
                    {{$sedata->server_name}}
                  </div>

                  <div class="col-md-3">  
                    {{$sedata->company_server_type}} 
                  </div>

                  <div class="col-md-3">  
                    {{$sedata->company_server_mac}}  
                  </div>

                  <div class="col-md-2">  
                    {{$sedata->sync_ver}}  
                  </div>

                </div>                      
              </div>    
            </div>
            @endforeach
          </div>

          </div><!--區塊內容結束-->    
        </div>
  </div><!--第5區塊結束--></div><!--收合結束-->


  <!--第6區塊-->
  <div id="accordion6"> 
    <h3 style="text-align:left;">
        &nbsp;&nbsp;&nbsp;&nbsp;
        Total:{{$managernum}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        相關人員列表
    </h3>

    <div class="panel-heading" >
      <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px; padding-top:2px">

          <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left; padding-top:10px;">Total:
            {{$managernum}}</label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; padding-top:10px">
            相關人員一覽</label>
               @role('devenlope' || 'admin')
              <a href="{{route('manager_edit',$data->id)}}"><button type="submit" class="btn btn-primary" style="float:right;" ><i class="glyphicon glyphicon-pencil"></i> 編輯 </button></a>    
              @endrole
        </div>
          <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="container" style="width:100%;height:100%;margin-right:218px;">
              <div class="panel panel-default">
                <div class="panel-heading" style="height:100%;">        
                  <div class="row" style="text-align:center;"">

                    <div class="col-md-3" style="border-right:1px solid black;">  
                        Group
                      </div>
                    
                    <div class="col-md-4" style="border-right:1px solid black;">  
                        Name
                      </div>  

                    <div class="col-md-5" style="border-right:1px solid black;">  
                        Email
                      </div>                 
                </div>                      
              </div>    
            </div>
          </div>
          <div class="container" style="width:100%;height:100%;margin-right:218px;">
            @foreach($manager as $madata)
            <div class="panel panel-default test" style="cursor:pointer;" onclick="location.href='{{route('user_view', $madata->user_id)}}'">
              <div class="panel-heading " style="height:100%;">       
                <div class="row" style="text-align:center;">

                  <div class="col-md-3">  
                    {{$madata->user_group_name}}
                  </div>

                  <div class="col-md-4">  
                    {{$madata->name}} 
                  </div>

                  <div class="col-md-5">  
                    {{$madata->email}}  
                  </div>

                </div>                      
              </div>    
            </div>
            @endforeach
          </div>

          </div><!--區塊內容結束-->    
        </div>
  </div><!--第6區塊結束--> </div>

  </div><!--最外框結束-->
</div>


            <script>//彈出對話框確認 
              function Confirm()
              {
                window.alert('會連帶一併刪除其餘資料哦(合約、License、聯絡人等等)!');
                if(confirm("請你考慮清楚哦~")==true) 
                  window.alert('刪錯...後果自負哦!');
                else  
                  return false;
      
                if(confirm("確認要刪除一切公司資料？")==true) 
                  window.location="{{URL::route('company_delete', $data->id)}}";
                else  
                  return false;
              }   
            </script>  

            <script>
              $( "#accordion" ).accordion({

                active:false,
                collapsible: true

              });

              $( "#accordion2" ).accordion({

                active:false,
                collapsible: true

              });

              $( "#accordion3" ).accordion({

                active:false,
                collapsible: true

              });

              $( "#accordion4" ).accordion({

                active:false,
                collapsible: true

              });

              $( "#accordion5" ).accordion({

                active:false,
                collapsible: true

              }); 

               $( "#accordion6" ).accordion({

                active:false,
                collapsible: true

              });             
            </script>


@endsection