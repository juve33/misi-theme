$(document).ready(function() {

	$('nav .navigation .menu-item-has-children').on('click', function() {
		$(this).toggleClass("open");
		$('nav, .navigation li.open').not(this).removeClass("open");
	});

});



$(document).ready(function() {

	$('nav .navigation .menu-item-has-children').on('mouseenter', function() {
		$('.navigation li.open').not(this).removeClass("open");
	});

});