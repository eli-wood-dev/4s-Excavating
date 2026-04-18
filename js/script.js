/**
 * Shreyas Hegde
 * 2026-03-30
 * Script for general purpose code for any page
 */
window.addEventListener("load", ()=>{
    // Intersection Observer for Slide-Up Animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.section-animate').forEach((element) => {
        observer.observe(element);
    });
})