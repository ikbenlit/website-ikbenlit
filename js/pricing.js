/**
 * Pricing Page JavaScript
 * 
 * Interactiviteit voor de pricing pagina op ikbenlit.nl
 */

document.addEventListener('DOMContentLoaded', function() {
    // Zorg voor zichtbaarheid van prijsplannen met een subtiele fade-in
    function handleIntersection(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }
    
    // Observeer wanneer pakketten in beeld komen
    if ('IntersectionObserver' in window) {
        const pricingPlans = document.querySelectorAll('.pricing-plan');
        const options = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(handleIntersection, options);
        
        pricingPlans.forEach(plan => {
            plan.style.opacity = '0';
            observer.observe(plan);
        });
    }
}); 