<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/login/LoginManager.php";

if (!LoginManager::isManagerLogined()) {
    JsUtil::alertReplace("비정상적인 접근입니다."."/admin");
    exit;
}

switch(LoginManager::getManagerLoginInfo('grade_0')) {
    case "1":
        JsUtil::replace("/admin/src/consult_list.php");
        break;
    case "5":
    case "6":
    case "7":
    case "8":
    case "9":
        JsUtil::replace("/admin/src/consult_list.php");
        break;
    case "10":
        JsUtil::replace("/admin/src/adm_mem_list.php");
        break;
    default:
        JsUtil::alertReplace("비정상적인 접근입니다.","/admin");
        exit;
        break;
}
?>