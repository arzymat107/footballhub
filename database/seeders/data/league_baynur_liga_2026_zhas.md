# League Config: Байнур Лига 2026 жаз (Горизонт дивизион)

## IDs

- `season_id`: 4
- `stage_id`: 6
- `round_name`: `"Matchweek N"` (e.g. `"Matchweek 3"`)
- `round_order`: N (integer matching the matchweek number, same as shown on schedule photo as "N ТУР")

## Squad file

`database/seeders/data/season_4_squad.json`

## Team IDs

| ID | Team                 |
|----|----------------------|
| 38 | Кайнар               |
| 39 | Sumsar               |
| 40 | Mebel Zone           |
| 41 | Горная Маевка        |
| 42 | Куйручук             |
| 43 | Нац Гвардия          |
| 44 | Modul                |
| 45 | Abdyrakhman Balban   |
| 46 | Alban Express        |
| 47 | Октябрь Кузоту       |
| 48 | Бакай-Ата            |
| 49 | 1-Май                |
| 50 | Намыс                |
| 51 | Ак-Арык              |
| 52 | Терек-Таш            |
| 53 | Алтай                |

## Notes

- No lineup tracking for this league — always use `"lineup": []`
- Result cards do not show goal minutes — use `"minute": null` for all events
- Venue shown on schedule per matchday (all matches share same venue that day)
- File naming: `horizont_matchweek{N}.json` — N matches the round number (N ТУР on schedule photo)