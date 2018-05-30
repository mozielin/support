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
		    <!-- Headings -->
		    @foreach($manager as $mdata)
		    	@if($mdata->company_id == $tdata->id)
		    	<td>{{$sdata->id}}</td>
		    @endforeach
		    	<td>{{$sdata->company_name}}</td>
			    <td>{{$sdata->server_name}}</td>
			    <td>{{$sdata->company_server_type}}</td>
			    <td>{{$sdata->company_business_code}}</td>
			    <td>{{$sdata->company_server_mac}}</td>
			    <td>{{$sdata->company_server_interip}}</td>
			    <td>{{$sdata->company_server_extip}}</td>
			    <td>{{$sdata->company_version_num}}</td>
			    <td>{{$sdata->build_type}}</td>
			    <td>{{$sdata->sync_ver}}</td>
			    <td>
			    @foreach($users as $udata)
			    	@if($udata->id == $sdata->company_server_builder)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>    
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
