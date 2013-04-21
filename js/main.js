$(document).ready(function () {
  // Run function to make sure nav is setup for current viewport
  adjustNav();
  $(".menu-toggle").click(function(){
    $("nav.main-menu .menu").toggle();
  });
)};

// Will adjust classes and properties to display the correct menu
var adjustNav = function(){
  if($(document).width() < 767){
    $("nav.main").removeClass("full").addClass("compact");
    $(".compact-menu").css("display", "block");
  }
  if($(document).width() > 767){
    $("nav.main").removeClass("compact").addClass("full");
    $(".compact-menu").css("display", "none");
  }
}
// If the viewport is resized, re-evaluate which menu to display
$(window).resize(function() {
  adjustNav();
});