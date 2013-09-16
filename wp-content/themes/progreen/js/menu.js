jQuery(function($) {

	$('#navigation .menu').each(function(){
		var width = $(this).width();
		var half = width/2;
		$(this).css('margin-left', -half+'px');
		$(this).css('left', '50%');
	});
	


});