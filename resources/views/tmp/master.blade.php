<!DOCTYPE html>
<html>
	<head>
		
		@section('app')
			@include('layouts.app')
		@show
	</head>
	<body>
		@include('layouts.left')
	
		
			@yield('contentm')
		
	</body>
</html>
