document.addEventListener('DOMContentLoaded', () => {
  const flash = document.querySelector('.flash');
  if (flash) {
    setTimeout(() => {
      flash.style.transition = 'opacity .5s';
      flash.style.opacity = '0';
      setTimeout(() => flash.remove(), 500);
    }, 2500);
  }

  const heroBtn = document.querySelector('.hero-btn[href="#vehicles"]');
  if (heroBtn) {
    heroBtn.addEventListener('click', (e) => {
      e.preventDefault();
      document.querySelector('#vehicles')?.scrollIntoView({ behavior: 'smooth' });
    });
  }
});
