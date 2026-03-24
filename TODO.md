# Intranet Performance Optimization TODO

## Plan Steps (Approved)

### 1. Config Updates ✅ [Completed]
- [x] Switch cache.php default to 'redis'
- [x] Switch session.php driver to 'redis'

### 2. Controller Optimizations
- [x] DashboardController: Optimize birthday/alert queries, add caching
- [x] AbsenceController: Add pagination to admin/mine lists
- [x] PurchaseController: Add pagination to index
- [x] EmployeeController: Add pagination + caching

### 3. View Updates
- [x] absences/index.blade.php: Add pagination links
- [x] purchases/index.blade.php: Add pagination
- [x] employees/index.blade.php: Add pagination + search persistence

### 4. Database Indexes
- [x] Create new migration for indexes ✅ database/migrations/2024_11_17_000000_add_performance_indexes.php
- [ ] Run `php artisan migrate` (fix .env APP_NAME quotes first)

### 5. Additional Optimizations
- [x] AppServiceProvider: Extended caching
- [x] Vite build/prod assets (npm run build done)
- [x] Railway: Good (Redis vars, caches); add Railway Redis addon

### 6. Testing & Deploy
- [ ] Test all routes/views
- [ ] `php artisan optimize`
- [ ] `npm run build`
- [ ] Deploy & benchmark

**Next step: Controller optimizations**

