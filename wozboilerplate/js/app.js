$('.nav-link, .navbar-brand, .link').on('click', function(event) {

    var target = $( $(this).attr('href') );

    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top - 100
        }, 500);
    }

    $(".navbar-collapse").removeClass('show');
});