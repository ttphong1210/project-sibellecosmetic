// JavaScript Docs

(function () {
    "use strict";

    const mySwiper = new Swiper("#swiper1", {
        loop: true,

        slidesPerView:'auto',
        centeredSlides: true,
        // spaceBetween: 10, // Khoảng cách giữa các slide

        navigation: {
            // nextEl: "#js-next1",
            // prevEl: "#js-prev1",
            nextEl: "#next-btn",
            prevEl: "#prev-btn",
        },
   
    });
})(); /* IIFE end */


