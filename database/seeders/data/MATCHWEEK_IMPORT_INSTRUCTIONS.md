# AI Instructions: Generating Matchweek JSON Files

When the user asks to create a matchweek JSON file, follow these steps:

---

## Step 1 — Identify the league and read its config

The user will mention the league name in their prompt (e.g. "Суперлига", "Первая лига").
Read the corresponding league config file from `database/seeders/data/`:

| League | Config file |
|--------|-------------|
| Суперлига 2025-26 | `league_superliga_2025_26.md` |
| Талас Лига 2026 жаз | `league_talasliga_2026_zhas.md` |
| Байнур Лига 2026 жаз (Горизонт дивизион) | `league_baynur_liga_2026_zhas.md` |

The config file contains: `season_id`, `stage_id`, `round_name` format, team IDs, and the squad JSON path.

---

## Step 2 — Read reference files

- League config file (see Step 1)
- Squad JSON path from the config — **always re-read this file fresh every session; the user updates it as new players are added**
- `database/seeders/data/matchweek_example.json` — exact JSON format to follow

---

## Step 3 — Read all uploaded photos

Photos are in `C:\Users\amyktybekov\footballhub`. Extract:

| Photo type | Extract |
|------------|---------|
| Schedule (беттештердин жадыбалы) | Dates, kick-off times, home/away teams, venues |
| Starting V | Both teams' starters and bench players |
| Full Time + goals | Final score, goal scorers and minutes |
| MVP | MVP player name and which match |

---

## Step 4 — Resolve players

- Player found in squad JSON → use `"player_id"`
- Player NOT in squad JSON → use `"player_name"`. The `ImportMatches` command will create the player and attach them to the correct team and season automatically.

```json
{ "player_name": "Новый Игрок", "team_id": 15, "mvp": false }
{ "type": "goal", "team_id": 15, "player_name": "Новый Игрок", "minute": 23 }
```

---

## Step 5 — Build the JSON

Follow `matchweek_example.json` exactly. Key rules:

**own_goal**: `team_id` = the team that **benefits**, not the scorer's team.

**Instagram goal notation:**
- `Игрок(7')` → regular goal at 7'
- `Игрок(АГ7')` → own goal at 7'
- `Игрок(7'АГ20')` → regular goal at 7', own goal at 20'
- `Игрок(7'15')` → two regular goals at 7' and 15'

**Always include all fixtures from the schedule**, even if no result photo or the match didn't happen:

| Situation | `status` | `home_score` / `away_score` |
|-----------|----------|-----------------------------|
| Result photo available | `"completed"` | actual scores |
| No result photo (result unknown) | `"scheduled"` | `null` / `null` |
| ПЕРЕНОС on schedule | `"postponed"` | `null` / `null` |
| ТЕХ. ПОР. (tech defeat) on schedule | `"completed"` | `3` / `0` (winner gets 3:0) |

Note: ТЕХ. ПОР. and ПЕРЕНОС results may appear directly on the schedule photo — no separate result card.

**No goals photo** → `"events": []`

**MVP** → `"mvp": true` on that player's lineup entry, one per match.

**File naming** → one calendar day per file: `matchweek_23a.json`, `matchweek_23b.json`, ...
Save to `database/seeders/data/`.

---

## Step 6 — Run the import

```bash
php artisan import:matches database/seeders/data/matchweek_XXx.json --dry-run
php artisan import:matches database/seeders/data/matchweek_XXx.json
```
