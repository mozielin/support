@extends('layouts.app')
@section('content')
<div class="all">
        <div class="img-width">
         <img src="pic/team+.png" style="width:20%;" >
	</div>
        <div class="img-width">
         <h4>親愛的{{Auth::user()->name}}您好</h4>
        </div>
<div>

<div class="drop-menu">
     <ul class="drop-down-menu">
        <li><a href="#">客戶資料</a>
            <ul>
                </li>
                <li><a href="#">客戶總覽</a>
                </li>
                <li><a href="#">客戶方案</a>
                </li>
                <li><a href="#">server-info</a>
                </li>
                <li><a href="#">案件型態</a>
                </li>
                <li><a href="#">公司型態</a>
                </li>
                <li><a href="#">公司產業別</a>
                </li>
            </ul>
        </li>
	<li><a href="#">使用者</a>
        </li>
	<li><a href="#">合約與發票</a>
            <ul>
                <li><a href="#">合約內容</a>
                    <ul>
                       	<li><a href="#">Magento與POS訂單系統整合</a>
                        </li>
                       	<li><a href="#">Magento與CRM客戶管理系統整合</a>
                       	</li>
                        <li><a href="#">Magento與ERP管理系統整合</a>
                        </li>
                        <li><a href="#">Magento金流串接服務</a>
                        </li>
                    </ul>
				
                </li>
                <li><a href="#">發票資訊</a>
                    <ul>
                        <li><a href="#">響應式網頁設計 (Responsive Web Design)</a>
                        </li>
                        <li><a href="#">手機網站設計</a>
                        </li>
                        <li><a href="#">WordPress 網頁設計</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
	<li><a href="#">聯絡人</a>
        </li>
	<li><a href="#">資訊分享</a>
        </li>
	<li><a href="#">聯絡我們</a>
        </li>
    </ul>
</div>
@foreach($testt as $test)
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Users ID :{{$test->id}}</div>
	
			<div class="panel-heading">
			    name : {{$test->name}}
            		</div>
		 <div class="panel-body">
                    email : {{$test->email}}
                </div>

		</div>
        </div>
    </div>
</div>
@endforeach

@endsection
