// char counter title

var max_length_title = 35;
var counter_title = document.querySelector('.js-count-title');

var inputTitle =  document.getElementsByClassName('js-input-title');
if (typeof(inputTitle) != 'undefined' && inputTitle != null)
{
    document.querySelector('.js-input-title').addEventListener('keyup', function(event){
        var text_title = event.target.value;
        if(text_title.length > max_length_title) {
            text_title = text_title.substr(0,max_length_title);
            event.target.value = text_title;
        }
        counter_title.textContent = max_length_title - text_title.length;
    });
}



// char counter description

var max_length_description = 150;
var counter_description = document.querySelector('.js-count-description');


    document.querySelector('.js-input-description').addEventListener('keyup', function (event) {
        var text = event.target.value;
        if (text.length > max_length_description) {
            text = text.substr(0, max_length_description);
            event.target.value = text;
        }
        counter_description.textContent = max_length_description - text.length;
    });
