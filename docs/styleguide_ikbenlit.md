# Stijlgids ikbenlit

## Kleuren

### Primaire kleuren
- Rood: `#FF0000` (Primary Red)
- Donkerblauw: `#1a1a1a` (Dark Blue)

### Accent kleuren
- Zonsondergang rood: `#FF4136` (Sunset Red)
- Zonsondergang geel: `#FFB700` (Sunset Yellow)
- Zacht paars: `#834D9B` (Soft Purple)

### Achtergrond- en tekstkleuren
- Donker paars: `#2D1832` (Dark Purple)
- Wit: `#FFFFFF` (White)
- Lichtgrijs: `#F5F5F5` (Light Gray)

### Gradiënten
- Merk gradiënt: `linear-gradient(45deg, #FF0000, #FFB700)`
- Zonsondergang gradiënt: `linear-gradient(to right, #FF4136, #FFB700)`
- Paars gradiënt: `linear-gradient(to right, #2D1832, #834D9B)`
- Donker gradiënt: `linear-gradient(135deg, #000033, #834D9B)`

## Typografie

### Lettertype
- Hoofdlettertype: Roboto
- Fallback: Arial, sans-serif

### Lettertype gewichten
- Light: 300
- Regular: 400
- Medium: 500
- Bold: 700

### Tekststijlen
- Basisregelhoogte: 1.6
- Standaard tekstkleur: #333
- Link kleur: Primary Red (#FF0000)
- Link hover kleur: Sunset Red (#FF4136)

## Layout

### Container
- Maximale breedte: 1200px
- Padding: 0 1rem
- Margin: 0 auto

### Header
- Hoogte: 60px
- Achtergrond: rgba(255, 255, 255, 0.9)
- Border-bottom: 2px solid Primary Red
- Backdrop-filter: blur(8px)
- Logo hoogte: 140px

### Navigatie
- Menu items gap: 2rem
- Font-size: 1.1rem
- Font-weight: 500
- Hover effect: kleur verandert naar Primary Red
- Actief menu item: Sunset Red

### Responsive breakpoints
- Mobiel: max-width: 768px

## Componenten

### Blog Cards
- Achtergrond: Dark Background
- Border-radius: 8px
- Box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1)
- Terminal-stijl header met gekleurde dots
- Padding: 1.5rem

### Knoppen
- Padding: 0.5rem 1rem
- Border-radius: 4px
- Hover effect: transform translateY(-2px)
- Achtergrond: Accent Color
- Tekstkleur: Text Color

### Paginering
- Margin: 2rem 0
- Page numbers padding: 0.5rem 1rem
- Border-radius: 4px
- Actieve pagina: Accent Color

## Grid Systemen

### Blog Grid
- Grid-template-columns: repeat(auto-fill, minmax(300px, 1fr))
- Gap: 2rem
- Padding: 2rem 0

### Archive Posts
- Grid-template-columns: repeat(auto-fill, minmax(300px, 1fr))
- Gap: 2rem
- Achtergrond: Light Gray
- Padding: 2rem
- Border-radius: 8px

## Animaties en Transities
- Standaard transitie: all 0.3s ease
- Header scroll effect: achtergrond en schaduw aanpassing
- Logo filter transitie: drop-shadow effect
- Link hover: kleur transitie
- Button hover: transform en achtergrond transitie
