# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**Full dev environment (server + queue + logs + vite in one):**
```bash
composer run dev
```

**Individual processes:**
```bash
php artisan serve
npm run dev
php artisan queue:listen --tries=1 --timeout=0
```

**Database:**
```bash
php artisan migrate
php artisan migrate:fresh --seed
```

**Testing:**
```bash
php artisan test                        # all tests
php artisan test --filter=TestName      # single test
composer run test                       # also runs lint check first
```

**Linting & formatting:**
```bash
composer run lint          # PHP (Pint) - auto-fix
npm run lint               # JS/TS (ESLint) - auto-fix
npm run format             # Prettier - auto-fix
npm run types:check        # TypeScript type check (no emit)
```

**Build:**
```bash
npm run build
```

## Architecture

### Full-Stack: Laravel + Inertia + Vue 3

This is a **Laravel 12 / Vue 3 / Inertia.js** SPA-style app. There is no separate API — controllers return `Inertia::render()` responses, and Vue pages receive typed props directly. The bridge is `HandleInertiaRequests` middleware (`app/Http/Middleware/HandleInertiaRequests.php`), which shares global props (`auth.user`, `name`, `sidebarOpen`) to every page.

Auth is handled entirely by **Laravel Fortify** — do not add custom auth controllers. Settings routes are in `routes/settings.php`, app routes in `routes/web.php`.

### Frontend structure

```
resources/js/
  pages/        # Vue page components (map 1:1 to Inertia routes)
  layouts/      # AppLayout.vue (sidebar), AuthLayout.vue
  components/   # ui/ (Reka UI wrappers), app/ (app-specific)
  composables/  # useAppearance, useCurrentUrl, useInitials, useTwoFactorAuth
  types/        # TypeScript types (auth.ts, navigation.ts, ui.ts) — re-exported from index.ts
```

Pages use `AppLayout.vue` (which wraps `AppSidebarLayout`) for authenticated views and `AuthLayout.vue` for auth pages. Import alias `@/` maps to `resources/js/`.

**UI components** in `resources/js/components/ui/` are thin wrappers around **Reka UI** primitives styled with Tailwind CSS 4. Use these before creating new components.

**Routing on the frontend** uses **Laravel Wayfinder** (`@laravel/vite-plugin-wayfinder`) — named route helpers are auto-generated. Use the generated helpers instead of hardcoded strings.

### Domain models (football)

The core domain follows this hierarchy:

```
League → Division → Season → Stage(s) → Round / StageGroup → Tie → Fixture
```

Key design decisions:
- **`Season`** is the central entity — it holds `format` (round_robin, knockout, group_knockout, playoff), `status`, and `track_players`. Format and player tracking can differ per season even within the same division.
- **`Stage`** represents a phase within a season. A `playoff` season has two stages: a `league` stage (regular season) then a `knockout` stage. A `group_knockout` season has a `group` stage then a `knockout` stage.
- **`Round`** serves double duty: matchdays in league stages, bracket rounds in knockout stages.
- **`Tie`** represents a two-team matchup in knockout (one or two legs/fixtures). Use `Tie::aggregateScore()` to compute totals across legs.
- **`Round::isHomeAway()`** resolves home/away by falling back to the parent `Stage` if the round has no override — allows e.g. a single-leg final in an otherwise two-legged knockout.
- **Standings are computed on the fly** via `Season::standings(stageId, groupId?)` — there is no cached standings table.
- **Player stats are computed on the fly** via `Player::stats(seasonId)` — sourced from `fixture_lineups` (matches played, MVP) and `events` (goals, cards). GK-specific stats (`goalsAgainst`, `cleanSheets`) are only included when `player->position === 'goalkeeper'`.
- **`player_team_seasons`** allows the same player to play for different teams across different leagues/seasons simultaneously.
- **Events** track only: `goal`, `own_goal`, `yellow_card`, `red_card`. No live match tracking — results are entered as final scores.

### Database

PostgreSQL. Migrations are in `database/migrations/` prefixed `2026_04_18_000001` through `2026_04_18_000015`. The `stage_groups` table name avoids MySQL 8's reserved word `GROUPS`.

### Middleware pipeline

Every web request goes through `HandleAppearance` (sets theme cookie) → `HandleInertiaRequests` (shares global Inertia props) → `AddLinkHeadersForPreloadedAssets`.