<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/login/LoginManager.php";

if (!LoginManager::isManagerLogined()) {
    JsUtil::alertReplace("로그인 하시기 바랍니다.", "/admin");
    exit;
}

/*
if (empty(LoginManager::getUserLoginInfo('ulife_fg_outside'))) {
    if(!preg_match("/^121.160.51.243/",$_SERVER['REMOTE_ADDR'])) {

        CookieUtil::removeCookieMd5("ulife_adm_ck_auto");
        CookieUtil::removeCookieMd5("ulife_adm_ck_userid");
        
        session_start();
        
        header("Pragma:no-cache");
        header("Cache-Control;no-cache");
        header("Cache-Control;no-store");
        
        session_destroy();
        
        JsUtil::alertReplace("외부 접속이 허용되지 않습니다.   ","/");
        exit;
    }
}
*/
?>
