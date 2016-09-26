/**
 *网站导航条悬浮 
 */
$(window).scroll(function(){
	var height = $('body').scrollTop();
	if(height >= 105){
		$('#navbg').attr('class','navbg_1');
	}
	if(height <= 100){
		$('#navbg').attr('class','navbg');
	}
});