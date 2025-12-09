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

        loop: false,    
        rewind: false,      
        slidesPerGroup: 1,   
        
        allowTouchMove: false,
        speed: 1000,
        
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: '.__next',
          prevEl: '.__prev',
        },
        breakpoints: {
          0: {
            slidesPerView: 1.2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
      });
    });
  }
});