<?php
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/util/JsUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/login/LoginManager.php";

if (!LoginManager::isManagerLogined()) {
    //    JsUtil::alertBack("비정상적인 접근입니다. (ErrCode:0x05)    ");
    JsUtil::alertReplace("로그인이 필요합니다.    ","/admin/");
}

if (!LoginManager::getManagerLoginInfo("grade")) {
    JsUtil::alertReplace("로그인이 필요합니다.    ","/admin/");
}

include $_SERVER['DOCUMENT_ROOT']."/admin/include/head.php";
?>
<body>
	<div id="wrap">
    <!-- /** Left Menu area Start -->
<?php 
    include $_SERVER['DOCUMENT_ROOT']."/admin/include/left_menu.php";
?>
    <!--Left Menu area End */ -->

    <!-- /** hearder area Start -->
		<header>
			<nav id="nav">
				<ul>
					<li><a href="/admin/src/consult_list.php" class="<?=$menuNo[0]=="1"?"active":""?>">상담</a></li>
<?php
		if(LoginManager::getManagerLoginInfo("grade_0") >= 10) {
?>
					<li><a href="/admin/src/adm_mem_list.php" class="<?=$menuNo[0]=="9"?"active":""?>">기초정보</a></li>
<?php
		}
?>
				</ul>
      		</nav>
      		<div class="right-menu">
        		<ul>
          			<li><span class="userid"><?=LoginManager::getManagerLoginInfo("name")?></span> 님 반갑습니다!</li>
          			<li>
            			<a href="/admin/admin_logout.php" class="logout">로그아웃</a>
          			</li>
        		</ul>
      		</div>
    	</header>
    <!-- hearder area End */ -->
    
    <!-- /** contents area Start -->
    	<div id="conts" class="content-wrap">