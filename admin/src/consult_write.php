<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_data.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/ip_check.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/RequestUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/udirect/consult/ConsultMgr.php";

$menuNo = [1,1,1];

$grade_0 = LoginManager::getManagerLoginInfo("grade_0");
if ($grade_0 < 5) {
    JsUtil::alertBack("작업 권한이 없습니다.    ");
    exit;
}

$mode = RequestUtil::getParam("mode", "INS");
$ucr_idx = RequestUtil::getParam("ucr_idx", "");

if ($mode=="UPD") {
    //    if(empty($userid)) {
    if(!$ucr_idx) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x01)   ");
        exit;
    }
    
    $row = ConsultMgr::getInstance()->getByKey($ucr_idx);
    
    //    if (empty($row)) {
    if (!$row) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x02)   ");
        exit;
    }
} else {
    //    if(!empty($userid)) {
    if($ucr_idx) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x04)   ");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT']."/admin/include/header.php";
?>
<div class="write-area">
    <div class="title-area">
        <h2>컨텐츠 등록</h2>
    </div>
    <div class="write-box">
        <form name="writeForm" action="./consult_write_act.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?=$mode?>" />
            <input type="hidden" name="ucr_idx" value="<?=$ucr_idx?>" />
            <input type="hidden" name="auto_defense" />
            <table class="table-write">
                <colgroup>
                    <col width="12%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>성명</th>
                        <td><?=$row['name']?></td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td><?=$row['hp']?></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><?=nl2br($row["content"])?></td>
                    </tr>
                    <tr>
                        <th>등록일</th>
                        <td><?=$row['regdate']?></td>
                    </tr>                    
                    <tr>
                        <th>문의유형</th>
                        <td>
<?/*                            
                        <div class="select-box" style="width: 150px;">
                            <select name="category">
<?php
    for($i=0;$i<count($arrInsurCategory);$i++) {
?>
                                <option value="<?=$arrInsurCategory[$i]?>" <?=$row['category']==$arrInsurCategory[$i]?"selected":""?>><?=$arrInsurCategory[$i]?></option>
<?php
    }
?>
                            </select>
                        </div>
*/?>
                            <input type="hidden" name="category" value="<?=$row['category']?>" />
                            <?=$row['category']?>
                        </td>
                    </tr>                    
                    <tr>
                        <th>처리여부</th>
                        <td>
                        <div class="select-box" style="width: 120px;">
                            <select name="fg_process">
                                <option value="0" <?=$row['fg_process']!="1"?"selected":""?>>미처리</option>
                                <option value="1" <?=$row['fg_process']=="1"?"selected":""?>>완료</option>
                            </select>
                        </div>                            
                        </td>
                    </tr>
                    <tr>
                        <th>처리메모</th>
                        <td><textarea name="memo" class="textarea"><?=$row["memo"]?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </form>

        <div class="button-center">
            <a href="#" name="btnCancel" class="button lineGray2 large">목록</a>
            <a href="#" name="btnSave" class="button line-basic large">저장</a>
<?php
if ($mode=="UPD" && !($grade_0 > 5 && $grade_0 < 10)) {
?>
            <a href="#" name="btnDel" class="button lineRed large">삭제</a>
<?php
}
?>					
        </div>
    </div>
</div>

<script src="/js/ValidCheck.js?t=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/js/ValidCheck.js")?>"></script>	
<script type="text/javascript">
var mc_consult_submitted = false;

$(document).on("click","a[name=btnSave]",function() {
	if(mc_consult_submitted == true) { return false; }
	
	var f = document.writeForm;

	f.auto_defense.value = "identicharmc!@";
	mc_consult_submitted = true;

    f.submit();	

    return false;
});

$(document).on("click","a[name=btnDel]",function() {
	if (!confirm("정말 삭제하시겠습니까?    ")) {
		return false;
	}
	
	if(mc_consult_submitted == true) { return false; }

	var f = document.writeForm;

	f.mode.value="DEL";
	
	f.auto_defense.value = "identicharmc!@";
	mc_consult_submitted = true;

    f.submit();	

    return false;
});

$(document).on("click","a[name=btnCancel]",function() {

	history.back();

    return false;
});

</script>	

<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/include/footer.php";
?>