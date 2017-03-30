$(document).ready(function () {

	$("#login").prepend('<div id="div1"><div id="div2"></div></div>');
	$("#div2").hide();
	$('.input').focus(function () {
		$("#div2").stop().fadeIn();
	});
	$("input").blur(function () {
		$("#div2").stop().fadeOut();
	});

	$('.nouveau').click(function () {
		$('#login').hide();
		$("#formulaire").show();
		$("#ins1").show();

	});
	$('.suivant').click(function () {
		$("#ins1").hide();
		$("#ins2").show();

	});


	$('#im1').click(function () {
		$('.con').show(500);
		$('.ins').hide(500);

	});

	$('#im2').click(function () {
		$('.ins').show(500);
		$('.con').hide(500);

	});

	$('#hclient').click(function() {
		$('#menu0').slideToggle(400);
	});

	$('#bout').click(function() {
		$('#resultat').hide();
	});


	$('#barre').each(function(argument) {
		var parent =$(this).parent();
		var valTop=$(this).offset().top;
		var elem=$(this);
		parent.css('position','relative');
		//alert(scrollY());
		//elem.css('position','absolute');
		$(window).scroll(function () {
			if (scrollY()>valTop) {
				elem.css('position','fixed')
				//elem.stop().animate({top:scrollY()-parent.offset().top},1000);
			} else{
				elem.css('position','relative')

				//elem.stop().animate({top:valTop-parent.offset().top},1000);
				
			}
		});
		
	});
});
function scrollY() {
	
	scrOfY=0;
	if (typeof(window.pageYOffset)=='number') {
		scrOfY=window.pageYOffset;
	} else if (document.body && (document.body.scrollTop)) {
	 	scrOfY=document.body.scrollTop;
	} else if (document.documentElement && (document.documentElement.scrollTop)) {
		scrOfY=document.documentElement.scrollTop
	}
	return scrOfY;
}
