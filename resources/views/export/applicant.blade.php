<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>職稱</td>
		    <td>部門</td>
		    <td>客戶姓名</td>
		    <td>客戶Email</td>
		    <td>聯絡手機</td>
		    <td>聯絡電話</td>
		    <td>備用Email</td>
		    <td>備註</td>
		    <td>建立者</td>
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($applicant as $adata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$adata->id}}</td>
		    	<td>{{$adata->company_name}}</td>
		    	<td>{{$adata->company_applicant_title}}</td>
			   	<td>{{$adata->company_applicant_dep}}</td>
			    <td>{{$adata->applicant_name}}</td>
			    <td>{{$adata->company_applicant_email}}</td>
			    <td>{{$adata->company_applicant_mobile}}</td>
			    <td>{{$adata->company_applicant_phone}}</td>
			   	<td>{{$adata->company_applicant_email2}}</td>
			   	<td>{{$adata->applicant_note}}</td>
				<td>
			    @foreach($users as $udata)
			    	@if($udata->id == $adata->company_applicant_builder)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
