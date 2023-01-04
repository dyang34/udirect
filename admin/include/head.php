<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/udirect_default_set.php";

@session_start();
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>유다이렉트 관리자</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="robots" content="noindex">  <!-- 검색엔진로봇 수집 차단. -->

        <link rel="shortcut icon" href="/admin/images/common/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="/admin/images/common/apple-favicon.png"/>
        
        <link type="text/css" rel="stylesheet" href="/admin/css/style.css?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/admin/css/style.css")?>" />
        <link type="text/css" rel="stylesheet" href="/admin/css/basic.css?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/admin/css/basic.css")?>" />
        <link type="text/css" rel="stylesheet" href="/admin/css/button.css?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/admin/css/button.css")?>" />
        <link type="text/css" rel="stylesheet" href="/admin/css/jquery-ui.css?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/admin/css/jquery-ui.css")?>" />
        <link type="text/css" rel="stylesheet" href="/admin/css/admin.css?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/admin/css/admin.css")?>" />

        <script type="text/javascript" src="/js/jquery-3.6.1.min.js?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/js/jquery-3.4.1.min.js")?>"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/js/jquery-ui.min.js")?>"></script>
<?/*        
        <script type="text/javascript" src="/js/common.js?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/js/common.js")?>"></script>
*/?>        
        <script type="text/javascript" src="/js/script.js?v=<?=filemtime($_SERVER['DOCUMENT_ROOT']."/js/script.js")?>"></script>
    </head>