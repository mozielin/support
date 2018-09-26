<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>lic名稱</td>
		    <td>開始日期</td>
		    <td>結束日期</td>
		    <td>lic狀態</td>
		    <td>建立者</td>
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($license as $ldata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$ldata->id}}</td>
		    	<td>{{$ldata->company_name}}</td>
		    	<td>{{$ldata->lic_name}}</td>
			    <td>{{$ldata->start_at}}</td>
			    <td>{{$ldata->expir_at}}</td>
			    <td>{{$ldata->status_name}}</td>
			    <td>
			    @foreach($users as $udata)
			    	@if($udata->id == $ldata->builder_id)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			   
		    </tr>
	    @endforeach


    </table>
</body>
</html>
