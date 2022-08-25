/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});
/*Scroll to top when arrow up clicked END*/


(function($) {
    $.fn.menumaker = function(options) {
        var cssmenu = $(this),
        settings = $.extend({
            format: "dropdown",
            sticky: false
        }, options);
        return this.each(function() {
            $(this).find(".button").on('click', function() {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                } else {
                    mainmenu.slideToggle().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function() {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function() {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open').slideToggle();
                    } else {
                        $(this).siblings('ul').addClass('open').slideToggle();
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            resizeFix = function() {
                var mediasize = 768;
                if ($(window).width() > mediasize) {
                    cssmenu.find('ul').show();
                }
                if ($(window).width() <= mediasize) {
                    cssmenu.find('ul').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

(function($) {
    $(document).ready(function() {
        $("#cssmenu").menumaker({
            format: "multitoggle"
        });
    });
})(jQuery);

$(document).ready(function(){
    $(".collapse-btn .city-title").click(function(){
        $(".collapse-btn .filter-show").slideToggle();
    });
});

$(document).ready(function(){
    $('.toggle-btn').click(function(){
      $(this).toggleClass('active');
    });
  });
  
$(document).ready(function(){
$('.toggle-btn').click(function(){
    $('.menu-link').slideToggle();
});
});

$(document).ready(function(){
    $('#lot-preview-description').click(function(){
        $('.lot-description-toggle').toggleClass('lot-description-ellipsis');
    });
});

 function openGalleria(i){
    var oldid = $('#oldid').val();
    if(oldid){
     $('.galleria'+oldid).data('galleria').destroy()
    }
    $('#oldid').val(i);
     $('.galleria'+i).galleria({
      height : 300,
      });
  }
  // handles the carousel thumbnails
  // https://stackoverflow.com/questions/25752187/bootstrap-carousel-with-thumbnails-multiple-carousel
  