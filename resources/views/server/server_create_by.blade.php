@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增Server</h2>
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
                <!--區塊標題-->
                <div class="panel-heading" style="text-align:center; height:40px">              
                    <label for="id" class="col-md-3" style="text-align:left;">ID:
                    New</label>
                    <label for="company_name" class="col-md-6 " style="text-align:center; border-bottom:2px solid; border-bottom-color:#d3e0e9; ">
                    <a href="{{route('company_view',$company->id)}}">
                    {{$company->company_name}}</a></label>
                    <label for="nothing" class="col-md-3" style="text-align:right;">Createby_{{Auth::user()->name}}</label>
                </div>
                <!--區塊內容-->
                <div class="panel-body" style="height:100%">
                    <script>//彈出對話框確認
                        function Confirm()
                        {
                            if(confirm("確認新增此筆資料？")==true)   
                                return true;
                            else  
                                return false;
                        }   
                    </script>
                    <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('server_store') }}">
                            {{ csrf_field() }}
                        <div class="form-group col-md-12 form-horizontal">
                            <label for="company_name" class="col-md-2 control-label" style="text-align:right;">公司名稱:</label>
                            <div class="col-md-4">
                                <input type="text" id="company_name" name="company_name" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="{{$company->company_name}}" readonly required>
                                <input type="hidden" id="company_server" name="company_server" value="{{$company->id}}" >
                                <input type="hidden" name="company_server_builder" value="{{Auth::user()->id}}">
                            </div>  

                            <label for="server_name" class="col-md-2 control-label" style="text-align:right;">主機名稱:</label>
                            <div class="col-md-4">
                                <input type="text" id="server_name" name="server_name" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="" required autofocus>
                            </div> 
                                                       
                        </div>
                        
                        <div class="form-group col-md-12 form-horizontal">
                            <label for="company_business_code" class="col-md-2 control-label" style="text-align:right;">企業代碼:</label>
                            <div class="col-md-4">
                                <input type="text" name="company_business_code" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="" >                
                            </div>

                            <label for="company_version_num" class="col-md-2 control-label" style="text-align:right;">安裝版號:</label>
                            <div class="col-md-4">
                                <input type="text" name="company_version_num" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="" >                
                            </div>

                        </div>

                        <div class="form-group col-md-12 form-horizontal">
          
                            <label for="company_server_mac" class="col-md-2 control-label" style="text-align:right;">主機MAC:</label>
                            <div class="col-md-4">
                                <select class="form-control" style="" name="company_server_mac" id="company_server_mac" required placeholder="請選擇Mac" required> 
                                @foreach ($macaddress as $macdata)
                                    <option value="{{$macdata->mac}}">{{$macdata->mac}}</option>
                                @endforeach 
                                </select>       
                            </div>

                            <label for="company_server_type" class="col-md-2 control-label" style="text-align:right;">主機類型:</label> 
                            <div class="col-md-4">
                                <select class="form-control" name="company_server_type" style="padding-left:65px;" required>
                                    <option value="Team+">Team+</option>
                                    <option value="VoIP">VoIP</option>
                                </select>               
                            </div>

                        </div>

                        <div class="form-group col-md-12 form-horizontal">

                            <label for="company_server_interip" class="col-md-2 control-label" style="text-align:right;">主機內網IP:</label>
                            <div class="col-md-4">
                                <input type="text" name="company_server_interip" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="" >               
                            </div>
            
                            <label for="company_server_extip" class="col-md-2 control-label" style="text-align:right;">主機對外IP:</label>
                            <div class="col-md-4">
                                <input type="text" name="company_server_extip" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="" >           
                            </div>

                        </div>

                         <div class="form-group col-md-12 form-horizontal">

                            <label for="company_server_interip" class="col-md-2 control-label" style="text-align:right;"></label>
                            <div class="col-md-4">
                                               
                            </div>
            
                            <label for="build_type" class="col-md-2 control-label" style="text-align:right;">建置方式:</label>
                            <div class="col-md-4">
                                 <select class="form-control" style="" name="build_type" id="build_type" required placeholder="請選擇建置方式" required>                                
                                    <option value="自備伺服器">自備伺服器</option>
                                    <option value="私有雲代管">私有雲代管</option>
                                </select>                   
                            </div>

                        </div>

                        <div class="form-group col-md-12 form-horizontal">

                            <label for="URL" class="col-md-2 control-label" style="text-align:right;">站台位置:</label>
                            <div class="col-md-10">
                                <input type="text" name="URL" class=" col-md-4 form-control" style="width: 100%;text-align: center" value="" >               
                            </div>
            
                        
                        </div>
                        
                        <div class="col-md-12" style="border-top:2px solid; border-top-color:#d3e0e9; padding-top:10px;">

                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    確認新增
                                </button>
                            </div>
                            
                        </div>
                    </form>
                </div><!--區塊內容結束-->               
            </div>
        </div>
    </div>
</div>
@endsection