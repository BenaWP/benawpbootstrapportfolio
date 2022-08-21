( function ($) {
    let $container = $('.portfolio-items').isotope('layout');

    $('.portfolio-filter').on('click', 'a', function (e) {
        e.preventDefault();
        $('.portfolio-filter li').removeClass('active');
        $(this).closest('li').addClass('active');
        let filterValue = $(this).attr('data-filter');
        console.log(filterValue);
        $container.isotope({filter: filterValue});
    });
} )( jQuery );


