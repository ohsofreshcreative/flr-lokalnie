import Swiper from 'swiper';
import {
  Navigation,
  Autoplay,
  Pagination
} from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.usage-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        modules: [Navigation, Autoplay, Pagination],

        // Blokada przesuwania palcem/myszką
        allowTouchMove: false,

        slidesPerView: 1.2, // Dla urządzeń mobilnych
        spaceBetween: 20,
        loop: true,
        speed: 2000,
        loopAdditionalSlides: 1,
        slidesPerGroup: 1,


        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next', // Użyj globalnych selektorów
          prevEl: '.swiper-button-prev', // Użyj globalnych selektorów
        },
        breakpoints: {
          // dla ekranów >= 768px
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
            centeredSlides: false,
          },
          // dla ekranów >= 1024px
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
            centeredSlides: false,
          },
        },
      });
    });
  }
});