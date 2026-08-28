---
name: Liquid Glass
colors:
  surface: '#f7fbf0'
  surface-dim: '#d7dbd2'
  surface-bright: '#f7fbf0'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f5eb'
  surface-container: '#ebefe5'
  surface-container-high: '#e5eadf'
  surface-container-highest: '#e0e4da'
  on-surface: '#181d17'
  on-surface-variant: '#40493d'
  inverse-surface: '#2d322b'
  inverse-on-surface: '#eef2e8'
  outline: '#707a6c'
  outline-variant: '#bfcaba'
  surface-tint: '#1b6d24'
  primary: '#00490e'
  on-primary: '#ffffff'
  primary-container: '#0d631b'
  on-primary-container: '#8bdd86'
  inverse-primary: '#88d982'
  secondary: '#994700'
  on-secondary: '#ffffff'
  secondary-container: '#ff9650'
  on-secondary-container: '#6f3200'
  tertiary: '#741a41'
  on-tertiary: '#ffffff'
  tertiary-container: '#923258'
  on-tertiary-container: '#ffb6cc'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#a3f69c'
  primary-fixed-dim: '#88d982'
  on-primary-fixed: '#002203'
  on-primary-fixed-variant: '#005312'
  secondary-fixed: '#ffdbc8'
  secondary-fixed-dim: '#ffb68b'
  on-secondary-fixed: '#321300'
  on-secondary-fixed-variant: '#743400'
  tertiary-fixed: '#ffd9e2'
  tertiary-fixed-dim: '#ffb1c8'
  on-tertiary-fixed: '#3e001d'
  on-tertiary-fixed-variant: '#7f2349'
  background: '#f7fbf0'
  on-background: '#181d17'
  surface-variant: '#e0e4da'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '800'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.3'
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.4'
    letterSpacing: 0.01em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  max_width: 1280px
  columns: '12'
  gutter: 24px
  margin_desktop: 40px
  margin_mobile: 20px
  stack_gap_sm: 8px
  stack_gap_md: 16px
  stack_gap_lg: 32px
---

## Brand & Style
The design system is centered on the "Liquid Glass" aesthetic—a sophisticated evolution of Apple-inspired glassmorphism tailored for a premium grocery and retail experience. The brand personality is fresh, organic, and technologically advanced, bridging the gap between physical produce and digital convenience.

The visual style utilizes high-fidelity translucent materials, vibrant background blurs, and organic "squircle" geometry. It evokes an emotional response of clarity, freshness, and high-end curation. Every surface is treated as a physical lens that interacts with light and the colorful ambient environment behind it.

## Colors
The palette is rooted in deep botanical greens and sun-ripened oranges. The "Surface" color acts as the base canvas, while the "Surface Container Lowest" (Pure White) is reserved for high-contrast interactive elements like inputs and primary action zones.

**Ambient Background Strategy:**
The interface should never sit on a flat color. The background must feature overlapping blurred orbs (80-150px blur radius) using the ambient color tokens. These orbs should occupy the corners and mid-sections of the viewport to ensure the glass panels have rich color information to saturate and blur.

## Typography
Plus Jakarta Sans is utilized across all levels to maintain a friendly yet modern tone. Headlines use tight letter spacing and heavy weights to create a sense of confidence and "editorial" impact. Body text maintains a generous line height to ensure readability against translucent backgrounds. For mobile displays, headline sizes are scaled down slightly to maintain a balanced information density.

## Layout & Spacing
The design system employs a 12-column fluid grid with a maximum constrained width of 1280px. Content is organized into "Glass Modules" that snap to the grid. 

**Breakpoints:**
- **Desktop (1280px+):** 12 columns, 24px gutters, 40px margins.
- **Tablet (768px - 1279px):** 8 columns, 20px gutters, 32px margins.
- **Mobile (Under 768px):** 4 columns, 16px gutters, 20px margins.

Vertical rhythm is maintained through a 8px-based spacing scale, ensuring consistent gaps between glass panels and text elements.

## Elevation & Depth
Depth is communicated through five distinct material tiers. Unlike traditional shadow-based elevation, this system uses "Backdrop Blur" and "Saturation" to define hierarchy.

**Material Levels:**
1.  **Ultra-thin (Nav Bars/Tooltips):** 20px blur | 180% saturation | 15% White BG.
2.  **Thin (Sub-navigation):** 30px blur | 180% saturation | 25% White BG.
3.  **Regular (Standard Cards):** 40px blur | 180% saturation | 35% White BG.
4.  **Thick (Modals/Overlays):** 50px blur | 180% saturation | 50% White BG.
5.  **Ultra-thick (Heavy Sidebars):** 60px blur | 180% saturation | 65% White BG.

**Edge Lighting:**
To simulate physical thickness, every glass panel must have a dual-opacity border:
- **Top Edge:** 1.5px solid white (70-90% opacity) to catch the "light."
- **Side/Bottom Edges:** 1px solid white (20-30% opacity) for structural definition.

## Shapes
The shape language follows a "continuous curvature" (squircle) philosophy. This removes the visual "break" at the corners of elements, making them feel more organic.
- **Cards & Panels:** 20px squircle radius.
- **Buttons & Chips:** Full pill-shape (999px).
- **Selection Controls:** 8px radius for checkboxes to distinguish them from the pill-shaped primary actions.

## Components
**Buttons:**
- **Primary:** Solid `#0d631b` with white text. High-contrast and opaque to ensure they "pop" against glass backgrounds.
- **Secondary (Glass):** "Thin" material tier with a 1.5px top highlight.

**Input Fields:**
To ensure maximum legibility and accessibility, input fields must be solid white (`#ffffff`) with a 1px border of `#0d631b` at 10% opacity. 

**Chips & Price Tags:**
Price tags use solid `#fb7800` (Secondary Container) backgrounds with high-contrast text. This ensures critical transactional information is never lost in the translucency of the UI.

**Lists:**
List items are separated by "Ultra-thin" glass dividers rather than solid lines. Hover states should increase the saturation of the glass panel to 200%.

**Cards:**
Product cards use the "Regular" glass tier. Images inside cards should have a subtle 5% black inner stroke to prevent them from washing out against the white-tinted glass.