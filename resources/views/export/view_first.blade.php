<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td><h1>Big title</h1></td>

		    <!--  Bold -->
		    <td><b>Bold cell</b></td>
		    <td><strong>Bold cell</strong></td>

		    <!-- Italic -->
		    <td><i>Italic cell</i></td>
	    </tr>

	    @foreach($data as $company)
	    	<tr>
		    <!-- Headings -->
			    <td><h1>{{$company->id}}</h1></td>

			    <!--  Bold -->
			    <td><b>{{$company->status_name}}</b></td>

			    <td><strong>{{$company->created_at}}</strong></td>

			    <!-- Italic -->
			    <td><i>{{$company->updated_at}}</i></td>
		    </tr>
	    @endforeach
    </table>
</body>
</html>
