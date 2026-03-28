// Mobile menu toggle logic
document.addEventListener('load', () => {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navList = document.querySelector('.nav-list');

    if (mobileMenuBtn && navList) {
        mobileMenuBtn.addEventListener('click', () => {
            navList.classList.toggle('active');

            // Toggle hamburger icon animation
            const isMenuOpen = navList.classList.contains('active');
            mobileMenuBtn.setAttribute('aria-expanded', isMenuOpen);

            // Toggle body scroll lock to prevent scrolling background when menu is open
            document.body.style.overflow = isMenuOpen ? 'hidden' : '';

            const bars = mobileMenuBtn.querySelectorAll('.bar');
            if (isMenuOpen) {
                if (bars.length === 3) {
                    bars[0].style.transform = 'translateY(8px) rotate(45deg)';
                    bars[1].style.opacity = '0';
                    bars[2].style.transform = 'translateY(-8px) rotate(-45deg)';
                }
            } else {
                if (bars.length === 3) {
                    bars[0].style.transform = 'translateY(0) rotate(0)';
                    bars[1].style.opacity = '1';
                    bars[2].style.transform = 'translateY(0) rotate(0)';
                }
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });

                // Close mobile menu on click
                if (navList && navList.classList.contains('active')) {
                    mobileMenuBtn.click();
                }
            }
        });
    });
});
