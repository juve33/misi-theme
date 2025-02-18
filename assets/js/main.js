$(document).ready(function() {
	$('[href="#"]').removeAttr("href");
	$('nav .menu-item-has-children a').not('.sub-menu a').removeAttr("href");
});



$(document).ready(function() {
	$('.wp-block-image img').each(function () {
		if (!$(this).parent().hasClass('.wp-block-image__wrapper')) {
		  $(this).wrap('<div class="wp-block-image__wrapper"></div>');
		}
	  });
});