
jQuery(document).ready(function( $ ){
  var mediaLibraryUri = theme_paths.mediaLibraryUri;
  var stylesheetUri = theme_paths.stylesheetUri;

  $(function() {
    var $header = $('#header');
    var snap = 70;
    var $window = $(window);

    $window.on('scroll', _.throttle(function() {
      var $scroll = $window.scrollTop();

      if ($scroll >= snap) {
        $header.addClass('sticky');
      }

      else {
        $header.removeClass('sticky');
      }

    }));
  });

  // Mobile Menu Toggle
  $(function() {
    var menuBtn = $('.menu-toggle');
    var navMenu = $('#header .main-nav');

    menuBtn.click(function(e) {
      $(this).toggleClass('open');
      navMenu.toggleClass('open');
    });
  });



  // Image Grid
  var $grid = $('.gallery-grid').imagesLoaded( function() {

    $grid.masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      percentPosition: true
    });
  });

  $('.gallery-grid a').featherlightGallery({
    previousIcon: '&#9664;',     /* Code that is used as previous icon */
    nextIcon: '&#9654;',         /* Code that is used as next icon */
    galleryFadeIn: 100,          /* fadeIn speed when slide is loaded */
    galleryFadeOut: 300,          /* fadeOut speed before slide is loaded */
    autoBind: '.gallery-grid a' /* Will automatically bind elements matching this selector. Clear or set before onReady */
  })
});
