<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/CookieUtil.php";

CookieUtil::removeCookieMd5("udirect_adm_ck_auto");
CookieUtil::removeCookieMd5("udirect_adm_ck_userid");

    session_start();

	header("Pragma:no-cache");
	header("Cache-Control:no-cache");
	header("Cache-Control:no-store");

	session_destroy();
	
	header("Location: http://".$_SERVER[SERVER_NAME]."/admin/");
?>
<html>
    <head></head>
    <body onload="noBack();" onpageshow="if(event.persisted) noBack();" onunload="" style="background-color: #e1d8d88c;">

        <script type="text/javascript">
        window.history.forward();
        function noBack(){window.history.forward();}
        </script>

	</body>
</html>
