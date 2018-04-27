@extends('layouts.master')
    @section('title')
        <h2 style="margin-top:2px;">新增TLC</h2>
    @endsection
@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.user_center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading">新增TLC</div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('seadmin_store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-3 col-md-offset-1 control-label">公司名稱</label>

                            <div class="col-md-5">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_tlc_start') ? ' has-error' : '' }}">
                            <label for="company_tlc_start" class="col-md-3 col-md-offset-1 control-label">TLC開始時間</label>

                            <div class="col-md-5">
                                <input id="company_tlc_start" type="date" class="form-control" style="padding-left: 50px;" name="company_tlc_start" value="{{ old('company_tlc_start') }}" required>

                                @if ($errors->has('company_tlc_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_tlc_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_tlc_end') ? ' has-error' : '' }}">
                            <label for="company_tlc_end" class="col-md-3 col-md-offset-1 control-label">TLC關閉時間</label>

                            <div class="col-md-5">
                                <input id="company_tlc_end" type="date" class="form-control" style="padding-left: 50px;" name="company_tlc_end" value="{{ old('company_tlc_end') }}" required>

                                @if ($errors->has('company_tlc_end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_tlc_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">


                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-5" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-check"></i>
                                    確定送出
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

@endsection
