<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		  

		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($ldata as $ldda)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$ldda->company_id}}</td>
		    	<td>{{$ldda->company_name}}</td>
			  
		    </tr>
	    @endforeach


    </table>
</body>
</html>
