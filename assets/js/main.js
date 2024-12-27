/**
 * @param {boolean} condition The condition under which the navigation becomes sticky
 */
function nav_stickyness(condition) {
	if (condition){  
		$('.main-nav').addClass("sticky");
	}
	else{
		$('.main-nav').removeClass("sticky");
	}
}



function horizontalScroll() {
	let scrollStatePixel = -$('.horizontal').offset().top + $('nav').offset().top + $('nav').outerHeight() - 1;

	let scrollStatePercentage = 100 * scrollStatePixel / ($('.horizontal').outerHeight() - $('.horizontal').attr('itemHeight'));

	if (scrollStatePercentage > 0) {
		$('.horizontal').css('--left', '-' + Math.min(scrollStatePercentage, 100) + '%');
	}
	else {
		$('.horizontal').css('--left', '0%');
	}
}



$(document).ready(function() {
	nav_stickyness(($(this).scrollTop() > 128) || ($('body').scrollTop() > 128));

	if ($('.horizontal').length > 0) {
		const numberOfItems = $('.horizontal > .wp-block-group').first().children().length;

		$('.horizontal').css({'--number-of-items': numberOfItems, '--width': $('.horizontal').outerWidth() + 'px'});
		$('.horizontal').attr('itemHeight', $('.horizontal').children().outerHeight());

		$(window).on('resize', function() {
			$('.horizontal').css({'--number-of-items': numberOfItems, '--width': $('.horizontal').outerWidth() + 'px'});
			$('.horizontal').attr('itemHeight', $('.horizontal').children().outerHeight());
		});

		horizontalScroll();

		$(window).on('scroll', function() {
			nav_stickyness($(this).scrollTop() > 128);
			horizontalScroll();
		});

		$('body').on('scroll', function() {
			nav_stickyness($(this).scrollTop() > 128);
			horizontalScroll();
		});
	}
	else {
		$(window).on('scroll', function() {
			nav_stickyness($(this).scrollTop() > 128);
		});
	
		$('body').on('scroll', function() {
			nav_stickyness($(this).scrollTop() > 128);
		});
	}
});



$(document).ready(function() {

	$('.hamburger-icon').on('click', function() {
		$('nav').toggleClass("open");
		$('.navigation li.open').removeClass("open");
	});

});



$(document).ready(function() {

	$('nav .navigation .menu-item-has-children').on('click', function() {
		$(this).toggleClass("open");
		$('nav, .navigation li.open').not(this).removeClass("open");
	});

});



$(document).ready(function() {

	$('nav .hamburger-menu .menu-item-has-children').on('click', function() {
		$(this).toggleClass("open");
	});

});



$(document).ready(function() {

	$('nav .navigation .menu-item-has-children').on('mouseenter', function() {
		$('.navigation li.open').not(this).removeClass("open");
	});

});



$(document).ready(function() {
	$('[href="#"]').removeAttr("href");
	$('nav .menu-item-has-children a').not('.sub-menu a').removeAttr("href");
});