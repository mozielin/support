<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>建置方式</td>
			<td>公司名稱</td>
			<td>伺服器名稱</td>
			<td>teamplus code</td>
			<td>MAC位置</td>
			<td>站台位置</td>
			<td>安裝版號</td>
			<td>同步版號</td>
			<td>版號對照</td>
			<td>更新者</td>
			<td>更新時間</td>
			<td>備註</td>


		    
		    <!--  Bold -->
		   
	    </tr>

	    @foreach($sdata as $server)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$server->build_type}}</td>
		    	<td>{{$server->company_name}}</td>
			    <td>{{$server->server_name}}</td>
			    <td>{{$server->company_business_code}}</td>
			    <td>{{$server->company_server_mac}}</td>
			    <td>{{$server->URL}}</td>
			    <td>{{$server->company_version_num}}</td>
			    <td>{{$server->sync_ver}}</td>
			    <td>
			    @foreach($vdata as $version)
			    	@if($version->vernum == $server->sync_ver)		    	
						{{$version->name}}
			    	@endif
				@endforeach
				</td>			  
			   	<td>
			    @foreach($udata as $users)
			    	@if($users->id == $server->company_server_update)		    	
						{{$users->name}}
			    	@endif
				@endforeach
			   	</td>
			   	<td>{{$server->updated_at}}</td>
			   	<td>{{$server->note}}</td>  
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
