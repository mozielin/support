<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>公司名稱</td>
		    <td>伺服器名稱</td>
		    <td>伺服器類型</td>
		    <td>teamplus code</td>
		    <td>MAC位置</td>
		    <td>內部IP</td>
		    <td>對外IP</td>
		    <td>安裝版號</td>
		    <td>建置類型</td>
		    <td>同步版號</td>
		    <td>建立者</td>

		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($server as $sdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$sdata->id}}</td>
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
