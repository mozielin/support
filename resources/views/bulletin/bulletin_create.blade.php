@extends('layouts.master')
    @section('title')
        <h2 style="margin-top:2px;">新增公告</h2>
    @endsection
@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.user_center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading">新增公告</div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('bulletin_store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('bulletin_name') ? ' has-error' : '' }}">
                            <label for="bulletin_name" class="col-md-3 col-md-offset-1 control-label">公告標題</label>

                            <div class="col-md-5">
                                <input id="bulletin_name" type="text" class="form-control" name="bulletin_name" value="{{ old('bulletin_name') }}" required autofocus>

                                @if ($errors->has('bulletin_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bulletin_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bulletin_content') ? ' has-error' : '' }}">
                            <label for="bulletin_content" class="col-md-3 col-md-offset-1 control-label">公告內容</label>

                            <div class="col-md-5">
                                <textarea  id="bulletin_content" type="textarea" class="form-control vresize"   name="bulletin_content" value="" required>
                                    
                                </textarea>
                                

                                @if ($errors->has('bulletin_content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bulletin_content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                    <input type="hidden" name="builder" value="{{Auth::user()->id}}">


                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-5" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">
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
