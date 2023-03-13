<?
// 메시지발송
function SendMesg($url) {
	// 테스트 후, 서버 상태에 따라 원활한 접속 방법을 이용해주세요.
	//$fp = fsockopen("ssl:munjanara.co.kr", 443, $errno, $errstr, 10);
	$fp = fsockopen("munjanara.co.kr", 80, $errno, $errstr, 10);
	//$fp = fsockopen("munjanara.co.kr", 443, $errno, $errstr, 10);

	if(!$fp){
		echo "$errno : $errstr";
		exit;
	}

	fwrite($fp, "GET $url HTTP/1.0\r\nHost: 211.233.20.184\r\n\r\n"); 
	$flag = 0;

	while(!feof($fp)){
		$row = fgets($fp, 1024);

		if($flag) $out .= $row;
		if($row=="\r\n") $flag = 1;
	}

	fclose($fp);
	return $out;
}

$allowMms = "0";

// 문자나라 아이디
$userid = "bis18009010";

// 문자나라 2차 비밀번호
// 문자나라 웹사이트 '개인정보변경'에서 2차 비밀번호 설정 후, 동일하게 지정
$passwd = "bis18009010";

// 발신번호사전등록제에 따라 문자나라에 인증확인된 발신번호(핸드폰 또는 일반전화)
$hpSender = "18009010";

// 비상시 문자나라에서 문자알림 또는 연락가능한 번호 
$adminPhone = "01092927770";

// 최종 전송 완료후, 자동으로 완료창을 띄울 것인지 결정 (1:띄움, 0:안띄움)
$endAlert = 1;
?>