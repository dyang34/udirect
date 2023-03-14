<?php
require_once $_SERVER['DOCUMENT_ROOT']."/include/common.php";

/*
$head_title = "";

$head_meta_title = "";
$head_meta_keywords = "";
$head_meta_description = "";

$head_og_title = "";
$head_og_url = "";
$head_og_image = "";
$head_og_description = "";
*/

if(empty($head_title)) {
  $head_title = "유다이렉트 - 토탈 보험 케어 서비스";
}

if(empty($head_meta_title)) {
  $head_meta_title = "유다이렉트 | Udirect";
}

if(empty($head_meta_keywords)) {
  $head_meta_keywords = "유다이렉트,Udirect,cudirect.co.kr,비아이에스홈페이지,여행자보험, 여행자보험추천, 여행자보험비교, 국내여행자보험, 여행보험, 해외여행자보험, 해외여행보험, 여행, 해외여행, 국내여행, 휴가, 출장, 유학, 유학생보험, 유학보험,";
}

if(empty($head_meta_description)) {
  $head_meta_description = "다양한 보험 상품의 상담, 설계, 간편 가입이 한번에 가능한 보험 다이렉트 토탈 보험 케어 서비스를 제공합니다. 개인의 특성에 꼭 맞는 여행자보험, 장기 유학생보험, 주택화재보험, 펫보험, 건강보험 맞춤 솔루션을 제공하여 맞춤형 보험 상담을 받으실 수 있습니다.";
}

if(empty($head_og_title)) {
  $head_og_title = "유다이렉트 | Udirect";
}

if(empty($head_og_url)) {
  $head_og_url = "https://udirect.co.kr/";
}

if(empty($head_og_image)) {
  $head_og_image = "/img/common/mobile_221129.jpg";
}

if(empty($head_og_description)) {
  $head_og_description = "다양한 보험 상품의 상담, 설계, 간편 가입이 한번에 가능한 보험 다이렉트 토탈 보험 케어 서비스를 제공합니다. 개인의 특성에 꼭 맞는 여행자보험, 장기 유학생보험, 주택화재보험, 펫보험, 건강보험 맞춤 솔루션을 제공하여 맞춤형 보험 상담을 받으실 수 있습니다.";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title><?=$head_title?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width">
    
    <meta name="title" content="<?=$head_meta_title?>">
    <meta name="keywords" content="<?=$head_meta_keywords?>">
    <meta name="description" content="<?=$head_meta_description?>">
    
    <meta property="og:title" content="<?=$head_og_title?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?=$head_og_url?>">
    <meta property="og:image" content="<?=$head_og_image?>">
    <meta property="og:description" content="<?=$head_og_description?>">
    
    <meta name="format-detection" content="telephone=no"><!-- iOS에서 숫자가 전화번호로 인식되는 문제 막기 -->
    <link rel="icon" type="image/png" sizes="32x32" href="/img/common/favicon.ico">
    <link rel="shortcut icon" href="/img/common/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="/img/common/favicon.png"/>
    
    <!-- /** style css -->
    <link rel="stylesheet" type="text/css" href="/css/style.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/basic.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/button.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/terms.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/product.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/mobile.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="/css/animate.css">

    <!-- /** JavaScript -->
    <script src="/js/jquery-3.6.1.min.js"></script>
    <script src="/js/script.js?v=<?=time()?>"></script>
    <script src="/js/wow.min.js"></script> <!-- /****** wowJs animation -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KR5Q5PM');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KR5Q5PM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="activated">		
<?php if($menuNo[0]==9) { ?>
		<div id="menu">
			<h1><a href="/index.php" class="logo"></a></h1>
			<ul>
				<li ><a href="/terms/terms-service.php">이용약관</a></li>
				<li ><a href="/terms/privacy.php">개인정보취급방침</a></li>
			</ul>
		</div>
		<//? elseif($mNum==2): ?>
<? } else { ?>
		<div class="temporarily" id="menu">
			<h1><a href="/index.php" class="logo"></a></h1>
		</div>
<?php
   }
?>
</header>