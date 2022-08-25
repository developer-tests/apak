/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function () {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function () {
    $("#back2Top").click(function (event) {
        event.preventDefault();
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

});
/*Scroll to top when arrow up clicked END*/


(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = $(this),
            settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function () {
            $(this).find(".button").on('click', function () {
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
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function () {
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
            resizeFix = function () {
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

(function ($) {
    $(document).ready(function () {
        $("#cssmenu").menumaker({
            format: "multitoggle"
        });
    });

    $("#registration-csc-location-trigger").click(function () {

        $("#registration-csc-location").toggleClass('hidden');
    })
})(jQuery);

$(document).ready(function () {
    (function ($) {
        $('.autoplay-slider').owlCarousel({
            autoplay: true,
            loop: true,
            margin: 5,
            dots: false,
            nav: false,
            autoplayTimeout: 4000,
            autoplayHoverPause: false,
            touchDrag: false,
            mouseDrag: false,
            responsiveClass: true,
            navigation: true,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                }
            }
        });
    })(jQuery);
});


$(document).ready(function () {
    $(".collapse-btn .city-title").click(function () {
        $(".collapse-btn .filter-show").slideToggle();
    });
});

$(document).ready(function () {
    $('.toggle-btn').click(function () {
        $(this).toggleClass('active');
    });
});

$(document).ready(function () {
    $('.toggle-btn').click(function () {
        $('.menu-link').slideToggle();
    });
});

$(document).ready(function () {
    $('#lot-preview-description').click(function () {
        $('.lot-description-toggle').toggleClass('lot-description-ellipsis');
    });

    $("#new-account").click(function () {
        $("span.error-block").text('');
        $("#email").val('');
        $("#password").val('');
        $("input").removeClass('error');
        $('#loginRegisterModal').modal('hide');
        $('#registerModal').modal('show');
    })
    $("#check-email-logon").click(function () {
        $('#loginRegisterModal').modal('show');
        $('#registerModal').modal('hide');
    })
});

function openGalleria(i) {
    var oldid = $('#oldid').val();
    if (oldid) {
        $('.galleria' + oldid).data('galleria').destroy()
    }
    $('#oldid').val(i);
    $('.galleria' + i).galleria({
        height: 300,
    });
}

if (document.getElementsByClassName("detailgalleria").length > 0) {
    $('.detailgalleria').galleria({
        height: 300,
    });
}
// handles the carousel thumbnails
// https://stackoverflow.com/questions/25752187/bootstrap-carousel-with-thumbnails-multiple-carousel

function userLogin() {
    $("span.error-block").text('');
    $("input").removeClass('error');
    if ($("#email").val() == '') {
        $("#email").addClass('error');
        $("#email").parent().parent().find('span.error-block').text("Email is required.").css('color', 'red');
        return false;
    }

    if ($("#password").val() == '') {
        $("#password").addClass('error');
        $("#password").parent().parent().find('span.error-block').text("Password is required.").css('color', 'red');
        return false;
    }

    $.ajax({
        data: $("#loginForm").serialize(),
        type: 'post',
        url: $("#loginForm").attr('action'),
        beforeSend: function () {
            $(".btn-login").attr('disabled', true);
        },
        success: function (data) {
            $(".btn-login").attr('disabled', false);
            if (data.error == '1') {

                $.each(data.msg, function (index, value) {
                    var msg = data.msg[index];
                    $("#" + index).css('border', '1px solid red');
                    $("#" + index).parent().parent().find('span.error-block').text(msg).css('color', 'red');


                });
                return false;
            }

            if (data.error == '0') {
                location.reload();
                //window.location.href = data.redirect_url;
            }
        },
        error: function (data) {
            $(".btn-login").attr('disabled', false);
            alert("something went wrong!!");
        }
    });
}

function userRegister() {
    $("span.error-block").text('');
    $("input").removeClass('error');
    if ($("#useremail").val() == '') {
        $("#useremail").addClass('error');
        $("#useremail").parent().parent().find('span.error-block').text("Email is required.").css('color', 'red');
        return false;
    }

    if ($("#useremail_confirmation").val() == '') {
        $("#useremail_confirmation").addClass('error');
        $("#useremail_confirmation").parent().parent().find('span.error-block').text("Confirm email is required.").css('color', 'red');
        return false;
    }

    $.ajax({
        data: $("#registerForm").serialize(),
        type: 'post',
        url: $("#registerForm").attr('action'),
        beforeSend: function () {
            $(".btn-login").attr('disabled', true);
        },
        success: function (data) {
            $(".btn-login").attr('disabled', false);
            if (data.error == '1') {
                console.log(data.msg)
                $.each(data.msg, function (index, value) {
                    var msg = data.msg[index];
                    $("#user" + index).css('border', '1px solid red');
                    $("#user" + index).parent().parent().find('span.error-block').text(msg).css('color', 'red');


                });
                return false;
            }

            if (data.error == '0') {
                $('#regemail').val($('#useremail').val());
                $('#regemail_confirmation').val($('#useremail').val());
                $(".regstep1").hide();
                $(".modal-title").text('Step 2: Complete Account Info...');
                $(".step2-new-account").removeClass('hidden');
            }
        },
        error: function (data) {

            console.log(data);
        }
    });
}

function subscribe() {
    if ($("#sub_email").val() == "") {
        alert("Please enter your email");
        return false;
    }

    $.ajax({
        data: $("#subForm").serialize(),
        type: 'post',
        url: $("#subForm").attr('action'),
        beforeSend: function () {
            $(".btn-sub").attr('disabled', true);
        },
        success: function (data) {
            $(".btn-sub").attr('disabled', false);
            if (data.error == '1') {
                alert(data.msg);
                return false;
            }

            if (data.error == '0') {
                alert(data.msg);
                return false;
            }
        },
        error: function (data) {
            $(".btn-sub").attr('disabled', false);
            console.log(data);
        }
    });


}


function registerStep2() {
    $("span.error-block").text('');
    $("input").removeClass('error');
    $.ajax({
        data: $("#register_step2").serialize(),
        type: 'post',
        url: $("#register_step2").attr('action'),
        beforeSend: function () {
            $(".create_accountbtn").attr('disabled', true);
        },
        success: function (data) {
            $(".create_accountbtn").attr('disabled', false);
            if (data.error == '1') {
                $.each(data.msg, function (index, value) {
                    var msg = data.msg[index];
                    $("#" + index).css('border', '1px solid red');
                    $("#" + index).parent().parent().find('span.error-block').text(msg).css('color', 'red');


                });
                return false;
            }

            if (data.error == '0') {
                alert(data.msg);
                location.reload();
                $("#register_step2").reset();
                return false;
            }
        },
        error: function (data) {
            $(".create_accountbtn").attr('disabled', false);
            console.log(data);
        }
    });
}

