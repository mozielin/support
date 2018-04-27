@extends('layouts.master')
@section('contentm')



@foreach($data as $udata)
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Users ID :{{$udata->id}}</div>

                        <div class="panel-heading">
                            name : {{$udata->name}}
                        </div>
                 <div class="panel-body">
                    email : {{$udata->email}}
                </div>

                </div>
        </div>
    </div>
</div>
@endforeach



@endsection

 
