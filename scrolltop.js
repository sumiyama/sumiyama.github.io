let $pagetop = $('.scrolltop,.scrollmenu');

$(window).on('scroll', function () {
    if ($(this).scrollTop() < 20) {
        $pagetop.removeClass('isActive');
    } else {
        $pagetop.addClass('isActive');
    }
});
$('a[href^="#"]').on('click', function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position }, 550, "swing");
    return false;
});