@extends('layouts.master')
@section('title')
<h2 style="margin-top:2px;">新增Permission</h2>
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
                    新增Permission</label>
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
                    <form class="form-horizontal" method="POST" onsubmit="return Confirm();" action="{{ route('permission_store') }}">
                            {{ csrf_field() }}
                        <div class="form-group col-md-12 form-horizontal">
                            <label for="permission_name" class="col-md-2 control-label" style="text-align:right;">Permission:</label>
                            <div class="col-md-4">
                                <input type="text" id="permission_name" name="permission_name" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="" placeholder="請輸入Permission名稱" required autofocus>
                    
                            </div>  

                            <label for="display_name" class="col-md-2 control-label" style="text-align:right;">DisplayName:</label>
                            <div class="col-md-4">
                                <input type="text" id="display_name" name="display_name" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="" placeholder="請輸入欲顯示名稱" required autofocus>
                            </div> 
                                                       
                        </div>
                        
                        <div class="form-group col-md-12 form-horizontal">
                            <label for="description" class="col-md-2 control-label" style="text-align:right;">Description:</label>
                            <div class="col-md-6">
                                <input type="text" name="description" class=" col-md-4 form-control" style="width: 100%;text-align:center" value="" placeholder="請簡單描述幹嘛用的" >                
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