---
name: Liquid Glass
colors:
  surface: '#f7fbf0'
  surface-dim: '#d7dbd1'
  surface-bright: '#f7fbf0'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f5ea'
  surface-container: '#ebefe5'
  surface-container-high: '#e6eadf'
  surface-container-highest: '#e0e4d9'
  on-surface: '#181d16'
  on-surface-variant: '#41493e'
  inverse-surface: '#2d322b'
  inverse-on-surface: '#eef2e7'
  outline: '#717a6d'
  outline-variant: '#c0c9bb'
  surface-tint: '#2b6b2c'
  primary: '#003006'
  on-primary: '#ffffff'
  primary-container: '#00490e'
  on-primary-container: '#76b970'
  inverse-primary: '#92d78b'
  secondary: '#994700'
  on-secondary: '#ffffff'
  secondary-container: '#ff9650'
  on-secondary-container: '#6f3200'
  tertiary: '#56002b'
  on-tertiary: '#ffffff'
  tertiary-container: '#741a41'
  on-tertiary-container: '#f985ad'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#aef4a5'
  primary-fixed-dim: '#92d78b'
  on-primary-fixed: '#002203'
  on-primary-fixed-variant: '#0e5217'
  secondary-fixed: '#ffdbc8'
  secondary-fixed-dim: '#ffb68b'
  on-secondary-fixed: '#321300'
  on-secondary-fixed-variant: '#743400'
  tertiary-fixed: '#ffd9e2'
  tertiary-fixed-dim: '#ffb0c8'
  on-tertiary-fixed: '#3e001d'
  on-tertiary-fixed-variant: '#7f234a'
  background: '#f7fbf0'
  on-background: '#181d16'
  surface-variant: '#e0e4d9'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '800'
    lineHeight: '1.2'
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
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base_unit: 8px
  gutter: 24px
  margin_desktop: 40px
  max_width: 1280px
---

## Brand & Style

The design system is centered on a "Liquid Glass" aesthetic, engineered for a high-end grocery and retail experience. It combines the organic fluidity of fresh produce with the precision of modern technology. The visual language evokes a sense of freshness, transparency, and premium quality through the use of multi-layered translucency and vibrant color depth.

The style is a sophisticated evolution of **Glassmorphism**, characterized by:
- **Refractive Depth:** Elements appear as semi-transparent panes with varying levels of diffusion.
- **Organic Vibrancy:** Background "color orbs" create a dynamic, living canvas that pulses behind the interface.
- **Physicality:** Edge-lighting and high-saturation backdrops give the digital UI a tactile, high-gloss physical presence.
- **Clarity:** Despite the atmospheric effects, core utility zones—like prices and inputs—remain grounded in solid, opaque surfaces to ensure absolute legibility.

## Colors

This design system utilizes a palette rooted in natural, earthy tones elevated by high-chroma containers. 

- **Primary (Forest Green):** Used for brand identity and primary navigation.
- **Secondary (Burnt Orange):** Dedicated to appetite appeal and seasonal promotions.
- **Tertiary (Plum):** Reserved for high-priority badges, flash sales, and highlighted nutritional info.
- **Surface Strategy:** The background is not a flat color but an "Ambient Canvas." Large, fixed orbs of primary, secondary, and tertiary colors are blurred (80-150px) and placed at 40-60% opacity to create a luminous, liquid atmosphere.

**Accessibility Note:** Price tags and primary Call-to-Action (CTA) buttons must always reside on 100% opaque chips to maintain a minimum contrast ratio of 4.5:1.

## Typography

The typography uses **Plus Jakarta Sans** to maintain a modern, friendly, and highly legible presence. 

- **Display & Headlines:** Utilize heavy weights (700-800) to anchor the page against the soft, blurred background elements. 
- **Scale:** Large display type is used for category headers and hero banners. On mobile devices, the `headline-lg` scales down to 28px to ensure word-wrapping remains graceful on narrow viewports.
- **Line Heights:** Body text utilizes a generous 1.6x line height to ensure readability in ingredient lists and product descriptions.

## Layout & Spacing

The layout follows a strict **12-column fluid grid** for desktop, constrained by a maximum width of 1280px to prevent excessive line lengths on ultra-wide monitors.

- **Vertical Rhythm:** All vertical spacing (margins, padding, gap) must be multiples of **8px**.
- **Desktop:** 40px external margins with 24px gutters.
- **Tablet (768px - 1024px):** Transitions to an 8-column grid with 24px margins.
- **Mobile (Below 768px):** Transitions to a 4-column grid with 16px margins and 16px gutters.
- **Grouping:** Use the 8px unit to define internal component spacing (e.g., 8px between an icon and text, 16px between a headline and body text).

## Elevation & Depth

Depth is conveyed through a tiered "Glass Material" system. Each tier increases in opacity and blur to signify its distance from the background. Every glass element includes `backdrop-filter: saturate(180%)`.

| Tier | Material | Backdrop Blur | Tint (White) | Usage |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Ultra-thin | 20px | 15% | Tooltips, Hover overlays |
| 2 | Thin | 30px | 25% | List rows, Filter chips |
| 3 | Regular | 40px | 35% | Nav bars, Product cards |
| 4 | Thick | 50px | 50% | Modals, Checkout panels |
| 5 | Ultra-thick | 60px | 65% | Cart drawers, Mega-menus |

**Edge Lighting (Spec):**
To simulate the refraction of glass, apply a dual-border treatment:
- **Top Border:** 1.5px solid white (70-90% opacity).
- **Side/Bottom Borders:** 1px solid white (20-30% opacity).

## Shapes

The shape language uses **Concentric Squircles** to avoid the "harshness" of standard geometric radii. 

- **Cards & Containers:** 20px corner radius.
- **Inputs & Buttons:** 12px corner radius for standard fields.
- **Pills:** All primary buttons and status badges utilize a full "Pill" radius (999px).
- **Hierarchy:** Elements nested inside cards should have a slightly smaller radius (e.g., a 12px button inside a 20px card) to maintain visual harmony and "parallel" curves.

## Components

### Buttons
- **Primary:** Full pill-shaped, 100% opaque `primary_color_hex`. White text. High-contrast shadow for depth.
- **Secondary:** Regular glass material (35% white) with 1.5px edge lighting.

### Input Fields
- **Surface:** Solid `#ffffff` (100% opaque). 
- **Border:** 1px subtle neutral-variant.
- **Radius:** 12px.
- **Note:** Inputs must be solid white to ensure "dense" data entry areas remain focused and free of background color interference.

### Product Cards
- **Material:** Regular Glass (Tier 3).
- **Radius:** 20px squircle.
- **Price Tag:** Positioned as a floating 100% opaque white chip with `on-surface` text color.

### Cart Drawer
- **Material:** Ultra-thick Glass (Tier 5).
- **Motion:** Slides from the right with a 300ms ease-out, creating a blurring effect over the main content as it enters.

### Chips & Filters
- **Material:** Thin Glass (Tier 2).
- **Interaction:** On selection, transition to solid `primary_container` or `secondary_container`.