// JavaScript Docs
//swiper
// var swiper = new Swiper(".mySwiper", {
//     slidesPerView: 3,
//     spaceBetween: 30,
//     slidesPerGroup: 3,
//     loop: true,
//     loopFillGroupWithBlank: true,
//     pagination: {
//       el: ".swiper-pagination",
//       clickable: true,
//     },
//     navigation: {
//       nextEl: ".swiper-button-next",
//       prevEl: ".swiper-button-prev",
//     },
//   });

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
