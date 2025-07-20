require('../../themes/vendor/jquery/jquery.min');
require('../../themes/vendor/bootstrap/js/bootstrap.bundle.min');
require('../../themes/vendor/jquery-easing/jquery.easing.min');
require('../../themes/js/sb-admin-2.min');


$(document).on('ready', function() {
  if ($(window).width() > 767) {
    $('.show-sidebar').css({
      'display' : 'none'
    });
  }
});

$(window).on('resize', function() {
  set_burger();
});

$(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if ($(window).width() < 768) {
      if (scrollDistance > 100) {
        $('.show-sidebar').fadeIn();
      } else {
        $('.show-sidebar').fadeOut();
      }
    }
});

$("#showSidebarScroll").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
});

$("#sidebarToggleTop, #showSidebarScroll").on('click', function(e) {
  set_burger();
});

function set_burger() {
  if ($(".sidebar").hasClass("toggled")) {
    $('.show-sidebar').css({
        'left' : '1rem'
    });
  } else {
      $('.show-sidebar').css({
          'left' : '7.5rem'
      });
  };
}