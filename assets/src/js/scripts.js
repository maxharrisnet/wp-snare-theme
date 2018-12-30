
jQuery(document).ready(function( $ ){
  var mediaLibraryUri = theme_paths.mediaLibraryUri;
  var stylesheetUri = theme_paths.stylesheetUri;

  $(function() {
    var $header = $('#header');
    var snap = 70;
    var $window = $(window);

    // $window.on('scroll', _.throttle(function() {
    //   var $scroll = $window.scrollTop();

    //   if ($scroll >= snap) {
    //     $header.addClass('sticky');
    //   }

    //   else {
    //     $header.removeClass('sticky');
    //   }

    // }));
  });

  // Mobile Menu Toggle
  $(function() {
    var menuBtn = $('.menu-toggle');
    var navMenu = $('#header .nav-wrap');

    menuBtn.click(function(e) {
      $(this).toggleClass('open');
      navMenu.toggleClass('open');
    });
  });
});
