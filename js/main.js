


////////////////
// Navigation //
////////////////

// Use this variable to set the breakpoint at which the menu changes.
var breakPoint = 700;


// This function uses CSS classes to change the appearance of the menu.
function adjustNav() {

	if ($(document).width < breakPoint) {

		$("nav.main-menu").removeClass("full").addClass("compact");
		$("nav.main-menu ul").hide();
	}

	else {

		$("nav.main-menu").removeClass("compact").addClass("full");
		$("nav.main-menu ul").show();
	}
}

// When the document loads, adjust the nav and add click handlers for the
// mobile view of the menu.

$(document).ready(function () {

	adjustNav();

	$(".menu-toggle").click(function (evt) {

		$("nav.main-menu ul").slideToggle();
		evt.preventDefault();
	})
});


// On window resize, reevaluate the view of the navigation.
$(window).resize(function () {

	adjustNav();
});