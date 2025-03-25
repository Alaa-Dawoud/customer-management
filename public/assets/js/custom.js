$(window).scroll(function() {
    var scrollPercentage = 100 * ($(this).scrollTop() / $('body').height());
    var newClass;

    if (scrollPercentage >= 5) {
        newClass = 'fixed_header';
    }
    $('header').removeClass('fixed_header').addClass(newClass);
});

$(document).ready(function() {
    $('.country_select').select2({
        placeholder: 'البلد'
    });
});