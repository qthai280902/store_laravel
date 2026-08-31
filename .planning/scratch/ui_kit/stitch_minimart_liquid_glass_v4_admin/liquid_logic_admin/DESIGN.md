---
name: Liquid Logic Admin
colors:
  surface: '#f6fbef'
  surface-dim: '#d7dcd0'
  surface-bright: '#f6fbef'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f5e9'
  surface-container: '#ebf0e4'
  surface-container-high: '#e5eade'
  surface-container-highest: '#dfe4d9'
  on-surface: '#181d16'
  on-surface-variant: '#42493f'
  inverse-surface: '#2d322a'
  inverse-on-surface: '#eef2e7'
  outline: '#72796e'
  outline-variant: '#c2c9bc'
  surface-tint: '#3b6938'
  primary: '#001902'
  on-primary: '#ffffff'
  primary-container: '#003006'
  on-primary-container: '#6b9b65'
  inverse-primary: '#a0d498'
  secondary: '#994700'
  on-secondary: '#ffffff'
  secondary-container: '#ff9650'
  on-secondary-container: '#6f3200'
  tertiary: '#2f0015'
  on-tertiary: '#ffffff'
  tertiary-container: '#55002a'
  on-tertiary-container: '#d86c92'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#bcf0b2'
  primary-fixed-dim: '#a0d498'
  on-primary-fixed: '#002203'
  on-primary-fixed-variant: '#235022'
  secondary-fixed: '#ffdbc8'
  secondary-fixed-dim: '#ffb68b'
  on-secondary-fixed: '#321300'
  on-secondary-fixed-variant: '#743400'
  tertiary-fixed: '#ffd9e2'
  tertiary-fixed-dim: '#ffb0c8'
  on-tertiary-fixed: '#3e001e'
  on-tertiary-fixed-variant: '#7f244a'
  background: '#f6fbef'
  on-background: '#181d16'
  surface-variant: '#dfe4d9'
  surface-admin: '#ffffff'
  status-success: '#2b6b2c'
  status-warning: '#994700'
  status-error: '#ba1a1a'
  sidebar-glass: rgba(255, 255, 255, 0.35)
  border-subtle: '#c0c9bb'
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
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '700'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  body-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.5'
  label-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '700'
    lineHeight: '1.2'
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 12px
    fontWeight: '600'
    lineHeight: '1.2'
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 11px
    fontWeight: '600'
    lineHeight: '1.1'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  sidebar-width: 260px
  header-height: 72px
  gutter: 24px
  margin-main: 32px
  component-gap: 8px
  stack-gap: 16px
---

## Brand & Style

This design system pivots from an immersive, atmospheric consumer experience to a **Function-First Administrative Aesthetic**. It retains the sophisticated material DNA of its predecessor but re-engineers it for high-density data management, internal operations, and professional efficiency.

The style is a hybrid of **Corporate Modern** and **Selective Glassmorphism**:
- **Utility-Centric:** Data-heavy surfaces are grounded in solid, high-contrast foundations to eliminate visual noise and cognitive load during complex tasks.
- **Strategic Materiality:** Glass effects are reserved exclusively for the "Chrome" (sidebar and top bar), serving as a sophisticated framing device that provides depth without distracting from the content.
- **Professional Precision:** The organic fluidity of the original system is replaced by a structured, grid-based layout that emphasizes hierarchy, clarity, and status-driven workflows.
- **Tactile Clarity:** Using sharp shadows and clear borders for internal cards ensures that the "Solid-on-Glass" hierarchy remains distinct and accessible.

## Colors

The palette is optimized for an internal dashboard environment, emphasizing legibility and meaningful status communication.

