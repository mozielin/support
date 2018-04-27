@extends('layouts.master')
    @section('title')
        <h2 style="margin-top:2px;">新增使用者</h2>
    @endsection
@section('contentm')

<!--中間選單-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    @include('layouts.user_center_block')
</div>

<div class="container" style="width:780px;height:100%;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-heading">新增使用者</div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('user_store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                            <label for="user_role" class="col-md-4 control-label">使用者權限</label>
                        <div class="col-md-6">
                            <select name="user_role" class="form-control">
                            @foreach ($user_role as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach
                            </select>
                                @if ($errors->has('user_role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_group') ? ' has-error' : '' }}">
                            <label for="user_group" class="col-md-4 control-label">User.group</label>

                            <div class="col-md-6">
                            <select name="user_group" class="form-control">
                            @foreach ($group as $gruopdata)                       
                                <option value="{{$gruopdata->id}}">{{$gruopdata->user_group_name}}</option>
                            @endforeach
                            </select>
                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="button" class="btn btn-primary" onclick="history.back()">
                                <i class="glyphicon glyphicon-backward"></i>
                                返回
                                </button> 
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-check"></i>
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

@endsection
