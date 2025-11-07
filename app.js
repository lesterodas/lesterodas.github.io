document.addEventListener('DOMContentLoaded', () => {
  // Vista en telefono
  const btn = document.querySelector('#burger');
  const drawer = document.querySelector('#drawer');
  if (btn && drawer) btn.addEventListener('click', () => drawer.classList.toggle('open'));

  const links = document.querySelectorAll('nav a, .drawer a');
  links.forEach(a => {
    const href = a.getAttribute('href') || '';
    if (href && location.pathname.endsWith(href)) a.classList.add('active');
  });

  // Carrusel
  const track = document.getElementById('carouselTrack');
  if (!track) return;

  const slides = Array.from(track.children);
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const dotsContainer = document.getElementById('carouselDots');

  let index = 0;
  let timer = null;

  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('role', 'tab');
    b.setAttribute('aria-label', `Ir a la diapositiva ${i + 1}`);
    if (i === 0) b.setAttribute('aria-selected', 'true');
    dotsContainer.appendChild(b);
  });
  const dots = Array.from(dotsContainer.children);

  function goTo(i){
    index = (i + slides.length) % slides.length;
    const offset = -index * 100;
    track.style.transform = `translateX(${offset}%)`;
    slides.forEach((s, si) => s.classList.toggle('is-active', si === index));
    dots.forEach((d, di) => d.setAttribute('aria-selected', di === index ? 'true' : 'false'));
    resetAutoplay();
  }

  function next(){ goTo(index + 1); }
  function prev(){ goTo(index - 1); }

  nextBtn?.addEventListener('click', next);
  prevBtn?.addEventListener('click', prev);
  dots.forEach((d, di) => d.addEventListener('click', () => goTo(di)));

  function resetAutoplay(){
    if (timer) clearInterval(timer);
    timer = setInterval(next, 5000); // cambia cada 5s
  }
  resetAutoplay();

  track.addEventListener('mouseenter', () => timer && clearInterval(timer));
  track.addEventListener('mouseleave', resetAutoplay);
});
