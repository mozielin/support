<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    	<h2>Hi,{{$contract->name}}</h2>
    	<font size="4">您於
        <font size="4" style="color:#0000CC;">{{$contract->company_contract_start}}</font>
        簽署之
        <font size="4" style="color:#FF6600;">{{$contract->company_name}}</font>
        即將於
        <font size="4" style="color:#0000CC;">{{$contract->company_contract_end}}</font>約滿到期，
        </font>
    	<P>特發此提醒，敬請把握續約黃金時機。</P>
    	<P>預祝您一切順利！</P>
        <P>
            此為系統自動發送，請勿回覆。您若要聯絡我們，請傳送到 support@teamplus.com.tw 我們便會回覆您。
        </P>
    </body>
</html>