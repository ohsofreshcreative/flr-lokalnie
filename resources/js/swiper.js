
/*--- SWIPER ---*/

import Swiper from 'swiper';
import 'swiper/css';

// Dodatkowe moduły (opcjonalnie)
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

Swiper.use([Navigation, Pagination, Autoplay]);


/*--- SWIPER ---*/

const swiperOptionsAnchorsSlider = {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 32,
	freeMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
};

document.addEventListener('DOMContentLoaded', function () {
const swiperContainer = document.querySelector('.mySwiper');
const swiper = new Swiper(swiperContainer, swiperOptionsAnchorsSlider);
});

const swiperReviews = {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 0,
	freeMode: true,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
};

document.addEventListener('DOMContentLoaded', function () {
const swiperContainer = document.querySelector('.sliders');
const swiper = new Swiper(swiperContainer, swiperReviews);
});

/*--- SWIPER ---*/

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});


document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.reviews-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.offer-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      const swiper = new Swiper(container, {
        slidesPerView: 3,
        spaceBetween: 32,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
        breakpoints: {
          0: { slidesPerView: 1.1, spaceBetween: 20 },
          768: { slidesPerView: 2.2, spaceBetween: 30 },
          1024: { slidesPerView: 3.2, spaceBetween: 32 },
        },
        on: {
          init: function () {
            updateFirstVisibleSlide(this, container);
          },
          slideChange: function () {
            updateFirstVisibleSlide(this, container);
          },
        },
      });

      // Helper function to update first visible slide
      function updateFirstVisibleSlide(swiperInstance, swiperContainer) {
        // First, remove the class from all slides within THIS specific swiper only
        const allSlides = swiperContainer.querySelectorAll('.swiper-slide');
        allSlides.forEach((slide) => {
          slide.classList.remove('first-visible-slide');
        });

        // Then, add the class only to the first visible slide of THIS swiper
        if (swiperInstance.slides[swiperInstance.activeIndex]) {
          swiperInstance.slides[swiperInstance.activeIndex].classList.add(
            'first-visible-slide'
          );
        }
      }
    });
  }
});