- **Foundational Surfaces:** Unlike the atmospheric retail version, the main content area utilizes **Solid White (#ffffff)** for all tables, forms, and stat cards. This provides a "blank canvas" that maximizes focus on data.
- **Core Brand:** The deep Forest Green (`primary`) and Burnt Orange (`secondary`) are used for primary actions and navigation highlights.
- **Status Indicators:** A high-contrast "Traffic Light" system is implemented for instant recognition. These colors must be applied as solid, opaque fills for chips and badges.
- **Glass Chrome:** The left sidebar and top navigation utilize a **Regular Glass** tint (35% white) with a `backdrop-filter: blur(40px)`. This preserves the premium brand identity while visually separating the navigation from the workspace.

## Typography

This system uses **Plus Jakarta Sans** across all levels to maintain a friendly yet professional tone.

- **Information Density:** For admin dashboards, use `body-md` (16px) as the default for most data entries. Use `body-sm` (14px) for data tables and secondary metadata.
- **Semantic Hierarchy:** All caps or heavy weights (700+) should be used for `label` roles to distinguish field headers from actual data content.
- **Headlines:** Use `headline-md` for page titles and `headline-sm` for card titles to keep the layout compact.

## Layout & Spacing

The layout is designed for maximum screen real estate and logical grouping of information.

- **Fixed Sidebar:** A **260px** persistent left sidebar contains the primary navigation. It uses a glass material to provide a sense of depth over the main background.
- **Top Header:** A **72px** height header bar for breadcrumbs, search, and user profile. Also utilizes glass material for visual consistency with the sidebar.
- **Main Content:** A fluid area that expands to fill the remaining width. Content is organized into cards or "zones" separated by 24px gutters.
- **The 8px Grid:** All internal spacing within components follows an 8px rhythm. For example, 16px padding inside cards, 8px between icons and text, and 32px between major sections.

## Elevation & Depth

Hierarchy is established through a combination of backdrop-blurs and traditional shadows.

- **Tier 1 (Base):** The dashboard background (a soft neutral or white).
- **Tier 2 (Chrome):** The Sidebar and Header. Use `backdrop-blur: 40px` and a 1px `outline-variant` border on the right/bottom edges to define the frame.
- **Tier 3 (Surface):** Stat cards, Data Tables, and Forms. These are 100% opaque white. Apply a soft, diffused shadow (0px 4px 20px rgba(0, 0, 0, 0.05)) and a 1px solid `outline-variant` border to give them physical definition.
- **Tier 4 (Overlays):** Modals and dropdowns. These use "Thick Glass" (50% white tint, 50px blur) with a more pronounced shadow to indicate higher elevation.

## Shapes

The shape language uses a "Squircle" radius scale to maintain the brand's approachable character while remaining organized.

- **Large Containers:** Dashboard cards and main content wrappers use a **20px** radius.
- **Interactive Elements:** Input fields, dropdowns, and search bars use a **12px** radius.
- **Action Elements:** All buttons and status chips are **Pill-shaped** (full radius) to make them instantly identifiable as interactive or status-bearing elements.
- **Nested Logic:** If a 12px input is placed inside a 20px card, it creates a harmonious "concentric" visual flow.

## Components

### Buttons
- **Primary:** Pill-shaped, solid `primary_color_hex` with white text. No glass effects.
- **Secondary:** Pill-shaped, 100% opaque white with a 1.5px `primary` border.
- **Tertiary/Ghost:** Pill-shaped, no background, `primary` text.

### Data Tables
- **Header:** Solid light gray (`surface-container`) with `label-md` uppercase text.
- **Rows:** White background, 1px horizontal `outline-variant` dividers.
- **Radius:** The table container should have a 20px radius with `overflow: hidden`.

### Status Chips
- **Style:** Small pill-shaped badges.
- **Colors:** Use high-contrast solid fills: `status-success` (Green), `status-warning` (Orange), and `status-error` (Red). Text should be white or high-contrast neutral for accessibility.

### Input Fields
- **Base:** 100% Opaque white, 12px radius, 1px `outline-variant` border.
- **Focus:** Border changes to `primary_color_hex` with a 2px outer glow.

### Stat Cards
- **Structure:** 20px radius, white background, standard shadow.
- **Content:** Large `headline-lg` for the primary metric, `label-md` for the title, and a small status chip for "percentage change" indicators.

### Sidebar Nav
- **Material:** Regular Glass (35% white tint).
- **Active State:** A solid `primary` or `primary-container` pill background for the active link.