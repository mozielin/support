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

	    @foreach($company as $cdata)
	    	<tr>
		    <!-- Headings -->
			    <td><h1>{{$cdata->id}}</h1></td>

			    <!--  Bold -->
			    <td><b>{{$cdata->status_name}}</b></td>

			    <td><strong>{{$cdata->created_at}}</strong></td>

			    <!-- Italic -->
			    <td><i>{{$cdata->updated_at}}</i></td>

			   
		    </tr>
	    @endforeach


    </table>
</body>
</html>
