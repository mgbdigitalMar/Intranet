# TODO: Add date filtering to cars and rooms reservations

## Plan Steps:
- [x] 1. Update CarController@index to handle ?from= & ?to= date filters on $allRes query (whereBetween on 'date').
- [x] 2. Update RoomController@index similarly for $allRes.
- [x] 3. Add filter form to resources/views/cars/index.blade.php above "Reservas de vehículos" section (GET form with date inputs Desde/Hasta, submit Filtrar, reset).
- [x] 4. Add filter form to resources/views/rooms/index.blade.php above "Todas las reservas" section similarly.
- [x] 5. Test: php artisan serve, visit /cars & /rooms, filter dates, verify results.
- [ ] 6. Complete task.

# TODO: Enhanced calendar view for cars/rooms occupancy (red/green dates on calendar when creating reservations)

## New Plan Steps:
- [x] 1. Create new views: resources/views/cars/calendar.blade.php & rooms/calendar.blade.php with FullCalendar JS showing reservations (rojo=confirmado, naranja=pendiente).
- [x] 2. Add controllers methods: CarController@calendar & RoomController@calendar fetching confirmed/pending reservations as events.
- [x] 3. Add links/buttons in index.blade.php to "📅 Calendario".
- [x] 4. Include FullCalendar CDN/CSS/JS per-view.
- [x] 5. Test calendar rendering and color coding (via php artisan serve).


