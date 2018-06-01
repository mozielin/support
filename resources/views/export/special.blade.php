<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>Email</td>
		    <td>cc</td>
		    <td>bcc</td>
		    <td>Name</td>
		    <td>Upgrate URL</td>
		    <td>Sales messange</td>
		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($temp as $tdata)
	    	<tr>
		    <!-- Headings --><td>
		    @foreach($applicant as $adata)
		    	@if($adata->company_id == $tdata->company_server)
		    	{{$adata->company_applicant_email}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
		    	@endif
		    @endforeach
		    </td>
		    	<td>
		    	@foreach($users as $udata)
			    	@if($udata->id == $tdata->company_server_builder)
			    		{{$udata->email}}		    		
			    	@endif
				@endforeach
				</td>
				<td>
				@foreach($manager as $mdata)
					@if($mdata->company_id == $tdata->company_server)
			    	{{$mdata->email}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
			    	@endif
				@endforeach
				</td>
			    <td>{{$tdata->company_name}}</td>
			    <td>https://cloud.teamplus.com.tw/enterprise/download.aspx?q={{$tdata->licensekey}}&k={{$k->value}}
				</td>
			    <td>
			    @foreach($users as $udata)
			    	@if($udata->id == $tdata->com_sales_id)
			    		{{$udata->title}}：{{$udata->name}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
						聯絡電話：{{$udata->phone}} 分機 {{$udata->ext}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
						手機號碼：{{$udata->mobile}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
						Email：{{$udata->email}}		    	
						
			    	@endif
				@endforeach
			   	</td>    
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
