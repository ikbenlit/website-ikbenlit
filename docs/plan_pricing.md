# Plan voor Gebruiksvriendelijke Prijzenbeheer

## Huidige situatie
Momenteel worden de prijspakketten gedefinieerd in `includes/pricing-data.php` met vaste waardes in PHP-code. Dit betekent dat het wijzigen van prijzen, features of andere eigenschappen van de pakketten alleen kan worden gedaan door het PHP-bestand te bewerken, wat niet gebruiksvriendelijk is voor niet-ontwikkelaars.

De huidige relevante bestanden zijn:

1. `includes/pricing-data.php` - Definieert de prijsgegevens
2. `includes/pricing-template-parts.php` - Bevat templates voor weergave
3. `page-pricing.php` - Template voor de prijzenpagina
4. `page-pricing-services.php` - Template voor prijzen en diensten
5. `js/pricing.js` - JavaScript voor interactie
6. `css/pricing.css` - Styling voor de prijzenpagina

## Doel
Het doel is om een gebruiksvriendelijke oplossing te creëren waarbij de prijzen, features en beschrijvingen kunnen worden gewijzigd via het WordPress admin dashboard, zonder code te hoeven aanpassen.

## Gekozen aanpak: WordPress Customizer
We gaan de WordPress Customizer API gebruiken om de prijsinstellingen te beheren. De Customizer heeft verschillende voordelen:

**Voordelen:**
- Ingebouwde WordPress-functionaliteit, geen plugins nodig
- Live preview van wijzigingen voordat ze worden gepubliceerd
- Gebruiksvriendelijke interface
- Makkelijk te implementeren

## Implementatieplan

### Stap 1: Customizer sectie en instellingen maken ✅
We maken een nieuw bestand `includes/customizer/pricing-customizer.php` waarin we de Customizer-functies definiëren.

**Status:** Voltooid
- Directory `includes/customizer` gemaakt
- Bestand `pricing-customizer.php` gemaakt met alle benodigde instellingen
- Alle drie de pakketten (Starter, Professional, Enterprise) volledig geïmplementeerd

### Stap 2: Customizer secties en velden definiëren ✅
We maken de volgende secties en velden:

1. **Algemene prijsinstellingen:** ✅
   - Titel van prijzensectie
   - Beschrijving van prijzensectie

2. **Pakket 1 (Starter):** ✅
   - Naam
   - Prijs
   - Periode (per maand/jaar)
   - Beschrijving
   - Button tekst
   - Button link
   - Is populair (checkbox)
   - Features (een tekstgebied met features gescheiden door regeleinden)

3. **Pakket 2 (Professional):** ✅
   - Zelfde velden als Pakket 1

4. **Pakket 3 (Enterprise):** ✅
   - Zelfde velden als Pakket 1

### Stap 3: Aanpassen pricing-data.php ✅
Aanpassen van de bestaande functies om gegevens uit de Customizer te halen in plaats van de hardcoded waarden.

**Status:** Voltooid
- Het bestand `includes/pricing-data.php` is aangepast om gegevens uit de Customizer te halen
- De functies `get_pricing_title()`, `get_pricing_description()` en `get_pricing_plans()` halen nu alles uit de Customizer
- De oorspronkelijke waarden zijn behouden als standaardwaarden

### Stap 4: Test en verfijn 🔄
Testen van de functionaliteit en het verfijnen van de implementatie.

**Status:** In uitvoering
- Functionaliteit werkt maar moet nog grondig getest worden
- Aanpassingen kunnen nodig zijn op basis van feedback

## Volgende stappen
- Test de functionaliteit in WordPress admin
- Verifieer dat alle wijzigingen via de Customizer correct worden doorgevoerd
- Controleer of de live preview functionaliteit goed werkt

## Notities
- Alle instellingen worden opgeslagen via de Customizer API, wat betekent dat ze in de database worden bewaard en behouden blijven na thema-updates
- De fallback-waarden zorgen ervoor dat de prijstabel er altijd goed uitziet, zelfs als er geen aanpassingen zijn gemaakt
- De interface is intuïtief en wijzigingen zijn direct zichtbaar voor de beheerders

## Afgeronde taken
- ✅ Customizer bestand maken
- ✅ Aanpassingen functions.php
- ✅ Aanpassingen pricing-data.php
