
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

  //Mobile Menu Toggle

  $(function() {
    var menuBtn = $('.menu-toggle');
    var navMenu = $('#header .main-nav');

    menuBtn.click(function(e) {
      $(this).toggleClass('open');
      navMenu.toggleClass('open');
    });

  });

  // Responsive Videos

  $(function() {
      var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
      $fluidEl = $("figure");

  	$allVideos.each(function() {

  	  $(this)
  	    // jQuery .data does not work on object/embed elements
  	    .attr('data-aspectRatio', this.height / this.width)
  	    .removeAttr('height')
  	    .removeAttr('width');
  	});

  	$(window).resize(function() {
  	  var newWidth = $fluidEl.width();

  	  $allVideos.each(function() {
  	    var $el = $(this);
  	    $el
         .width(newWidth)
         .height(newWidth * $el.attr('data-aspectRatio'));

  	  });
  	}).resize();
  });

  // Video Player

  $(function() {
    var title = $('.media-title');
    var playlist = $('.video-playlist');
    var vid = $('#video');
    var mp4 = $('#video .mp4');
    var $current = 0;
    var $muted = true;

    var mediaObj = {
      "videos": [
        { "title": "Get Ready Get Steady", "filename": "jb-the-first-lady-get-ready-get-steady", "image": "get-ready-get-steady" },
        { "title": "Dangerous", "filename": "jb-the-first-lady-dangerous", "image": "dangerous" },
        { "title": "If You Want It", "filename": "jb-the-first-lady-if-you-want-it",  "image": "want-it" },
        { "title": "Get Ready, Get Steady - Live", "filename": "jb-the-first-lady-get-ready-get-steady-live", "image": "get-ready-get-steady-live" }
      ]
    };

    var videos = mediaObj.videos;

    $('.video-controls').click(function(e) {
      var button = $(e.target);
      $muted = vid.prop('muted');

      // Show / hide certain icons
      if (button.is('.btn-play') || button.is('.btn-pause') || button.is('.btn-mute') || button.is('.btn-fullscreen')) {
        $(button).siblings('i').toggleClass('hide');
        $(button).toggleClass('hide');
      }

      if (button.is('.btn-play')) {
        vid[0].play();
      }

      else if (button.is('.btn-pause')) {
        vid[0].pause();
      }

      else if (button.is('.btn-next')) {
        $current++;
        loadVideo($muted);
      }

      else if (button.is('.btn-prev')) {
        $current--;
        loadVideo($muted);
      }

      else if (button.is('.btn-mute')) {
        if($muted) {
          vid.prop('muted', false);
        } else {
          vid.prop('muted', true);
        }
      }

      else if (button.is('.btn-playlist')) {
        playlist.toggleClass('open');
      }

      else if (button.is('.btn-fullscreen')) {
        if (vid.requestFullscreen) {
          vid.requestFullscreen();
        } else if (vid.mozRequestFullScreen) {
          vid.mozRequestFullScreen();
        } else if (vid.webkitRequestFullscreen) {
          vid.webkitRequestFullscreen();
        }
      }
    });

    function loadVideo(m) {

      if ($current < 0 ) {
        $current = videos.length - 1;
      }
      else if ($current >= videos.length) {
        $current = 0;
      }

      title.html(videos[$current].title);
      mp4.attr('src', stylesheetUri + '/videos/' + videos[$current].filename + '.mp4');
// https://www.jbthefirstlady.ca/wp-content/uploads/2018/01/jb-the-first-lady-if-you-want-it.mp4
      vid[0].pause();
      vid[0].load();
      vid[0].play();
      vid.prop('poster', stylesheetUri + '/images/videos/' + videos[$current].image  + '-video.png');
      vid.prop('muted', m);
    }

    loadVideo($muted);

    function buildPlaylist() {
      var playlistContent = '<ul>';

      for (i = 0; i < videos.length; i++) {
        playlistContent += '<li data-index="' + i + '">';
        playlistContent += '<img src="' + stylesheetUri + '/images/videos/' + videos[i].image + '-video.png">';
        playlistContent += '<h4>' + videos[i].title + '</h4>';
        playlistContent += '</li>';
      };

      playlistContent += '</ul>';
      
      playlist.html(playlistContent);
    };

    buildPlaylist();

    $('.video-playlist li').click(function(e) {
      $current = $(this).data('index');
      loadVideo($muted);
    });
  });
});
