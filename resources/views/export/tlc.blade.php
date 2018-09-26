<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>開始日期</td>
		    <td>結束日期</td>
		    <td>建立者</td>
		
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($tlc as $tdata)t
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$tdata->id}}</td>
		    	<td>{{$tdata->company_name}}</td>
			    <td>{{$tdata->company_tlc_start}}</td>
			    <td>{{$tdata->company_tlc_end}}</td>
			    <td>
			    @foreach($users as $udata)
			    	@if($udata->id == $tdata->builder)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
		    </tr>
	    @endforeach


    </table>
</body>
</html>
