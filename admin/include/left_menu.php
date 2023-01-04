<!-- /** menu 01 -->
<div id="Sidenav" class="menu-wrap">
  	<h1>
		<a href="/admin/branch.php">
	  		<img src="/admin/images/common/logo-white.svg?tv" alt="유다이렉트 로고">
	  		U-Direct 관리자
		</a>
  	</h1>
  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-nav"></i>메뉴닫기</a><a name="btnExpandLeftMenu" accesskey="Q"></a>
<?php
	if ($menuNo[0]=="1") {
?>
  	<ul class="accordion" id="accordion">
		<li class="accordion_list <?=$menuNo[1]=="1"?"open":""?>">
			<div class="link" accordion_menu_no="1">상담<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu" style="<?=$menuNo[1]=="1"?"display:block;":""?>">
				<li><a href="/admin/src/consult_list.php" class="<?=($menuNo[1]=="1" && $menuNo[2]=="1")?"active":""?>">상담 List</a></li>
			</ul>
		</li>
  	</ul>
<?php
	} else if ($menuNo[0]=="9" && LoginManager::getManagerLoginInfo("grade_0") >= 10) {
?>	
  	<ul class="accordion" id="accordion">
		<li class="accordion_list <?=$menuNo[1]=="9"?"open":""?>">
			<div class="link" accordion_menu_no="9">기초 정보<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu" style="<?=$menuNo[1]=="9"?"display:block;":""?>">
				<li><a href="/admin/src/adm_mem_list.php" class="<?=($menuNo[1]=="9" && $menuNo[2]=="1")?"active":""?>">회원 관리</a></li>
			</ul>
		</li>
	</ul>
<?php
	}
?>
</div>
<!-- /** menu 02 -->


<span onclick="openNav()" class="openBtn"><i class="fa-nav"></i>메뉴열기</span>
<script type="text/javascript">
	$(document).ready(function() {
		$(".link[accordion_menu_no=<?=$menuNo[1]?>]").trigger("dropdown");
	});

	$(document).on('click', 'a[name=btnExpandLeftMenu]', function() {
		if($('#Sidenav').css('width')=="0px") {
			openNav();
		} else {
			closeNav();
		}
	});
</script>