@extends('layouts.master')
@section('contentm')

<div class="container" style="width:780px;height:80px;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading" style="text-align:center;">新增使用者</div>
                    <div class="panel-body">

                        <script>//彈出對話框確認
                            function Confirm()
                            {
                                if(confirm("確認修改此筆資料？")==true)   
                                    return true;
                                else  
                                    return history.back();
                            }   
                        </script>
                                                      <!--送出表單前呼叫上面的script-->
                        <form class="form-horizontal" onsubmit="return Confirm();" method="POST" action="{{ route('user_group_update', $group->id) }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('user_group_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-8">
                                    <input id="user_group_name" type="text" class="form-control" name="user_group_name" value="{{$group->user_group_name}}" required autofocus style="width:70%;">
                                    @if ($errors->has('user_group_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_group_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-6" style="position:absolute;left:688px;">                                    
                                    <button type="submit"class="btn btn-primary" style="align:center;">確認修改</button>
                                </div>
                                <div class="col-md-6 "  style="position:absolute;left:776px;">
                                    <button type="button" class="btn btn-primary" onclick="history.back()">
                                        返回
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- onclick="if(confirm('確認要送出本表單嗎？')==true)this.form.submit();"-->


@endsection
