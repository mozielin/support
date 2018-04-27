@extends('layouts.master')
@section('contentm')


<!docuser html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align:center;">User Info    
          </div>
          
          <div class="panel-body">

            <!<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="id" class="col-md-6 control-label" style="text-align:center;">ID:{{$user->id}}</label>
            <label for="name" class="col-md-6 control-label" style="text-align:center;">Name:{{$user->name}}</label>  
            <label for="email" class="col-md-6 control-label" style="text-align:center;">Email:{{$user->email}}</label> 
            <label for="group" class="col-md-6 control-label" style="text-align:center;">Group:{{$user->user_group}}</label> 
            <!</div>
            <div class="col-md-2  ">
              <button type="button" class="btn btn-primary" onclick="location.href='{{route('user_delete', $user->id)}}'">
                刪除
              </button>
            </div>

            <div class="col-md-2 col-md-offset-8" >
              <button type="button" class="btn btn-primary" style="float:right" onclick="location.href='{{route('user_edit', $user->id)}}'">
                修改
              </button>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>

@endsection


