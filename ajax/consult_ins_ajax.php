<?
require_once $_SERVER['DOCUMENT_ROOT']."/include/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/udirect/consult/ConsultMgr.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/admin/AdmMemberMgr.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/HiworksApiUtil.php";

if (empty($consult_name)) {
	$json_code = array('result'=>'false','msg'=>'성명을 입력해 주세요.');
	echo json_encode($json_code);
	exit;
}

if (empty($consult_hp)) {
	$json_code = array('result'=>'false','msg'=>'연락처를 입력해 주세요.');
	echo json_encode($json_code);
	exit;
}
/*
if (empty($consult_content)) {
	$json_code = array('result'=>'false','msg'=>'문의내용을 입력해 주세요.');
	echo json_encode($json_code);
	exit;
}
*/

$arrIns = array();
$arrIns['name'] = $consult_name;
$arrIns['hp'] = $consult_hp;
$arrIns['content'] = $consult_content;
$arrIns['category'] = $category;

ConsultMgr::getInstance()->add($arrIns);

$wq = new WhereQuery(true, true);
$wq->addAndString2("fg_del","=","0");
$wq->addAndString2("hiworks_id","!=","");
$wq->addAndString("grade_alarm","=","1");

$rs = AdmMemberMgr::getInstance()->getList($wq);

$arrUser = array();
if($rs->num_rows > 0) {
    for($i=0;$i<$rs->num_rows;$i++) {
        $row = $rs->fetch_assoc();

		array_push($arrUser, $row["hiworks_id"]);
	}
}

$link = "https://udirect.co.kr/admin/src/consult_list.php";
$mlink = "https://udirect.co.kr/admin/src/consult_list.php";
$title = "[유다이렉트 상담(".$category.") 유입 알림]";
$message = "유다이렉트에 상담(".$category.")이 등록 되었습니다.
관리자에서 상세 내용을 확인해 주세요.
".$link;

$message_email = "<div>유다이렉트에 상담(".$category.")이 등록 되었습니다.<br/>
관리자에서 상세 내용을 확인해 주세요.<br/><br/>
<a href=\"".$link."\" target=\"_blank\">".$link."</a>";

$arrHiworksRes = HiworksApiUtil::sendAlarm($arrUser, $title, $message, $img, $link, $mlink);

if($category=="주택화재보험") {
	$wq = new WhereQuery(true, true);
	$wq->addAndString2("fg_del","=","0");
	$wq->addAndString("grade_alarm","=","1");
	$wq->addAndLike("grade","8|+|");

	$rs = AdmMemberMgr::getInstance()->getList($wq);

	if($rs->num_rows > 0) {
		for($i=0;$i<$rs->num_rows;$i++) {
			$row = $rs->fetch_assoc();

			if(!empty($row["email"])) {
				HiworksApiUtil::sendMail("bis", $row["email"], "dyang34@bis.co.kr, euni.bis@bis.co.kr","", $title, $message_email);
			}
		}
	}
}

$json_code = array('result'=>'true','msg'=>'success');
echo json_encode($json_code);

@ $rs->free();
exit;
?>