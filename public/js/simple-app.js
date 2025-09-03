// TopGuide - JavaScript Simple
document.addEventListener('DOMContentLoaded', function() {
    console.log('TopGuide app loaded');
    
    // Smooth scrolling pour les ancres
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Animation hover pour les cartes
    const cards = document.querySelectorAll('.voyage-card, .etape-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Navigation fonction pour programme
function scrollToDay(dayNumber) {
    const targetElement = document.querySelector(`[data-day="${dayNumber}"]`);
    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
}