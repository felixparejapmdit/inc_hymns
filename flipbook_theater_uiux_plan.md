# Flipbook Theater UI/UX Plan

## Goal
Upgrade `resources/views/partials/flipbook_theater.blade.php` into a premium, polished, and highly reliable hymn viewer that feels closer to a modern digital flipbook experience, while keeping all current visible text exactly as-is.

## Design Direction
- Keep the current visual language and text content.
- Improve the page with a more refined, premium layout.
- Use stronger spacing, hierarchy, shadows, glass effects, and motion.
- Make the interface feel intentional, cinematic, and easier to use.
- Use `publuu.com` as the reference for flipbook feel only, not for text or branding.

## Non-Negotiables
- Do not add new visible copy.
- Do not remove current labels or button text.
- Keep the existing controls and their meaning.
- Maintain compatibility with both score and lyrics mode.

## Scope
- Top bar polish.
- View toggle and utility control refinement.
- Score and lyrics pagination/reading flow.
- Realistic page flip animation for multi-page content.
- Audio play/pause behavior and state sync.
- Button reliability and interaction feedback.
- Responsive behavior on desktop and mobile.

## Planned Improvements

### 1. Overall Visual Redesign
- Rework the theater into a more premium presentation layer.
- Strengthen the visual hierarchy between:
  - top controls
  - score/lyrics stage
  - audio controls
  - page navigation
- Refine backgrounds, shadows, borders, and blur effects for a cleaner glassmorphism look.
- Keep the existing blue-toned palette, but make it richer and more dimensional.

### 2. Flipbook Pagination and Page Turns
- Improve score pagination when the document has more than one page.
- Replace the current paging feel with a more realistic flipbook motion.
- Make page transitions smoother and more natural, with better easing and timing.
- Preserve page spread logic for desktop and single-page behavior for smaller screens.
- Keep page numbers and spread indicators accurate during navigation.

### 3. Lyrics and Score Viewing Experience
- Make lyrics and score transitions feel consistent and polished.
- Keep zoom behavior functional, but ensure it does not interfere with page flipping.
- Improve overflow handling so content remains readable at all zoom levels.
- Make the reading surface feel stable and responsive when switching views.

### 4. Audio Play/Pause State
- Ensure the lower-left play button is fully synchronized with the audio element.
- When audio is playing, show the pause icon.
- When audio is paused or stopped, show the play icon.
- Keep the icon state in sync after:
  - play
  - pause
  - ended
  - track change
  - view change
- Make sure the control works reliably even after loading a new hymn track.

### 5. Button Reliability
- Review all buttons in the theater and confirm they work consistently:
  - track buttons
  - score/lyrics toggle
  - details
  - playlist
  - zoom controls
  - download menu
  - fullscreen
  - close
  - previous/next page buttons
- Add clearer hover, active, disabled, and loading states.
- Prevent accidental double actions or stale state after navigation.

### 6. Responsive Behavior
- Make the theater feel balanced on desktop, tablet, and mobile.
- Preserve readability and touch usability on smaller screens.
- Keep the flipbook controls accessible when the viewport is narrow.
- Ensure the page turn effect still feels smooth on mobile without becoming heavy.

### 7. Performance and Smoothness
- Minimize layout shifts during page turns and view changes.
- Avoid unnecessary re-renders or heavy DOM updates.
- Keep animations GPU-friendly where possible.
- Make sure page flips, audio state changes, and view toggles stay responsive.

## Implementation Phases

### Phase 1: Layout and Visual Polish
- Refine the theater shell, top bar, command center, and stage framing.
- Improve spacing, alignment, and card treatment.
- Adjust typography and control sizing for a more premium look.

### Phase 2: Flipbook Motion Upgrade
- Rework the page turn animation system.
- Make multi-page navigation feel like a real book flip.
- Smooth out timing, easing, and direction changes.

### Phase 3: Audio State Sync
- Bind play/pause icon state directly to the audio element.
- Validate that the icon changes in every playback state.
- Ensure track switching resets state correctly.

### Phase 4: Control Validation
- Test every button and interaction path.
- Confirm disabled buttons stay disabled when content is missing.
- Verify that close, fullscreen, playlist, and download behaviors remain stable.

### Phase 5: Final Responsiveness Pass
- Validate on desktop and mobile widths.
- Tweak spacing and control sizes as needed.
- Confirm score and lyrics remain readable and navigable.

## Acceptance Criteria
- The page feels visibly more premium without changing any visible text.
- Score pagination feels like a real flipbook.
- Page transitions are smooth and stable.
- The play button icon always reflects the current audio state.
- All buttons function correctly and predictably.
- The interface remains responsive and usable across screen sizes.

## Notes
- Keep existing text exactly unchanged.
- Focus on polish, motion, and trustworthiness rather than adding new features.
- The result should feel modern, deliberate, and production-ready.
