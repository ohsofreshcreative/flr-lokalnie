import.meta.glob(['../images/**', '../fonts/**']);

import './menubar.js';
import './footer-accordion.js';
import './swiper.js';
import './lightbox.js';
import './registration.js';
import './blocks/slides.js';

/*--- GSAP ---*/

import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);


/*--- ALPINE ---*/

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/*--- GSAP ---*/

/*--- GSAP - Kompletny skrypt animacji ---*/

document.addEventListener('DOMContentLoaded', function () {
  // Rejestrujemy wtyczkę ScrollTrigger
  gsap.registerPlugin(ScrollTrigger);

  // Przechodzimy przez każdą sekcję z atrybutem animacji
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {

    // --------------------------------------------------------------------
    // 1. ANIMACJA ODKRYWANIA OBRAZKA (REVEAL EFFECT Z MASKĄ CSS)
    //    Obsługuje: data-gsap-element="img-left" i "img-right"
    // --------------------------------------------------------------------
    const revealImages = section.querySelectorAll("[data-gsap-element='img-left'], [data-gsap-element='img-right']");

    revealImages.forEach((wrapper) => {
      const img = wrapper.querySelector('img');
      const direction = wrapper.dataset.gsapElement;

      // Ustawiamy stan początkowy dla obrazka wewnątrz wrappera
      gsap.set(img, {
		opacity:0,
        scale: 1.5, // Startuje lekko powiększony
        autoAlpha: 1, // Upewniamy się, że jest widoczny (maska go ukrywa)
      });

      // Definiujemy, jak ma wyglądać maska na początku i na końcu animacji
      let mask, maskTo;

      if (direction === 'img-left') {
        // Odkrywanie od lewej: maska zwija się w lewą stronę
        mask = 'inset(0% 100% 0% 0%)'; // Maska zakrywa 100% od prawej
        maskTo = 'inset(0% 0% 0% 0%)';   // Maska odkrywa wszystko
      } else {
        // Odkrywanie od prawej: maska zwija się w prawą stronę
        mask = 'inset(0% 0% 0% 100%)'; // Maska zakrywa 100% od lewej
        maskTo = 'inset(0% 0% 0% 0%)';   // Maska odkrywa wszystko
      }
      
      // Ustawiamy stan początkowy maski na wrapperze
      gsap.set(wrapper, {
        clipPath: mask,
      });

      // Tworzymy oś czasu (timeline) dla pełnej kontroli nad animacją
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: wrapper,
          start: 'top 85%', // Kiedy animacja ma się zacząć
          toggleActions: 'play none none none',
          once: true,
        },
      });

      // Animujemy jednocześnie:
      // 1. Odkrycie obrazka przez animację clip-path na wrapperze.
      // 2. Skalowanie obrazka do normalnego rozmiaru dla efektu głębi.
      tl.to(wrapper, {
          clipPath: maskTo,
          duration: 0.8,
          ease: 'power3.inOut',
        })
        .to(img, {
            scale: 1,
			opacity:1,
            duration: 0.8,
            ease: 'power3.inOut',
          },
          "<" // "<" oznacza "zacznij w tym samym czasie co poprzednia animacja"
        );
    });


    // --------------------------------------------------------------------
    // 2. STANDARDOWA ANIMACJA OBRAZKÓW (FADE IN UP)
    //    Obsługuje: data-gsap-element="img"
    // --------------------------------------------------------------------
    const standardImages = section.querySelectorAll("[data-gsap-element='img']");
    standardImages.forEach((img) => {
      gsap.from(img, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: img,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });


    // --------------------------------------------------------------------
    // 3. ANIMACJA DLA POZOSTAŁYCH ELEMENTÓW
    // --------------------------------------------------------------------
    const otherElements = section.querySelectorAll(
      "[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])"
    );
    otherElements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        delay: index * 0.1,
        scrollTrigger: {
          trigger: element,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });


    // --------------------------------------------------------------------
    // 4. ANIMACJA Z OPÓŹNIENIEM (STAGGER)
    // --------------------------------------------------------------------
    const staggerElements = section.querySelectorAll("[data-gsap-element='stagger']");
    if (staggerElements.length > 0) {
      const sorted = [...staggerElements].sort((a, b) => {
        const getDelay = (el) => {
          const attr = el.getAttribute('data-gsap-edit');
          return (attr && attr.startsWith('delay-')) ? parseFloat(attr.replace('delay-', '')) || 0 : 0;
        };
        return getDelay(a) - getDelay(b);
      });

      gsap.set(sorted, { opacity: 0, y: 50 });

      gsap.to(sorted, {
        opacity: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1,
        ease: 'power2.out',
        stagger: { amount: 1.5, each: 0.1 },
        scrollTrigger: {
          trigger: section,
          start: 'top 80%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    }

  });
});

document.addEventListener('DOMContentLoaded', function() {
    // Znajdź wszystkie linki ze strzałkami do przewijania
    const scrollArrows = document.querySelectorAll('.js-scroll-to-next');

    scrollArrows.forEach(arrow => {
        arrow.addEventListener('click', function(event) {
            // Zatrzymaj domyślną akcję linku
            event.preventDefault();

            // Znajdź najbliższą nadrzędną sekcję
            const currentSection = this.closest('section');

            if (currentSection) {
                const nextSection = currentSection.nextElementSibling;

                if (nextSection) {
                    // Wysokość Twojego menu (offset)
                    const offset = 104;

                    // Oblicz pozycję następnej sekcji względem góry strony
                    const sectionTopPosition = nextSection.getBoundingClientRect().top + window.scrollY;

                    // Odejmij wysokość menu od pozycji docelowej
                    const targetPosition = sectionTopPosition - offset;

                    // Użyj window.scrollTo, aby precyzyjnie ustawić pozycję z płynnym efektem
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});



/*--- SET PAYU AS DEFAULT ---*/

jQuery(function($) {
    function selectPayU() {
        var $input = $('#payment_method_payulistbanks');
        if ($input.length) {
            $input.prop('checked', true).trigger('change');
        }
    }

    // Po załadowaniu strony
    selectPayU();

    // Po ajaxowym przeładowaniu checkoutu
    $(document.body).on('updated_checkout', function() {
        selectPayU();
    });
});


