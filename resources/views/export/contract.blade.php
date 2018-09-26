<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>合約標題</td>
		    <td>合約狀態</td>
		    <td>合約方案</td>
		    <td>開始日期</td>
		    <td>結束日期</td>
		    <td>簽約日期</td>
		    <td>驗收日期</td>
		    <td>合約總價</td>
		    <td>授權人數</td>
		    <td>備註</td>
		    <td>建立者</td>
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($contract as $cdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$cdata->id}}</td>
		    	<td>{{$cdata->company_name}}</td>
			    <td>{{$cdata->contract_title}}</td>
			    <td>{{$cdata->status_name}}</td>
			    <td>{{$cdata->plan_name}}</td>
			    <td>{{$cdata->company_contract_start}}</td>
			   	<td>{{$cdata->company_contract_end}}</td>
			   	<td>{{$cdata->company_contract_date}}</td>
			   	<td>{{$cdata->company_contract_check}}</td>
			   	<td>{{$cdata->contract_price}}</td>
			   	<td>{{$cdata->contract_quantity}}</td>
			   	<td>{{$cdata->note}}</td>
			   	<td>
			    @foreach($users as $udata)
			    	@if($udata->id == $cdata->company_contract_builder)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
