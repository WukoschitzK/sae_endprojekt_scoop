$(document).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });


    $(window).scroll(function() {
        $navigationDestkop = $('.navigation-desktop');

        var scroll = $(window).scrollTop();

        if (scroll >= 1) {
            $navigationDestkop.addClass("scrolled");
        } else {
            $navigationDestkop.removeClass("scrolled");
        }
    });

    // mobilenav

    $burgerMenuBtn = $('.js-menu-btn');
    $navigationPoints = $('.navigation-mobile-open-navpoints');
    $navigationMobileWrapper = $('.navigation-mobile');

    $navigationPoints.hide();

    $burgerMenuBtn.click(function() {
        $navigationMobileWrapper.toggleClass('open');
        $burgerMenuBtn.parent().toggleClass('open');

        if($burgerMenuBtn.parent().hasClass('open')) {
            $navigationPoints.show();
        } else {
            $navigationPoints.hide();
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

    $toggleShowAllergens = $('.js-toggle-show-allergens');
    $allergenWrapper = $('.js-allergen-tiles-wrapper');

    $allergenWrapper.hide();

    $toggleShowAllergens.click(function() {
        $toggleShowAllergens.toggleClass("fa-caret-up fa-caret-down");
        if($toggleShowAllergens.hasClass("fa-caret-up")) {
            $allergenWrapper.show();
        } else {
            $allergenWrapper.hide();
        }
    });




    // $allergenTile = $('.js-allergen-tile');
    //
    // $allergenTile.each(function() {
    //     $(this).on("click", function(){
    //         $(this).toggleClass('active');
    //     });
    // });


    // add ingredient input field

    $('.add-ingredient').click(function() {
        $('.js-wrapper-ingredients-input').append("<div class=\"wrapper-ingredients\">\n" +
            "        <input name=\"ingredient[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_ingredient\">\n" +
            "    </div>");
    });

    //remove ingredientw
    $('.js-remove-ingredient').click(function() {
        $(this).parent().remove();
    })


    // add step input field

    var count = 1;

    $('.add-step').click(function() {
        count+=1;
        $('.js-wrapper-steps-input').append("<div class=\"wrapper-steps\">\n" +
            "<div class=\"steps-count\">" + count + "</div>\n" +
            "<input rows=\"6\" cols=\"150\" name=\"steps[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_steps\">\n" +
            "    </div>");
    });

    //remove step
    $('.js-remove-step').click(function() {
        $(this).parent().remove();
    })



    var category ="";
    var allergens = [];


    //filter recipe allergens


    $('.tryAllergen').click(function() {
        $('.tryAllergen').each(function() {
            if($(this).is(":checked")) {
                //add allergen only if it's not already in array
                if(allergens.indexOf($(this).val()) < 0) {
                    allergens.push($(this).val());
                    $(this).parent().addClass('active');
                }

            } else {
                $(this).parent().removeClass('active');
                const index = allergens.indexOf($(this).val());
                //remove unchecked items from array
                if (index > -1) {
                    allergens.splice(index, 1);
                }
            }
        });

        // console.log(category);
        // console.log(allergens);

        $.ajax({
            type:'GET',
            dataType:'html',
            url:'',
            data:  "allergens=" + allergens.toString() + "&" + "cat=" + category,
            success: function (data) {
                var result = $('<div />').append(data).find('.recipe-cards-wrapper-flex').html();
                $('.recipe-cards-wrapper-flex').html(result);
            },
            // success: function(response) {
            //     console.log(response);
            //     return;
            //     $('#updateDiv').append(response);
            // }
        });
    })


    $('.category-item').children().first().addClass('active');

    //filter recipe category
    $('.js-select-category').click(function() {

        $('.js-select-category').each(function() {
            if($(this).is(":checked")) {
                category = $(this).val();
                $(this).parent().addClass('active');
            } else {
                $(this).parent().removeClass('active');
            }
        });

        var finalcategories = category;
        console.log(finalcategories);
        console.log(allergens);

        $.ajax({
            type:'GET',
            dataType:'html',
            url:'',
            data: "cat=" + finalcategories + "&" + "allergens=" + allergens.toString(),
            success: function (data) {
                var result = $('<div />').append(data).find('.recipe-cards-wrapper-flex').html();
                $('.recipe-cards-wrapper-flex').html(result);
            },
            // success: function(response) {
            //     console.log(response);
            //     $('#updateDiv').append(response);
            // }
        });
    })


    $('.js-list-steps').hide();
    //show ingredients (mobile)
    $('#js-tab-ingr').click(function() {
        $(this).parent().children().removeClass('recipe-tab-active');
        $('.js-list-steps').hide();
        $('.js-list-ingr').show();

        $(this).addClass('recipe-tab-active');
    });

    //show steps (mobile)

    $('#js-tab-steps').click(function() {
        $(this).parent().children().removeClass('recipe-tab-active');
        $('.js-list-ingr').hide();
        $('.js-list-steps').show();
        $(this).addClass('recipe-tab-active');
    });
});


