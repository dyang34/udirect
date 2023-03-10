<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_data.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/ip_check.php";

require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/udirect/consult/ConsultMgr.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/Page.php";

$menuNo = [1,1,1];
$grade_0 = LoginManager::getManagerLoginInfo("grade_0");
if ($grade_0 < 5) {
    JsUtil::alertBack("작업 권한이 없습니다.    ");
    exit;
}

$currentPage = RequestUtil::getParam("currentPage", "1");
$pageSize = RequestUtil::getParam("pageSize", "25");

$_fg_process = RequestUtil::getParam("_fg_process", "");
$_src_type = RequestUtil::getParam("_src_type", "");
$_src_text = RequestUtil::getParam("_src_text", "");
$_order_by = RequestUtil::getParam("_order_by", "fg_process");
$_order_by_asc = RequestUtil::getParam("_order_by_asc", "asc");

switch($grade_0) {
    case 6:
        $_category = RequestUtil::getParam("_category", "여행자보험");
        break;
    case 7:
        $_category = RequestUtil::getParam("_category", "펫보험");
        break;
    case 8:
        $_category = RequestUtil::getParam("_category", "주택화재보험");
        break;
    case 9:
        $_category = RequestUtil::getParam("_category", "건강보험");
        break;
    default;
        $_category = RequestUtil::getParam("_category", "");
        break;
}

$pg = new Page($currentPage, $pageSize);

$wq = new WhereQuery(true, true);
if ($_fg_process!="") {
    $wq->addAndString2("fg_process","=",$_fg_process);
}
$wq->addAndString2("fg_del","=","0");
$wq->addAndString("category","=",$_category);
$wq->addAndLike($_src_type,$_src_text);
$wq->addOrderBy($_order_by, $_order_by_asc);
$wq->addOrderBy("regdate", "desc");

$rs = ConsultMgr::getInstance()->getListPerPage($wq, $pg);

include $_SERVER['DOCUMENT_ROOT']."/admin/include/header.php";
?>
<form name="pageForm" method="get">
    <input type="hidden" name="currentPage" value="<?=$currentPage?>">
    <input type="hidden" name="_src_type" value="<?=$_src_type?>">
    <input type="hidden" name="_src_text" value="<?=$_src_text?>">
    <input type="hidden" name="_category" value="<?=$_category?>">    
    <input type="hidden" name="_order_by" value="<?=$_order_by?>">
    <input type="hidden" name="_order_by_asc" value="<?=$_order_by_asc?>">
</form>

<div class="list-area">
    <div class="title-area">
        <h2>상담 검색</h2>
        <div class="button-right">
<?/*            
            <a href="./consult_write.php" class="button Gray medium">추가</a>            
            <a href="#" name="btnExcelDownload" class="button excel medium">엑셀</a>
*/?>            
        </div>
                </div>
				
	<div class="list-search-wrap">
        <form name="searchForm" method="get" action="consult_list.php">
            <input type="hidden" name="_order_by" value="<?=$_order_by?>">
            <input type="hidden" name="_order_by_asc" value="<?=$_order_by_asc?>">
            <table class="table-search">
                <colgroup>
                    <col style="width:7%;">
                    <col style="width:18%;">
                    <col style="width:7%;">
                    <col style="width:18%;">
                    <col style="width:7%;">
                    <col style="width:18%;">
                    <col style="width:7%;">
                    <col style="width:18%;">
                </colgroup>
                        <tbody>
                            <tr>
                                <th>문의유형</th>
                                <td>
<?php
    if ($grade_0 > 5 && $grade_0 < 10) {
?>
                                <?=$_category?>
<?php
    } else {
?>


                                    <div class="select-box" style="width:150px;">
                                        <select name="_category" depth="1">
                                            <option value="" <?=$_category==""?"selected='selected'":""?>>전체</option>
<?php
        for($i=0;$i<count($arrInsurCategory);$i++) {
?>
                                <option value="<?=$arrInsurCategory[$i]?>" <?=$_category==$arrInsurCategory[$i]?"selected":""?>><?=$arrInsurCategory[$i]?></option>
<?php
        }
?>
                                        </select>
                                    </div>
<?php
    }
?>
                                </td>
                                <th>처리여부</th>
                                <td>
                                    <div class="select-box" style="width:120px;">
                                        <select name="_fg_process" depth="1">
                                            <option value="" <?=$_fg_process==""?"selected='selected'":""?>>전체</option>
                                            <option value="1" <?=$_fg_process=="1"?"selected='selected'":""?>>완료</option>
                                            <option value="0" <?=$_fg_process=="0"?"selected='selected'":""?>>미처리</option>
                                        </select>
                                    </div>
                                </td>
                                <th>검색어</th> 
                                <td colspan="3">
                                    <div class="select-box" style="width:100px;">
                                        <select name="_src_type">
                                            <option value="name" <?=$_src_type=="name"?"selected='selected'":""?>>성명</option>
                                            <option value="hp" <?=$_src_type=="hp"?"selected='selected'":""?>>연락처</option>
                                        </select>
                                    </div>
                                    <input type="text" class="input01" placeholder="검색어" name="_src_text" style="width:80%;" value="<?=$_src_text?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
            <div class="button-center">
