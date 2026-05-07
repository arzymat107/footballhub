# League Config: Талас Лига 2026 жаз

## IDs

- `season_id`: 3
- `stage_id`: 5
- `round_name`: `"Matchweek N"` (e.g. `"Matchweek 2"`)
- `round_order`: N (integer matching the matchweek number, same as shown on schedule photo as "N-ТУР")

## Squad file

`database/seeders/data/season_3_squad.json`

## Team IDs

| ID | Team           |
|----|----------------|
| 16 | Боо-Терек      |
| 17 | Арал           |
| 18 | Кара-Суу       |
| 19 | Кайнар         |
| 20 | Конезавод      |
| 21 | Покровка       |
| 22 | Чон-Алыш      |
| 23 | Беш-Таш       |
| 24 | Кыргызстан     |
| 25 | Манас (М.Р)    |
| 26 | Ак-Добо        |
| 27 | Жоон-Добо      |
| 28 | Кок-Сай        |
| 29 | Манас (Т.Р)    |
| 30 | Мин-Булак      |
| 37 | Шекер          |

## Notes

- No lineup tracking for this league — always use `"lineup": []`
- Result cards do not show goal minutes — use `"minute": null` for all events
- Venue is not shown on result cards — omit or set to `null`
- Goal notation on result cards: `Игрок(2)` means 2 goals, `Игрок(АГ.)` means own goal
- File naming: `talasliga_matchweek{N}.json` — N matches the round number (N-ТУР on schedule photo)