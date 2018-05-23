<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司方案</td>
		    <td>建檔</td>
		    <td>申請日</td>
		    <td>客戶名稱</td>
		    <td>所在地</td>
		    <td>申請人姓名email</td>
		    <td>公司產業別</td>
		    <td>案件狀態</td>
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($company as $cdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$cdata->id}}</td>
		    	<td>{{$cdata->plan_name}}</td>
			    <td>{{$cdata->name}}</td>
			    <td>{{$cdata->company_create}}</td>
			    <td>{{$cdata->company_name}}</td>
			    <td>{{$cdata->area_name}}</td>
			    <!-- Italic -->
			    <td>
			    @foreach($applicant as $adata)
			    	@if($adata->company_id == $cdata->id)		    	
						{{$adata->applicant_name}}:{{$adata->company_applicant_email}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
			    	@endif
				@endforeach
			   	</td>
			   	<td>{{$cdata->company_industry_name}}</td>
			   	<td>{{$cdata->status_name}}</td>
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
