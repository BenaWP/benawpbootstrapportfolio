jQuery(document).ready(
    function ($) {
        let $container = $('.portfolio-items').isotope('layout');

        $('.portfolio-filter').on('click', 'a', function (e) {
            e.preventDefault();
            $('.portfolio-filter li').removeClass('active');
            $(this).closest('li').addClass('active');
            let filterValue = $(this).attr('data-filter');
            $container.isotope({filter: filterValue});
        });
    }
);


