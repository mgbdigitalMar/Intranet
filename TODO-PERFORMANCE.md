# TODO: Web Performance & Session Improvements

## Steps:
1. [x] Create TODO-PERFORMANCE.md
2. [x] Edit config/session.php: Set driver='database'
3. [x] Created sessions table migration `database/migrations/2024_11_16_120000_create_sessions_table.php` (manual due to local .env syntax error)
4. [x] Edit app/Http/Controllers/DashboardController.php: Add caching to stats/queries
5. [ ] Edit config/cache.php: Set default=file/redis
6. [ ] Review AuthController.php for proper session handling
7. [ ] Run `php artisan config:cache && php artisan route:cache && php artisan view:cache`
8. [ ] Test: Login multiple browsers/tabs, check speed
9. [ ] Complete & cleanup
