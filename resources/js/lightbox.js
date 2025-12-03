import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';

const initLightbox = () => {
  const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: false,
  });
};

document.addEventListener('DOMContentLoaded', initLightbox);

// Obsługa dla edytora bloków Gutenberga (jeśli jest potrzebna)
if (window.acf) {
  window.acf.addAction('render_block_preview', initLightbox);
}