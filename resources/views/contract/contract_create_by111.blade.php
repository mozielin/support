@extends('layouts.master')
@section('title')
<h2 style="margin-top: 2px">新增合約</h2>
@endsection
@section('contentm')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.center_block')
</div>
        <!--中間的線-->
        <div class="line" style="height:30px;border-right:1px solid #D3E0E9;position:absolute;left:783px;top:167px;">
        </div>

<div class="container" style="width:750px;height:80px;margin-right:233px;">
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">新增合約</div>
            <div class="panel-body">
            <form class="form-horizontal" method="post" action="/contract/upload" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!--先查詢公司統編取得ID及資訊-->
                <div class="form-group">
                    <label for="company_name" class="col-md-4 control-label">公司名稱</label>
                    <div class="col-md-6">
                        <input id="company_name" type="text" class="form-control" name="company_name" readonly="readonly" value="{{$company->company_name}}" required>
                    </div>
                </div>
                
                <!--再輸入合約相關日期及上傳檔案-->
                
                <div class="form-group">
                    <label for="contract_title" class="col-md-4 control-label">合約標題</label>
                    <div class="col-md-6">
                        <input id="contract_title" type="text" class="form-control" name="contract_title" placeholder="請輸入合約標題" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contract_status" class="col-md-4 control-label">合約狀態</label>
                    <div class="col-md-6">
                        <input id="contract_status" type="text" class="form-control" name="contract_status" placeholder="請輸入合約狀態" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contract_price" class="col-md-4 control-label">合約總價</label>
                    <div class="col-md-6">
                        <input id="company_contract_price" type="text" class="form-control" name="contract_price" placeholder="請輸入合約總價" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contract_quantity" class="col-md-4 control-label">授權人數</label>
                    <div class="col-md-6">
                        <input id="contract_quantity" type="text" class="form-control" name="contract_quantity" placeholder="請輸入授權人數" required autofocus>
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('company_contract_date') ? ' has-error' : '' }}">
                    <label for="company_contract_date" class="col-md-4 control-label">合約建立日期</label>
                    <div class="col-md-6">
                        <input id="company_contract_date" type="date" class="form-control" name="company_contract_date" value="{{ old('company_contract_date') }}" required autofocus>
                        @if ($errors->has('company_contract_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_contract_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('company_contract_start') ? ' has-error' : '' }}">
                    <label for="company_contract_start" class="col-md-4 control-label">合約開始日期</label>
                    <div class="col-md-6">
                        <input id="company_contract_start" type="date" class="form-control" name="company_contract_start" value="{{ old('company_contract_start') }}" required autofocus>
                        @if ($errors->has('company_contract_start'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_contract_start') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('company_contract_end') ? ' has-error' : '' }}">
                    <label for="company_contract_end" class="col-md-4 control-label">合約結束日期</label>
                    <div class="col-md-6">
                        <input id="company_contract_end" type="date" class="form-control" name="company_contract_end" value="{{ old('company_contract_end') }}" required autofocus>
                        @if ($errors->has('company_contract_end'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_contract_end') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('company_contract_check') ? ' has-error' : '' }}">
                    <label for="company_contract_check" class="col-md-4 control-label">合約驗收日期</label>
                    <div class="col-md-6">
                        <input id="company_contract_check" type="date" class="form-control" name="company_contract_check" value="{{ old('company_contract_check') }}" required autofocus>
                        @if ($errors->has('company_contract_check'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_contract_check') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                            
                <div class="form-group{{ $errors->has('company_contract_check') ? ' has-error' : '' }}">
                    <label for="company_contract_check" class="col-md-4 control-label">上傳合約檔案</label>
                    <div class="col-md-6">
                        <input type="file" class="form-control"  name="image" placeholder="上傳圖片" accept=".jpg, .jpeg, .png .pdf" value="Upload">
                    </div>
                </div>
                
                <input type="hidden" id="company_id" name="company_id" value="{{$dataid}}" >
                <input type="hidden" id="builder" name="builder" value="{{Auth::user()->id}}">
                
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <button type="submit" class="btn btn-primary">
                        確認送出
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$('#autosearch').autocomplete({
source : '{!!URL::route('autocomplete') !!}',
minlength : 1,
autoFocos : true,
select : function(e,ui){
//alert(ui);
$('#autosearch').val(ui.item.value);
$('#company_id').val(ui.item.id);

}
});
</script>
@endsection