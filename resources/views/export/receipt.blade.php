<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>合約標題</td>
		    <td>發票號碼</td>
		    <td>發票金額</td>
		    <td>發票日期</td>
		    <td>備註</td>
		    <td>建立者</td>
		  
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($receipt as $rdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$rdata->id}}</td>
		    	<td>{{$rdata->company_name}}</td>
		    	<td>{{$rdata->contract_title}}</td>
			   	<td>{{$rdata->rcpnum}}</td>
			    <td>{{$rdata->price}}</td>
			    <td>{{$rdata->rcpdate}}</td>
			    <td>{{$rdata->note}}</td>
				<td>
			    @foreach($users as $udata)
			    	@if($udata->id == $rdata->builder)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
