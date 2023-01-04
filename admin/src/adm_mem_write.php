<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_data.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/ip_check.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/RequestUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/admin/AdmMemberMgr.php";

$menuNo = [9,9,1];

if (LoginManager::getManagerLoginInfo("grade_0") < 10) {
    JsUtil::alertBack("작업 권한이 없습니다.    ");
    exit;
}

$mode = RequestUtil::getParam("mode", "INS");
$userid = RequestUtil::getParam("userid", "");

if ($mode=="UPD") {
    //    if(empty($userid)) {
    if(!$userid) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x01)   ");
        exit;
    }
    
    $row = AdmMemberMgr::getInstance()->getByKey($userid);
    
    //    if (empty($row)) {
    if (!$row) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x02)   ");
        exit;
    }
} else {
    //    if(!empty($userid)) {
    if($userid) {
        JsUtil::alertBack("잘못된 경로로 접근하였습니다. (ErrCode:0x04)   ");
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT']."/admin/include/header.php";
?>
<div class="write-area">
    <div class="title-area">
        <h2>회원 등록</h2>
    </div>
    <div class="write-box">
        <form name="writeForm" action="./adm_mem_write_act.php" method="post">
            <input type="hidden" name="mode" value="<?=$mode?>" />
            <input type="hidden" name="auto_defense" />
            <table class="table-write">
                <colgroup>
                    <col width="12%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th><span style="display:inline-block;width:10px;">*</span>ID</th>
                        <td>
<?php
if ($mode=="UPD") {
?>
									<?=$userid?><input type="hidden" value="<?=$userid?>" name="userid" />
<?php
    
} else {
?>    									
    								<input type="text" value="" name="userid" class="input01" placeholder="ID를 입력하세요." style="width: 200px;">
<?php
}
?>
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;">*</span>비밀번호</th>
                        <td>
                            <input type="text" name="passwd" class="input01" placeholder="<?=$mode=="UPD"?"비밀번호 변경시에만 입력.":"비밀번호를 입력하세요."?>" style="width: 200px;">
<?php
if ($mode=="UPD") {
?>
									<span style="color:red;"> ※ 비밀번호 변경시에만 입력해 주십시오.</span>
<?php
}
?>
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;">*</span>이름</th>
                        <td>
                            <input type="text" name="name" class="input01" value="<?=$row['name']?>" placeholder="이름을 입력하세요." style="width: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;">*</span>권한</th>
                        <td>
                            <div class="select-box" style="width: 200px;">                                
                                <select name="grade" class="select_brand">
<?php
$arrMemGradeKey = array_keys($arrMemGrade[0]);
$arrMemGradeVal = array_values($arrMemGrade[0]);

for($ii=0;$ii<count($arrMemGradeKey);$ii++) {
?>
<option value="<?=$arrMemGradeKey[$ii]?>" <?=$row['grade']==$arrMemGradeKey[$ii]?"selected":""?>><?=$arrMemGradeVal[$ii]?></option>
<?php    
}
?>                					
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;"></span>알림</th>
                        <td>
                            <div class="choice-round">
                                <input type="checkbox" id="grade_alarm" name="grade_alarm" value="1" <?=$row['grade_alarm']=="1"?"checked='checked'":""?> />
                                <label for="grade_alarm">U-Direct 상담 알림<span class="box"></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;"></span>Hiworks ID</th>
                        <td>
                            <input type="text" name="hiworks_id" class="input01" value="<?=$row['hiworks_id']?>" placeholder="하이웍스 아이디를 입력하세요." style="width: 200px;">
                        </td>
                    </tr>                    
                    <tr>
                        <th><span style="display:inline-block;width:10px;"></span>휴대폰</th>
                        <td>
                            <input type="text" name="hp_no" class="input01" value="<?=$row['hp_no']?>" placeholder="[선택] 휴대폰 번호를 입력하세요." style="width: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <th><span style="display:inline-block;width:10px;"></span>이메일</th>
                        <td>
                            <input type="text" name="email" class="input01" value="<?=$row['email']?>" placeholder="[선택] 이메일을 입력하세요." style="width: 500px;">
                        </td>
                    </tr>
<?/*                            
                            <tr>
                                <th>외부 접속</th>
                                <td>
                                                            <div class="select-box" style="width: 200px;">                                
                					<select name="udirect_fg_outside" class="select_brand">
										<option value="0" <?=$row['udirect_fg_outside']=="0"?"selected":""?>>불가</option>
										<option value="1" <?=$row['udirect_fg_outside']=="1"?"selected":""?>>가능</option>
                					</select>
                					</div>
                                </td>
                            </tr>
*/?>                            
                </tbody>
            </table>
        </form>

        <div class="button-center">
            <a href="#" name="btnCancel" class="button lineGray2 large">목록</a>
            <a href="#" name="btnSave" class="button line-basic large">저장</a>
<?php
if ($mode=="UPD") {
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

	if ( VC_inValidText(f.userid, "ID") ) return false;
<?php
if ($mode=="INS") {
?>
	if ( VC_inValidText(f.passwd, "비밀번호") ) return false;
<?php
}
?>
	if ( VC_inValidText(f.name, "이름") ) return false;
	
	
	//var reg_engnum = /^[A-Za-z0-9+]{4,20}$/;
	var reg_engnum = /^[A-Za-z0-9+\d$@$!%*#?&]{4,20}$/;
	
	if (f.passwd.value!="") {
    	if (!reg_engnum.test(f.passwd.value)) {
            alert("비밀번호는 숫자와 영문, 일부 특수문자($@$!%*#?&)만 가능하며, 4~20자리여야 합니다.    ");
            f.passwd.focus();
            return;
    	}
	}

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