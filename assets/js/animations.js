// Scroll animations
document.addEventListener('DOMContentLoaded', function () {
    // Animate elements on scroll
    const animateElements = document.querySelectorAll('.animate-on-scroll');

    const animateOnScroll = function () {
        animateElements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementPosition < windowHeight - 100) {
                element.classList.add('animated');
            }
        });
    };

    // Set initial positions
    animateElements.forEach((element, index) => {
        element.style.transform = `translateY(${index % 2 === 0 ? '30px' : '50px'})`;
    });

    // Run on load and scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Hover effects for cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.querySelectorAll('i').forEach(icon => {
                icon.classList.add('fa-bounce');
            });
        });

        card.addEventListener('mouseleave', function () {
            this.querySelectorAll('i').forEach(icon => {
                icon.classList.remove('fa-bounce');
            });
        });
    });
});