<?/*                
                <a href="#" class="button lineNavy large">초기화</a>
*/?>                
                <a href="#" class="button line-basic large mgl5" name="btnSearch">검색</a>
    				</div>
				</form>
			</div>
    <div class="list-title-area">
        <h3>전체 <span class="number"><?=number_format($pg->getTotalCount())?></span>건</h3>
        <div class="filter-area">
            <a href="#none" name="_btn_sort" order_by="fg_process" order_by_asc="asc" class="button filter xsmail <?=($_order_by=="fg_process" && $_order_by_asc=="asc")?"active":""?>">처리여부순</a>
            <a href="#none" name="_btn_sort" order_by="regdate" order_by_asc="desc" class="button filter xsmail <?=($_order_by=="regdate" && $_order_by_asc=="desc")?"active":""?>">최신순</a>
            <a href="#none" name="_btn_sort" order_by="category" order_by_asc="asc" class="button filter xsmail <?=($_order_by=="category" && $_order_by_asc=="asc")?"active":""?>">문의유형순 <i class="icon-up">올림차순</i></a>
            <a href="#none" name="_btn_sort" order_by="category" order_by_asc="desc" class="button filter xsmail <?=$_order_by=="category" && $_order_by_asc=="desc"?"active":""?>">문의유형순 <i class="icon-down">내림차순</i></a>
        </div>
    </div>
           
    <div class="list-cont-wrap">
        <table class="table-basic fixed">
           	<colgroup>
                <col width="5%">
                <col width="10%">
                <col width="10%">
                <col width="8%">
                <col width="">
                <col width="5%">
                <col width="">
                <col width="8%">
                <col width="8%">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>문의유형</th>
                    <th>성명</th>
                    <th>연락처</th>
                    <th>내용</th>
                    <th>처리여부</th>
                    <th>처리메모</th>
                    <th>처리일</th>
                    <th>등록일</th>
                </tr>
            </thead>
            <tbody>
<?php
if($rs->num_rows > 0) {
    for($i=0;$i<$rs->num_rows;$i++) {
        $row = $rs->fetch_assoc();
?>
                <tr>
                    <td><?=$pg->getMaxNumOfPage() - $i?></tdle=>
                    <td><a href="./consult_write.php?mode=UPD&ucr_idx=<?=$row["ucr_idx"]?>"><?=$row["category"]?></a></td>
                    <td><a href="./consult_write.php?mode=UPD&ucr_idx=<?=$row["ucr_idx"]?>"><?=$row["name"]?></a></td>
                    <td class="left"><a href="./consult_write.php?mode=UPD&ucr_idx=<?=$row["ucr_idx"]?>"><?=$row["hp"]?></a></td>
                    <td class="left clamp"><a href="./consult_write.php?mode=UPD&ucr_idx=<?=$row["ucr_idx"]?>"><?=$row["content"]?></a></td>
                    <td><?=$row["fg_process"]=="1"?"<font color='blue'>완료</font>":"<font color='red'>미처리</font>"?></td>
                    <td class="left clamp"><?=$row["memo"]?></td>
                    <td><?=$row["procdate"]?></td>
                    <td><?=$row["regdate"]?></td>
                </tr>
<?php
    }
} else {
?>
				<tr><td colspan="9" style="text-align:center;">No Data.</td></tr>
<?php
}
?>                
            </tbody>
        </table>
    </div>
            
	<div class="list-bottom-area">
		<?=$pg->getNaviForFuncBIS("goPage", "<<", "<", ">", ">>")?>
<?/*        
		<div class="button-right">
			<a href="./consult_write.php" class="button line-basic large">등록하기</a>
		</div>
*/?>        
    </div>

<script type="text/javascript">
/*
$(document).on('click','a[name=btnExcelDownload]', function() {
	var f = document.pageForm;
	f.target = "_new";
	f.action = "consult_list_xls.php";
	
	f.submit();
});
*/
var goPage = function(page) {
	var f = document.pageForm;
	f.currentPage.value = page;
	f.action = "consult_list.php";
	f.submit();
}

$(document).on('click', 'a[name=_btn_sort]', function() {
	goSort($(this).attr('order_by'), $(this).attr('order_by_asc'));
});

var goSort = function(p_order_by, p_order_by_asc) {
	var f = document.pageForm;
	f.currentPage.value = 1;
	f._order_by.value = p_order_by;
	f._order_by_asc.value = p_order_by_asc;
	f.action = "consult_list.php";
	f.submit();
}

$(document).on("click","a[name=btnSearch]",function() {
	
	var f = document.searchForm;
	
    f.submit();	
    
});

</script>            
<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/include/footer.php";

@ $rs->free();
?>