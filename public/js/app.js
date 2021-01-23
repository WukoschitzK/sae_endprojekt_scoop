/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imageUpload").change(function () {
    readURL(this);
  }); //sticky nav

  $windowHeight = $(window).height();
  $windowHeight += 80;

  if ($(document).height() > $windowHeight) {
    $(window).scroll(function () {
      $navigationDestkop = $('.navigation-desktop');
      var scroll = $(window).scrollTop();

      if (scroll >= 5) {
        $navigationDestkop.addClass("scrolled");
      } else {
        $navigationDestkop.removeClass("scrolled");
      }
    });
  } // mobilenav


  $burgerMenuBtn = $('.js-menu-btn');
  $navigationPoints = $('.navigation-mobile-open-navpoints');
  $navigationMobileWrapper = $('.navigation-mobile');
  $navigationPoints.hide();
  $burgerMenuBtn.click(function () {
    $navigationMobileWrapper.toggleClass('open');
    $burgerMenuBtn.parent().toggleClass('open');

    if ($burgerMenuBtn.parent().hasClass('open')) {
      $navigationPoints.show();
    } else {
      $navigationPoints.hide();
    }
  });
  $toggleIcon = $('.js-toggle-icon');
  $openNavigationPoints = $('.js-open-navigation-points');
  $openNavigationPoints.hide();
  $toggleIcon.click(function () {
    $toggleIcon.toggleClass("fa-caret-up fa-caret-down");

    if ($toggleIcon.hasClass("fa-caret-up")) {
      $openNavigationPoints.show();
    } else {
      $openNavigationPoints.hide();
    }
  });
  $toggleShowAllergens = $('.js-toggle-show-allergens');
  $allergenWrapper = $('.js-allergen-tiles-wrapper');
  $allergenWrapper.hide();
  $toggleShowAllergens.click(function () {
    $toggleShowAllergens.toggleClass("fa-caret-up fa-caret-down");

    if ($toggleShowAllergens.hasClass("fa-caret-up")) {
      $allergenWrapper.show();
    } else {
      $allergenWrapper.hide();
    }
  }); // char counter title
  // var max_length_title = 35;
  // var counter_title = document.querySelector('.js-count-title');
  // var inputTitle =  document.getElementsByClassName('js-input-title');
  // if (typeof(inputTitle) != 'undefined' && inputTitle != null)
  // {
  //     document.querySelector('.js-input-title').addEventListener('keyup', function(event){
  //         var text_title = event.target.value;
  //         if(text_title.length > max_length_title) {
  //             text_title = text_title.substr(0,max_length_title);
  //             event.target.value = text_title;
  //         }
  //         counter_title.textContent = max_length_title - text_title.length;
  //     });
  // }
  // char counter description
  // var max_length_description = 150;
  // var counter_description = document.querySelector('.js-count-description');
  //
  //
  //     document.querySelector('.js-input-description').addEventListener('keyup', function (event) {
  //         var text = event.target.value;
  //         if (text.length > max_length_description) {
  //             text = text.substr(0, max_length_description);
  //             event.target.value = text;
  //         }
  //         counter_description.textContent = max_length_description - text.length;
  //     });
  // add ingredient input field
  // $('.add-ingredient').click(function() {
  //     $('.js-wrapper-ingredients-input').append("<div class=\"wrapper-ingredients\">\n" +
  //         "<input name=\"ingredient[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_ingredient\">\n" +
  //         "</div>");
  // });

  $('.add-ingredient').click(function () {
    $('.js-wrapper-ingredients-input').append("<div class=\"wrapper-ingredients\">\n" + "<div>\n" + "<div class=\"input-flex\">\n" + "<div class=\"input-width-100\">\n" + "<input rows=\"6\" cols=\"150\" name=\"ingredient[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_ingredient\">\n" + "</div>\n" + "<div class=\"js-remove-ingredient\"><img class=\"remove-icon\" src=\"../../images/svg/cross.svg\" alt=\"delete icon\"></div>\n" + "</div>\n" + "</div>\n" + "</div>");
  }); //remove ingredients
  // $('.js-remove-ingredient').click(function() {
  //     $(this).parent().remove();
  // })

  $('.js-wrapper-ingredients-input').on('click', 'div.js-remove-ingredient', function () {
    $(this).parent().parent().remove();
  }); // add step input field

  var count = 1; // $('.add-step').click(function() {
  //     count+=1;
  //     $('.js-wrapper-steps-input').append("<div class=\"wrapper-steps\">\n" +
  //         "<div class=\"steps-count\">" + count + "</div>\n" +
  //         "<input rows=\"6\" cols=\"150\" name=\"steps[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_steps\">\n" +
  //         "    </div>");
  // });

  $('.add-step').click(function () {
    count += 1;
    $('.js-wrapper-steps-input').append("<div class=\"wrapper-steps\">\n" + "<div>\n" + "<div class=\"steps-count\">" + count + "</div>\n" + "<div class=\"input-flex\">\n" + "<input rows=\"6\" cols=\"150\" name=\"steps[]\" value=\"\" class=\"form-recipe-input margin-bottom-10\" id=\"input_steps\">\n" + "<div class=\"js-remove-step\"><img class=\"remove-icon\" src=\"../../images/svg/cross.svg\" alt=\"delete icon\"></div>\n" + "</div>\n" + "</div>\n" + "</div>");
  }); //remove step

  $('.js-wrapper-steps-input').on('click', 'div.js-remove-step', function () {
    $(this).parent().parent().parent().remove();
  });
  var category = "";
  var allergens = []; //filter recipe allergens

  $('.tryAllergen').click(function () {
    $('.tryAllergen').each(function () {
      if ($(this).is(":checked")) {
        //add allergen only if it's not already in array
        if (allergens.indexOf($(this).val()) < 0) {
          allergens.push($(this).val());
          $(this).parent().addClass('active');
        }
      } else {
        $(this).parent().removeClass('active');
        var index = allergens.indexOf($(this).val()); //remove unchecked items from array

        if (index > -1) {
          allergens.splice(index, 1);
        }
      }
    }); // console.log(category);
    // console.log(allergens);

    $.ajax({
      type: 'GET',
      dataType: 'html',
      url: '',
      data: "allergens=" + allergens.toString() + "&" + "cat=" + category,
      success: function success(data) {
        var result = $('<div />').append(data).find('.recipe-cards-wrapper-flex').html();
        $('.recipe-cards-wrapper-flex').html(result);
      } // success: function(response) {
      //     console.log(response);
      //     return;
      //     $('#updateDiv').append(response);
      // }

    });
  });
  $('.js-categories-wrapper').children().first().addClass('active'); //filter recipe category

  $('.js-select-category').click(function () {
    $('.js-select-category').each(function () {
      if ($(this).is(":checked")) {
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
      type: 'GET',
      dataType: 'html',
      url: '',
      data: "cat=" + finalcategories + "&" + "allergens=" + allergens.toString(),
      success: function success(data) {
        var result = $('<div />').append(data).find('.recipe-cards-wrapper-flex').html();
        $('.recipe-cards-wrapper-flex').html(result);
      } // success: function(response) {
      //     console.log(response);
      //     $('#updateDiv').append(response);
      // }

    });
  });
  $('.js-list-steps').hide(); //show ingredients (mobile)

  $('#js-tab-ingr').click(function () {
    $(this).parent().children().removeClass('recipe-tab-active');
    $('.js-list-steps').hide();
    $('.js-list-ingr').show();
    $(this).addClass('recipe-tab-active');
  }); //show steps (mobile)

  $('#js-tab-steps').click(function () {
    $(this).parent().children().removeClass('recipe-tab-active');
    $('.js-list-ingr').hide();
    $('.js-list-steps').show();
    $(this).addClass('recipe-tab-active');
  }); //edit allergens

  $('.allergen-btn-editform').each(function () {
    $('.allergen-btn-editform').click(function () {
      if ($(this).is(":checked")) {
        $(this).parent().addClass('active');
      } else {
        $(this).parent().removeClass('active');
      } // if($(this).find('input').is(":checked")) {
      //     $(this).removeClass('active');
      //     // $(this).find('input').attr('checked', 'checked');
      // } else {
      //     $(this).addClass('active');
      //     $(this).find('input').attr('checked', 'checked');
      // }

    });
  }); //form validation for registration page

  $("form[name='registration']").validate({
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true
      }
    },
    messages: {
      name: "Please enter your name",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    submitHandler: function submitHandler(form) {
      form.submit();
    }
  }); //form validation for recipeform

  $("form[name='recipe-form']").validate({
    rules: {
      title: {
        required: true,
        maxlength: 35
      },
      description: {
        required: true,
        maxlength: 150
      },
      'ingredient[]': {
        required: true
      },
      'steps[]': {
        required: true
      },
      category: "required"
    },
    messages: {
      title: "The title is too long or empty",
      description: "The description is too long or empty",
      'ingredient[]': "Please enter an ingredient",
      'steps[]': "Please enter a step",
      category: "Please select a category for your recipe"
    },
    errorPlacement: function errorPlacement(error, element) {
      if (element.is(":radio")) {
        error.prependTo(element.parent().parent());
      } else {
        // This is the default behavior of the script for all fields
        error.insertAfter(element);
      }
    },
    submitHandler: function submitHandler(form) {
      form.submit();
    }
  });
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/kerstin/Documents/SAE/SAE_Endprojekt_Scoop/Scoop_Webapp/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/kerstin/Documents/SAE/SAE_Endprojekt_Scoop/Scoop_Webapp/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });