<?php
/**
 * Template Name: Frontpage
 */

get_header(); ?>

<main class="site-main front-page">
    <!-- Animated Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-image-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/images/front_page.png" alt="IkBenLit Hero Image" class="hero-main-image">
            </div>
            <div class="light-waves"></div>
            <div class="hero-text">
                <h1>Van slimme ideeën naar echte resultaten</h1>
                <p><em>Slimme technologie, praktisch toepasbaar. Of je nu een organisatie runt die efficiënter wil werken, AI-oplossingen wilt verkennen of behoefte hebt aan strategisch advies—ik help je van idee tot implementatie. Geen ingewikkeld gedoe, maar concrete oplossingen die werken.</em></p>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="content-section introduction">
        <div class="container">
            <div class="intro-card">
                <div class="intro-content">
                    <div class="intro-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/colin-profile.jpg" alt="Colin Lit" class="profile-image">
                    </div>
                    <div class="intro-text">
                        <h3>Hoi, ik ben Colin!</h3>
                        <p>Als consultant, AI-specialist en product owner help ik organisaties om slimmer te werken met technologie. Met 15 jaar ervaring in de zorgsector weet ik als geen ander hoe je digitale transformatie succesvol maakt—zonder poespas, maar met resultaat.</p>
                        <div class="intro-highlights">
                            <div class="highlight-item">
                                <svg class="highlight-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                </svg>
                                <h3>Expertise</h3>
                                <p>15+ jaar ervaring in zorg-IT, AI-implementaties en product ownership</p>
                            </div>
                            <div class="highlight-item">
                                <svg class="highlight-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 .75a8.25 8.25 0 0 0-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 0 0 .577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 0 1-.937-.171.75.75 0 1 1 .374-1.453 5.261 5.261 0 0 0 2.626 0 .75.75 0 1 1 .374 1.452 6.712 6.712 0 0 1-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 0 0 .577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0 0 12 .75Z" />
                                </svg>
                                <h3>Aanpak</h3>
                                <p>Pragmatisch, resultaatgericht en altijd met een vleugje humor</p>
                            </div>
                            <div class="highlight-item">
                                <svg class="highlight-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Z" />
                                </svg>
                                <h3>Focus</h3>
                                <p>Van ECD-implementaties tot AI-oplossingen die écht werken</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What I Do Section -->
    <section class="content-section what-i-do bg-gradient">
        <div class="container">
            <h2 class="section-title">
                <div class="title-underline"></div>
            </h2>
            <div class="services-list">
                <div class="service-card left">
                    <div class="service-content">
                        <h3>
                            <div class="service-icon">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 .75a8.25 8.25 0 0 0-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 0 0 .577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 0 1-.937-.171.75.75 0 1 1 .374-1.453 5.261 5.261 0 0 0 2.626 0 .75.75 0 1 1 .374 1.452 6.712 6.712 0 0 1-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 0 0 .577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0 0 12 .75Z" />
                                    <path fill-rule="evenodd" d="M9.013 19.9a.75.75 0 0 1 .877-.597 11.319 11.319 0 0 0 4.22 0 .75.75 0 1 1 .28 1.473 12.819 12.819 0 0 1-4.78 0 .75.75 0 0 1-.597-.876ZM9.754 22.344a.75.75 0 0 1 .824-.668 13.682 13.682 0 0 0 2.844 0 .75.75 0 1 1 .156 1.492 15.156 15.156 0 0 1-3.156 0 .75.75 0 0 1-.668-.824Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            Consultancy & Zorg
                        </h3>
                        <p>De zorg is constant in beweging, en met de juiste digitale tools kun je écht verschil maken. Met jarenlange ervaring in de implementatie van elektronische cliëntendossiers (ECD) help ik zorgorganisaties om soepeler en slimmer te werken. Of het nu gaat om procesoptimalisatie, hands-on workshops of strategisch advies—ik zorg ervoor dat technologie aansluit op de dagelijkse praktijk en mensen er graag mee werken. Geen dikke rapporten, maar praktische oplossingen waar je direct mee aan de slag kunt.</p>
                        
                        <div class="service-highlights">
                            <h4>Waarom met mij samenwerken?</h4>
                            <ul>
                                <li>Ik ken de GGZ- en zorgwereld door en door.</li>
                                <li>Ik maak complexe vraagstukken eenvoudig en behapbaar.</li>
                                <li>Ik sta naast je team en zorg voor échte verandering.</li>
                            </ul>
                            <p class="service-cta">Klinkt dit als iets voor jouw organisatie? Laten we eens sparren!</p>
                        </div>
                    </div>
                </div>
                
                <div class="service-card right">
                    <div class="service-content">
                        <h3>
                            <div class="service-icon">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            AI-oplossingen voor Ondernemers en Organisaties
                        </h3>
                        <p>AI klinkt voor veel ondernemers misschien nog als iets ingewikkelds, maar het biedt zoveel kansen om slimmer te werken. Ik help je om AI toe te passen op een manier die bij jouw bedrijf past—of je nu processen wilt automatiseren, klantvragen efficiënter wilt afhandelen met een chatbot, of datagedreven beslissingen wilt nemen. Geen vaag gedoe, gewoon concrete toepassingen die je direct kunt inzetten en die écht waarde toevoegen.</p>
                        
                        <div class="service-highlights">
                            <h4>Waarom AI met mij?</h4>
                            <ul>
                                <li>Ik vertaal AI naar praktische oplossingen zonder buzzwords.</li>
                                <li>Ik help je vanaf het eerste idee tot en met de uitvoering.</li>
                                <li>Toegankelijke uitleg, geen technische poespas.</li>
                            </ul>
                            <p class="service-cta">Nieuwsgierig wat AI voor jou kan betekenen? Let's talk!</p>
                        </div>
                    </div>
                </div>

                <div class="service-card left">
                    <div class="service-content">
                        <h3>
                            <div class="service-icon">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>
                            </div>
                            Productowner Services
                        </h3>
                        <p>Als productowner ben ik de schakel tussen de business en de tech. Ik help bedrijven om digitale producten te ontwikkelen die niet alleen goed werken, maar ook echt waarde toevoegen. Van het vertalen van ideeën naar heldere plannen tot het samenwerken met ontwikkelteams—ik zorg dat iedereen dezelfde kant op kijkt en dat doelen behaald worden. Mijn stijl? Duidelijk, praktisch en altijd met oog voor de eindgebruiker.</p>
                        
                        <div class="service-highlights">
                            <h4>Waarom ik?</h4>
                            <ul>
                                <li>Ervaring in softwareontwikkeling en productmanagement.</li>
                                <li>Focus op wat écht belangrijk is voor de business én gebruikers.</li>
                                <li>Niet te veel kletsen, maar resultaatgerichte actie.</li>
                            </ul>
                            <p class="service-cta">Meer weten over wat ik voor jouw project kan betekenen? Neem contact op!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-cta">
                <div class="cta-card">
                    <h3>Laten we kennismaken!</h3>
                    <p>Heb je een vraag of wil je samen sparren over slimme oplossingen? Bel me gerust of plan een kennismaking met een kop koffie. Wil je alvast een voorproefje? Mijn chatbot staat klaar om je verder te helpen.</p>
                    <p class="cta-text">Klaar om de eerste stap te zetten? Neem contact op of start een chat!</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:+31639248256">06 3924 8256</a>
                        </div>
                        <div class="contact-item">
                            <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:colin@ikbenlit.nl">colin@ikbenlit.nl</a>
                        </div>
                        <div class="contact-item">
                            <svg class="contact-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" />
                            </svg>
                            <a href="https://linkedin.com/in/colinlit" target="_blank" rel="noopener noreferrer">linkedin.com/colinlit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="floating-chat">
        <div class="speech-bubbles">
            <button class="close-bubbles" aria-label="Sluit berichten">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="speech-bubble">Hoi, ik ben Chattie!</div>
            <div class="speech-bubble">Wil je iets over Colin weten?</div>
        </div>

        <button class="chat-button" aria-label="Open chat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                <path d="M200,48H136V16a8,8,0,0,0-16,0V48H56A32,32,0,0,0,24,80V192a32,32,0,0,0,32,32H200a32,32,0,0,0,32-32V80A32,32,0,0,0,200,48Zm16,144a16,16,0,0,1-16,16H56a16,16,0,0,1-16-16V80A16,16,0,0,1,56,64H200a16,16,0,0,1,16,16Zm-52-56H92a28,28,0,0,0,0,56h72a28,28,0,0,0,0-56Zm-24,16v24H116V152ZM80,164a12,12,0,0,1,12-12h8v24H92A12,12,0,0,1,80,164Zm84,12h-8V152h8a12,12,0,0,1,0,24ZM72,108a12,12,0,1,1,12,12A12,12,0,0,1,72,108Zm88,0a12,12,0,1,1,12,12A12,12,0,0,1,160,108Z" />
            </svg>
        </button>

        <div class="chat-overlay" aria-hidden="true">
            <div class="chat-container">
                <div class="chat-header">
                    <h3>Chat met Colin's AI-sidekick</h3>
                    <button class="close-chat" aria-label="Sluit chat">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="chat-messages">
                    <div class="bot-message">
                        Hoi! Ik ben Chattie, de AI sidekick van Colin. Wat wil je van hem weten? 
                    </div>
                </div>
                <div class="chat-input-container">
                    <input type="text" id="chat-input" placeholder="Type je bericht..." aria-label="Chat bericht">
                    <button id="send-message" aria-label="Verstuur bericht">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function createLightBeams() {
    const hero = document.querySelector('.hero-content');
    for (let i = 0; i < 10; i++) {
        const beam = document.createElement('div');
        beam.classList.add('light-beam');
        beam.style.left = `${Math.random() * 100}%`;
        beam.style.animationDelay = `${Math.random() * 4}s`;
        hero.appendChild(beam);
    }
}

document.addEventListener('DOMContentLoaded', createLightBeams);

window.addEventListener('scroll', () => {
    const scrollPosition = window.scrollY;
    const heroHeight = document.querySelector('.hero').offsetHeight;
    const lightWaves = document.querySelector('.light-waves');
    const lightBeams = document.querySelectorAll('.light-beam');

    if (scrollPosition < heroHeight) {
        const progress = scrollPosition / heroHeight;
        lightWaves.style.transform = `scaleY(${1 - progress * 0.5})`;
        lightWaves.style.opacity = 1 - progress;
        lightBeams.forEach(beam => {
            beam.style.opacity = 1 - progress;
            beam.style.height = `${30 - progress * 30}%`;
        });
    }
});

// Voeg deze code toe voor de header kleur
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const hero = document.querySelector('.hero');
    
    function checkScroll() {
        if (window.scrollY > 0) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    
    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Check initial state
});
</script>

<?php get_footer(); ?> 