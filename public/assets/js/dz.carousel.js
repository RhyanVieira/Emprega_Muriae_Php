/* JavaScript Document */
jQuery(document).ready(function() {
    'use strict';

    /* Blog post Carousel function */
    jQuery('.blog-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 30,
        nav: true,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        responsive: {
            0: { items: 1 },
            480: { items: 2 },
            991: { items: 2 },
            1000: { items: 3 }
        }
    });

    /* Blog post Carousel Centered function */
    jQuery('.blog-carousel-center').owlCarousel({
        loop: true,
        center: true,
        autoplay: true,
        margin: 30,
        nav: true,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        responsive: {
            0: { items: 1 },
            480: { items: 2 },
            991: { items: 2 },
            1000: { items: 3 }
        }
    });
});
