<!DOCTYPE html>
<html>
	<head>
		
		@section('app')
			@include('layouts.app')
		@show
	</head>
	<body>
		
			<div class="box" style="position:relative;top:0; width:1400px;min-height:100%;margin:auto;">

				@include('layouts.left')
		
  				<div id="loading" class="lds-pacman" style="height:100%;z-index:99;position:absolute;left:650px;top:200px;" >
  				<img src="/storage/teamplus_load.gif">   
				</div>

					
				@yield('contentm')
			</div>

			<div class="footer" style="position:relative;bottom: 0px;height:100px;color:#929292;margin-top:50px;margin-left:100px;z-index:-1;">
                    <div class="cometa">
                        <div class="footerLogo">
                            <img src="/pic/team+.png" style="width:100%;padding-top:15px;" alt="">
                        </div>
                        <div class="Lcom" style="padding-left:20px;">
                        	<p id="IDESK_FOOTER_footerDesc1">©2017-2018 互動資通客服系統. All rights reserved.</p>
                           
                            <p id="IDESK_FOOTER_footerDesc2">本網站只支援Chrome，最佳瀏覽解析度為1024x768以上，</p>
							
							<p id="IDESK_FOOTER_footerDesc1">調整舒適的螢幕大小比例。</p>
                        </div>
                        <div class="Rcom" style="padding-left:20px;">
                            <p id="IDESK_FOOTER_footerDesc1">客服專線：分機直播362</p>
                            <p id="IDESK_FOOTER_footerDesc2">客服信箱：peter@teamplus.com.tw</p>
                            <p id="IDESK_FOOTER_footerDesc3">地址：新北市新店區北新路三段207-3號11樓(互動資通)</p>
                        </div>
                        <div class="clear"></div>
                    </div>
    		</div>
			
	</body>
<script>

	$(window).load(function(){
        $('#loading').fadeOut(800);
    });

</script>

</html>
