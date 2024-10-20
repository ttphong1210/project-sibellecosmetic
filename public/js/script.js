// JavaScript Docs

(function () {
    "use strict";

    const mySwiper = new Swiper("#swiper1", {
        loop: true,

        // slidesPerView:'auto',
        slidesPerView:1,
        centeredSlides: true,
        // spaceBetween: 10, // Khoảng cách giữa các slide
        navigation: {
            // nextEl: "#js-next1",
            // prevEl: "#js-prev1",
            nextEl: "#next-btn",
            prevEl: "#prev-btn",
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
            },
            780: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    });
})(); /* IIFE end */

$(document).ready(function(){
    $(document).on('click', '.increment-btn', function(){
        var qtyInput = $('input[name="quantity"]');
        var currentQty = parseInt(qtyInput.val(), 10);
        var newQty = currentQty + 1;
        qtyInput.val(newQty);
    })

    $(document).on('click', '.decrement-btn', function(){
        var qtyInput = $('input[name="quantity"]');
        var currentQty = parseInt(qtyInput.val(), 10);
        var newQty = currentQty > 1 ? currentQty - 1 : 1 ;
        qtyInput.val(newQty);
    })
})

