@extends('layouts.master')
@section('contentm')

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading" style="height:500px;">
            <div class="panel-heading">Welcome {{Auth::user()->name}}<p style="float: right;">Login_at: {{$time}}</p>
            </div>
		        <div class="panel-body">
                    <div class="panel panel-default" >
        <div class="panel-heading" style="text-align:center; height:40px;">
    <!--區塊標題-->
          <label for="id" class="col-md-3" style="text-align:left;"> 公告編號:{{$data->id}}
          </label>
          <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    {{$data->bulletin_name}}
          </label>
          <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{$data->name}}</label>
        </div>
        <!--區塊內容-->
          <div class="panel-body" style="height:100%">
            <div class="form-horizontal">

              <div class="form-group col-md-12 form-horizontal">
                <label for="bulletin_content" class="col-md-2 control-label" style="text-align:left;">公告內容:</label>   
              </div>

            <div class="form-group col-md-12 form-horizontal">
              
                <textarea id="bulletin_content" class="col-md-12 form-control noresize"  >{{$data->bulletin_content}}</textarea>
                <script type="text/javascript"> 
                  autosize($('#bulletin_content'));
                </script>
              
            </div>
          
              <div class="form-group col-md-12 form-horizontal">

                <label for="createdby" class="col-md-2 control-label" style="text-align:right;">Createby_:</label>
                <div class="col-md-4">
                  <input type="text" name="createdby" class=" col-md-4 form-control ColorOrange" value="{{$data->name}}" readonly>        
                </div>

                <label for="created_at" class="col-md-2 control-label" style="text-align:right;">Create:</label>
                <div class="col-md-4">
                  <input type="textarea" name="created_at" class=" col-md-4 form-control ColorOrange"  value="{{$data->created_at}}" readonly>                
                </div>

              </div> 
           
          </div><!--區塊內容結束-->
       
          </div>
      </div>
                    
		        </div>
		</div>
    </div>
</div>


@endsection
