<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/RequestUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/UpdateQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/login/LoginManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/UploadUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/udirect/consult/ConsultMgr.php";

if(!LoginManager::isManagerLogined()) {
    JsUtil::alertReplace("로그인이 필요합니다.    ","/admin");
    exit;
}

if (LoginManager::getManagerLoginInfo("grade_0") < 5) {
    JsUtil::alertBack("작업 권한이 없습니다.    ");
    exit;
}

$mode = RequestUtil::getParam("mode", "INS");
$ucr_idx = RequestUtil::getParam("ucr_idx", "");
$fg_process = RequestUtil::getParam("fg_process", "");
$memo = RequestUtil::getParam("memo", "");
$category = RequestUtil::getParam("category", "기타");

$auto_defense = RequestUtil::getParam("auto_defense", "");

if($auto_defense != "identicharmc!@") {
    JsUtil::alertBack("자동입력방지기능 오류 입니다. 관리자에게 문의해 주세요!   ");
    exit;
}

try {

    if($mode=="UPD") {
        if (empty($ucr_idx)) {
            JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x01)   ");
            exit;
        }

        $row = ConsultMgr::getInstance()->getByKey($ucr_idx);
        
        if (empty($row)) {
            JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x02)   ");
            exit;
        }

        $uq = new UpdateQuery();
        $uq->add("fg_process", $fg_process);
        $uq->add("memo", $memo);
        $uq->add("category", $category);
        $uq->addNotQuot("upddate", "now()");
        
        if ($row["fg_process"]=="0" && $fg_process=="1") {
            $uq->addNotQuot("procdate", "now()");
        }
        
        ConsultMgr::getInstance()->edit($uq, $ucr_idx);

        JsUtil::alertReplace("수정되었습니다.    ", "./consult_list.php");
        
    } else if($mode=="DEL") {
        
        if (empty($ucr_idx)) {
            JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x03)   ");
            exit;
        }
        
        $row = ConsultMgr::getInstance()->getByKey($ucr_idx);
        
        if (empty($row)) {
            JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x02)   ");
            exit;
        }

        ConsultMgr::getInstance()->delete($ucr_idx);

        JsUtil::alertReplace("삭제되었습니다.    ", "./consult_list.php");
        
    } else {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x09)   ");
        exit;
    }
    
} catch(Exception $e) {
    JsUtil::alertBack("Exception 오류 입니다. 관리자에게 문의해 주세요!   ");
    exit;
}
?>