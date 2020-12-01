$(document).ready(function() {


    $(window).scroll(function() {
        $navigationDestkop = $('.navigation-desktop');

        var scroll = $(window).scrollTop();

        if (scroll >= 1) {
            $navigationDestkop.addClass("scrolled");
        } else {
            $navigationDestkop.removeClass("scrolled");
        }
    });


    $toggleIcon = $('.js-toggle-icon');
    $openNavigationPoints = $('.js-open-navigation-points');

    $openNavigationPoints.hide();

    $toggleIcon.click(function() {
        $toggleIcon.toggleClass("fa-caret-up fa-caret-down");
        if($toggleIcon.hasClass("fa-caret-up")) {
            $openNavigationPoints.show();
        } else {
            $openNavigationPoints.hide();
        }
    });
});


