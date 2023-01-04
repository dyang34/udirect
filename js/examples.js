
$(document).ready(function() { //jquery가 적용되어있는 경우 
/* 원문
	document.getElementById('demosMenu').addEventListener('change', function(e){
		var dropdown = document.getElementById('demosMenu');
		window.location.href = dropdown.options[dropdown.selectedIndex].getAttribute('id') + '.html';
	});
*/
	// 원본이 오류로 인해 수정 작업함
	$(document).on('change','#demosMenu',function() {
			var dropdown = document.getElementById('demosMenu');
			window.location.href = dropdown.options[dropdown.selectedIndex].getAttribute('id') + '.html';

	});

});