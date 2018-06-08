<!--正上方方塊-->
<div class="container" style="width:780px;height:75px;margin-right:218px;">
    <div class="panel panel-default">
        <div class="panel-heading" style="height:60px;">
            @yield('title')
            <!--<h2 style="margin-top:11px;">標題打在這</h2>-->
        </div>
    </div>
</div>

<!--左上方方塊，absolute:相對於relative的相對位置，調整方式left，top，right，bottom:px-->
<div class="container" style="width:180px;height:160px;float:left;position:absolute;left:220px;top:0;">
    <div class="panel panel-default">
        <div class="panel-heading" style="height:136px;">
            <div class="title" style="text-align:center;">
                <h4>{{Session::get('group', function() { return '新用戶'; })}}</h4>
            </div>
            <hr style="margin:15px;">
            <div class="title-content" style="margin-left:20px;">
                <img class="personal-pic" src="/storage/user_img/{{Auth::user()->user_img}}" alt="" width="30" height="30" /> 
                <span style="margin-left:6px;">{{Auth::user()->name}}</span>
            </div>
        </div>
    </div>
</div>

<!--左邊選單-->
<div class="drop-menu" style="position:absolute;left:220px;top:151px;">
     <ul class="drop-down-menu" style="width:165px;text-align:left;">
        @permission('company_view')
        <li><a href="/company" ><i class="glyphicon glyphicon-briefcase" style="margin-right:10px;"></i> 客戶資料</a>
        </li>
        @endpermission
        @permission('contract_view')
        <li><a href="/contract"><i class="glyphicon glyphicon-file" style="margin-right:10px;"></i> 合約與發票</a>
        </li>
        @endpermission
        @permission('license_view')
        <li><a href="/license"><i class="glyphicon glyphicon-lock" style="margin-right:10px;"></i> License</a></li> 
        @endpermission
        @permission('applicant_view')
    	<li><a href="/applicant"><i class="glyphicon glyphicon-earphone" style="margin-right:10px;"></i> 聯絡人</a></li>
        @endpermission
        @permission('server_view')
        <li><a href="/server"><i class="glyphicon glyphicon-th" style="margin-right:10px;"></i> Server Info</a></li>
        @endpermission
        @permission('seadmin_view')
    	<li><a href="/seadmin"><i class="glyphicon glyphicon-facetime-video" style="margin-right:10px;"></i> TLC管理</a></li> 
        @endpermission
        @permission('bulletin_view') 	
        <li><a href="/bulletin"><i class="glyphicon glyphicon-comment" style="margin-right:10px;"></i> 公告</a></li>
        @endpermission
        @permission('user_view')   
        <li><a href="/user"><i class="glyphicon glyphicon-user" style="margin-right:10px;"></i> 使用者</a></li>
        @endpermission
        @role('devenlope' || 'admin')
        <li><a href="/activity"><i class="glyphicon glyphicon-gift" style="margin-right:10px;"></i> 系統日誌</a></li>
        @endrole
        @role('devenlope' || 'admin')
        <li><a href="/export"><i class="glyphicon glyphicon-cloud-download" style="margin-right:10px;"></i> 匯出管理</a></li>
        @endrole
        @permission('toolbox')
        <li><a href="/tool"><i class="glyphicon glyphicon-wrench" style="margin-right:10px;"></i> Dashboard</a></li>
        @endpermission

    </ul>
</div>






