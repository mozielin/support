@extends('layouts.master')
@section('contentm')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
    	{!!Form::open(['url'=>'user_group/store', 'method'=>'post'])!!}
    	{!!Form::label('name','新增')!!}<br>
    	{!!Form::text('user_group_name')!!}<br>
    	{!!Form::submit('發表文章')!!}
    	{!!Form::close()!!}
      </div>
    </div>
</div>

@endsection
