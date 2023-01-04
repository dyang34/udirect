<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_data.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/ip_check.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/RequestUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/admin/AdmMemberMgr.php";

if (LoginManager::getManagerLoginInfo("grade_0") < 10) {
    echo "작업 권한이 없습니다.    ";
    exit;
}

$_name = RequestUtil::getParam("_name", "");
$_grade = RequestUtil::getParam("_grade", "");
$_order_by = RequestUtil::getParam("_order_by", "reg_date");
$_order_by_asc = RequestUtil::getParam("_order_by_asc", "desc");

$wq = new WhereQuery(true, true);
$wq->addAndString2("fg_del","=","0");
$wq->addAndLike("name",$_name);

if(!empty($_grade)) {
    $wq->addAndString("grade","=",$_grade."|+|");
}

$wq->addOrderBy($_order_by, $_order_by_asc);

$rs = AdmMemberMgr::getInstance()->getList($wq);

Header("Content-type: application/vnd.ms-excel");
Header("Content-Disposition: attachment; filename=UDIRECT_회원 리스트_".date('Ymd').".xls");
Header("Content-Description: PHP5 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");
?>
<style>
td{font-size:11px;text-align:center;}
th{font-size:11px;text-align:center;color:white;background-color:#000081;}
</style>
<table cellpadding=3 cellspacing=0 border=1 bordercolor='#bdbebd' style='border-collapse: collapse'>
	<tr style="height:30px;">
		<th style="color:white;background-color:#000081;">No</th>
		<th style="color:white;background-color:#000081;">아이디</th>
		<th style="color:white;background-color:#000081;">이름</th>
		<th style="color:white;background-color:#000081;">권한</th>
<?/*		
		<th style="color:white;background-color:#000081;">외부 접속</th>
*/?>		
		<th style="color:white;background-color:#000081;">상담알림</th>
		<th style="color:white;background-color:#000081;">Hiworks ID</th>
		<th style="color:white;background-color:#000081;">휴대폰</th>
		<th style="color:white;background-color:#000081;">이메일</th>
		<th style="color:white;background-color:#000081;">최종 로그인</th>
		<th style="color:white;background-color:#000081;">등록일</th>
	</tr>
<?php
if($rs->num_rows > 0) {
    for($i=0;$i<$rs->num_rows;$i++) {
        $row = $rs->fetch_assoc();

		$arrRowGrade = explode('|+|', $row['grade']);
?>
                    <tr>
                    	<td class="tbl_first"><?=$i+1?></td>
                        <td><?=$row["userid"]?></td>
                        <td><?=$row["name"]?></td>
                        <td><?=$arrMemGrade[0][$arrRowGrade[0]]?></td>
<?/*		
						<td><?=$row["udirect_fg_outside"]>0?"<font color='blue'>가능</font>":"<font color='gray'>불가</font>"?></td>
*/?>
						<td><?=$row["grade_alarm"]=="1"?"Y":"N"?></td>
						<td><?=$row["hiworks_id"]?></td>
                        <td><?=$row["hp_no"]?></td>
                        <td><?=$row["email"]?></td>
						<td><?=$row["last_login"]?></td>
                        <td><?=$row["reg_date"]?></td>
                    </tr>
<?php
    }
}
?>
</table>
<?php
@ $rs->free();
?>