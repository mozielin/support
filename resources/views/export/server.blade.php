<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
			<td>ID</td>
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

	    @foreach($server as $sdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$sdata->id}}</td>
		    	<td>{{$sdata->build_type}}</td>
		    	<td>{{$sdata->company_name}}</td>
			    <td>{{$sdata->server_name}}</td>
			    <td>{{$sdata->company_business_code}}</td>
			    <td>{{$sdata->company_server_mac}}</td>
			    <td>{{$sdata->URL}}</td>
			    <td>{{$sdata->company_version_num}}</td>
			    <td>{{$sdata->sync_ver}}</td>
			    <td>
			    @foreach($vdata as $version)
			    	@if($version->vernum == $sdata->sync_ver)		    	
						{{$version->name}}
			    	@endif
				@endforeach
				</td>			  
			   	<td>
			    @foreach($users as $udata)
			    	@if($udata->id == $sdata->company_server_update)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			   	<td>{{$sdata->updated_at}}</td>
			   	<td>{{$sdata->note}}</td>    
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
