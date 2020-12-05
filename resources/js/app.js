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

    $allergenTile = $('.js-allergen-tile');

    $allergenTile.each(function() {
        $(this).on("click", function(){
            $(this).toggleClass('active');
        });
    });


    // add ingredient input field

    $('.add-ingredient').click(function() {
        $('.js-wrapper-ingredients-input').append("<div class=\"wrapper-ingredients\">\n" +
            "        <input name=\"ingredient[]\" value=\"{{ $recipe->ingredient }}\" class=\"form-recipe-input margin-bottom-10\" id=\"input_ingredient\">\n" +
            "    </div>");
    });


    // add step input field

    var count = 1;

    $('.add-step').click(function() {
        count+=1;
        $('.js-wrapper-steps-input').append("<div class=\"wrapper-steps\">\n" +
            "<div class=\"steps-count\">" + count + "</div>\n" +
            "<input rows=\"6\" cols=\"150\" name=\"steps[]\" value=\"{{ $recipe->steps }}\" class=\"form-recipe-input margin-bottom-10\" id=\"input_steps\">\n" +
            "    </div>");
    });


    //recipe tabs




});


