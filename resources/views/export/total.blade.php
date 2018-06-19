<html>
<body>
	<table>
		<tr>
		    <!-- Headings -->
		    <td>序號</td>
		    <td>申請日</td>
		    <td>申請方案</td>
		    <td>統一編號</td>
		    <td>客戶名稱</td>
		    <td>英文名稱</td>		    
		    <td>公司資本</td>
		    <td>公司產業別</td>
		    <td>公司型態</td>
		    <td>公司地區</td>
		    <td>公司電話</td>
		    <td>業務</td>
		    <td>案件狀態</td>
		    <td>客戶資料備註</td>
		    <td>聯絡人資料</td>
		    <td>簽約日期</td>
		    <td>合約方案</td>
		    <td>保固開始</td>
		    <td>保固結束</td>
		    <td>合約總價</td>
		    <td>授權人數</td>
		    <td>驗收日期</td>
		    <td>合約狀態</td>
		    <td>合約備註</td>
		    <td>Lic開始日期</td>
		    <td>Lic結束日期</td>
		    <td>相關人員</td>

		    
		    <!--  Bold -->
		   
	    </tr>


	    @foreach($company as $cdata)
	    	<tr>
		    <!-- Headings -->
		    	<td>{{$cdata->id}}</td> 
		    	<td>{{$cdata->created_at}}</td>
			    <td>{{$cdata->plan_name}}</td>
		    	<td>{{$cdata->company_EIN}}</td>
			    <td>{{$cdata->company_name}}</td>
			    <td>{{$cdata->company_engname}}</td>
			    <td>{{$cdata->company_capital}}</td>
			    <td>{{$cdata->company_industry_name}}</td>
			    <td>{{$cdata->company_type_name}}</td>
			    <td>{{$cdata->area_name}}{{$cdata->company_area2}}</td>
			    <td>{{$cdata->company_cel}}</td>
			    <td>
			    @foreach($users as $udata)
			    	@if($udata->id == $cdata->com_sales_id)		    	
						{{$udata->name}}
			    	@endif
				@endforeach
			   	</td>
			    <td>{{$cdata->status_name}}</td>
			    <td>{{$cdata->note}}</td>
			    <td>
			    @foreach($applicant as $adata)
			    	@if($adata->company_id == $cdata->id)		    	
						{{$adata->applicant_name}}:{{$adata->company_applicant_email}}:
						@if($adata->company_applicant_phone)
						{{$adata->company_applicant_phone}}
						@else
						{{$adata->company_applicant_mobile}}
						@endif
						<br style='mso-data-placement:same-cell;wrap-text: true;'/>
			    	@endif
				@endforeach
			   	</td>
				@foreach($contract as $ccdata)
					@if($ccdata->company_contract == $cdata->id)	
					    <td>{{$ccdata->company_contract_date}}</td>
					    <td>{{$ccdata->plan_name}}</td>
					    <td>{{$ccdata->company_contract_start}}</td>
					    <td>{{$ccdata->company_contract_end}}</td>
					    <td>{{$ccdata->contract_price}}</td>
					    <td>{{$ccdata->contract_quantity}}</td>
					    <td>{{$ccdata->company_contract_check}}</td>
					    <td>{{$ccdata->status_name}}</td>
					    <td>{{$ccdata->note}}</td>
			    		@break
			    	@else
			    		<td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    @break
			    	@endif

				@endforeach
				@foreach($license as $ldata)
			    	@if($ldata->company_id == $cdata->id)		    	
						<td>{{$ldata->start_at}}</td>
						<td>{{$ldata->expir_at}}</td>
						@break
					@else
						<td></td>
					    <td></td>
					    @break
			    	@endif
				@endforeach
				 <td>
			    @foreach($manager as $mdata)
			    	@if($mdata->company_id == $cdata->id)	
						 @foreach($users as $udata)
					    	@if($udata->id == $mdata->user_id)		    	
								{{$udata->name}}:{{$udata->email}}<br style='mso-data-placement:same-cell;wrap-text: true;'/>
					    	@endif
						@endforeach
			    	@endif
				@endforeach
			   	</td>
	
			   	
		    </tr>
	    @endforeach


    </table>
</body>
</html>
