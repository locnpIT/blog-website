document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('[data-hero-slider]');

    if (!slider) return;

    const slides = Array.from(slider.querySelectorAll('[data-slider-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-slider-dot]'));
    const prev = slider.querySelector('[data-slider-prev]');
    const next = slider.querySelector('[data-slider-next]');

    if (!slides.length) return;

    let current = 0;
    let timer = null;

    const setActive = (index) => {
        current = (index + slides.length) % slides.length;
        slides.forEach((slide, i) => slide.classList.toggle('is-active', i === current));
        dots.forEach((dot, i) => dot.classList.toggle('is-active', i === current));
        resetTimer();
    };

    const resetTimer = () => {
        if (timer) clearInterval(timer);
        timer = setInterval(() => setActive(current + 1), 7000);
    };

    prev?.addEventListener('click', () => setActive(current - 1));
    next?.addEventListener('click', () => setActive(current + 1));
    dots.forEach((dot) => {
        dot.addEventListener('click', () => setActive(Number(dot.dataset.sliderDot)));
    });

    setActive(0);
});
