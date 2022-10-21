// JavaScript Docs

(function() {
  
  'use strict';
   
  const mySwiper = new Swiper ('#swiper1', {
    loop:true,

    slidesPerView:'auto',
    centeredSlides: true,

    navigation: {
      nextEl: "#js-next1",
      prevEl: "#js-prev1"
    },
   
  });

})(); /* IIFE end */
