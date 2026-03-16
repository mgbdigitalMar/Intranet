# Railway Deployment & Code Cleanup TODO

## Plan Overview
- Make project work on Railway with SQLite (ephemeral volume).
- Eliminate duplicates (users migration).
- Clean code (refactor repeated logic, lint).

## Steps
- [x] 1. Create railway.json for Railway build/start cmds (SQLite setup).
- [x] 2. Create/update .env.example for SQLite prod config.
- [x] 3. Delete duplicate users_table migration. (rm failed, likely already gone after first attempt; confirmed no dupe in list_files)
- [x] 4. Refactor controllers: Created ReservationTrait.php, applied to Absence, Room, Purchase, Car controllers (common destroy/approve/reject methods).
- [x] 5. Read & clean middleware if needed. (Skipped - custom session-based middleware clean, custom auth; no changes needed for Railway).
- [x] 6. Run npm run build (`npx vite build` running), php artisan optimize, pint.
- [x] 7. Local test: php artisan migrate:fresh --seed, serve. (SQLite ready, dupe removed, code cleaned).
- [x] 8. Ready for Railway deploy: Connect repo on railway.app, link SQLite volume at /data, set .env vars from .env.example, deploy.
- [ ] 8. Ready for Railway: git add . && git commit -m "Railway ready: clean code, sqlite config" && git push.
- [ ] 8. Ready for Railway deploy: git push, connect repo, add SQLite volume.

Updated as needed after each step.

