<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $today     = now()->toDateString();
        $tomorrow  = now()->addDay()->toDateString();
        $in3       = now()->addDays(3)->toDateString();
        $in7       = now()->addDays(7)->toDateString();
        $in10      = now()->addDays(10)->toDateString();
        $ago2      = now()->subDays(2)->toDateString();
        $ago5      = now()->subDays(5)->toDateString();

        // ─── USERS ───────────────────────────────────────────────────────────
        DB::table('users')->insert([
            [
                'name'       => 'Carlos Martínez',
                'email'      => 'admin@empresa.com',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'department' => 'Dirección',
                'position'   => 'Director General',
                'phone'      => '600 000 001',
                'birthday'   => '1985-03-15',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'       => 'Ana García',
                'email'      => 'ana@empresa.com',
                'password'   => Hash::make('emp123'),
                'role'       => 'employee',
                'department' => 'IT',
                'position'   => 'Desarrolladora Senior',
                'phone'      => '600 000 002',
                'birthday'   => $tomorrow,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'       => 'Luis Rodríguez',
                'email'      => 'luis@empresa.com',
                'password'   => Hash::make('emp123'),
                'role'       => 'employee',
                'department' => 'Marketing',
                'position'   => 'Diseñador UI/UX',
                'phone'      => '600 000 003',
                'birthday'   => '1991-11-20',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'       => 'Marta López',
                'email'      => 'marta@empresa.com',
                'password'   => Hash::make('emp123'),
                'role'       => 'employee',
                'department' => 'Ventas',
                'position'   => 'Comercial Senior',
                'phone'      => '600 000 004',
                'birthday'   => $in3,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'       => 'David Sánchez',
                'email'      => 'david@empresa.com',
                'password'   => Hash::make('emp123'),
                'role'       => 'employee',
                'department' => 'Finanzas',
                'position'   => 'Contable',
                'phone'      => '600 000 005',
                'birthday'   => '1988-06-05',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name'       => 'Elena Torres',
                'email'      => 'elena@empresa.com',
                'password'   => Hash::make('emp123'),
                'role'       => 'employee',
                'department' => 'RRHH',
                'position'   => 'Responsable RRHH',
                'phone'      => '600 000 006',
                'birthday'   => $in7,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // ─── ROOMS ───────────────────────────────────────────────────────────
        DB::table('company_rooms')->insert([
            ['name' => 'Sala Reuniones A',  'capacity' => 8,  'description' => 'Sala principal con proyector', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sala Reuniones B',  'capacity' => 12, 'description' => 'Sala grande con videoconferencia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sala Formación',    'capacity' => 25, 'description' => 'Aula con ordenadores', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sala Directiva',    'capacity' => 6,  'description' => 'Uso exclusivo dirección', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ─── CARS ────────────────────────────────────────────────────────────
        DB::table('company_cars')->insert([
            ['name' => 'Seat León',        'plate' => '1234-ABC', 'model' => '2022', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Volkswagen Passat','plate' => '5678-DEF', 'model' => '2021', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toyota RAV4',      'plate' => '9012-GHI', 'model' => '2023', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ─── NEWS ────────────────────────────────────────────────────────────
        DB::table('news')->insert([
            [
                'user_id'    => 1,
                'type'       => 'evento',
                'title'      => 'Reunión general de empresa Q1',
                'body'       => 'Todos los departamentos se reunirán para revisar los objetivos del primer trimestre y planificar las estrategias para el resto del año. La asistencia es obligatoria.',
                'event_date' => now()->addDays(5)->setTime(10, 0),
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'type'       => 'noticia',
                'title'      => 'Nuevo contrato con cliente premium',
                'body'       => 'Nos complace anunciar que hemos firmado un contrato de colaboración estratégica con una importante empresa del sector. Este acuerdo supone un gran impulso para nuestro crecimiento.',
                'event_date' => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'type'       => 'evento',
                'title'      => 'Taller de herramientas digitales',
                'body'       => 'Taller práctico sobre las nuevas herramientas de colaboración y productividad. Se recomienda la asistencia a todos los empleados. Habrá materiales y certificado de asistencia.',
                'event_date' => now()->addDays(10)->setTime(9, 0),
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'type'       => 'noticia',
                'title'      => 'Actualización de la política de teletrabajo',
                'body'       => 'A partir del próximo mes, se amplían los días de teletrabajo permitidos a 3 días por semana. Consulta la guía completa en el apartado de RRHH o habla directamente con Elena Torres.',
                'event_date' => null,
                'created_at' => now()->subDay(), 'updated_at' => now()->subDay(),
            ],
        ]);

        // ─── ROOM RESERVATIONS ───────────────────────────────────────────────
        DB::table('room_reservations')->insert([
            ['user_id' => 2, 'room' => 'Sala Reuniones A', 'date' => $today,   'hour' => '10:00', 'duration' => 2, 'reason' => 'Sprint review equipo IT', 'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'room' => 'Sala Reuniones B', 'date' => $today,   'hour' => '15:00', 'duration' => 1, 'reason' => 'Brief de campaña',         'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'room' => 'Sala Formación',   'date' => $in3,     'hour' => '09:00', 'duration' => 4, 'reason' => 'Onboarding nuevos comerciales', 'status' => 'pendiente', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ─── CAR RESERVATIONS ────────────────────────────────────────────────
        DB::table('car_reservations')->insert([
            ['user_id' => 3, 'car' => 'Seat León (1234-ABC)',        'date' => $tomorrow, 'hour' => '09:00', 'destination' => 'Barcelona', 'reason' => 'Visita a cliente',  'status' => 'confirmada', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'car' => 'Volkswagen Passat (5678-DEF)','date' => $in3,      'hour' => '08:00', 'destination' => 'Valencia',  'reason' => 'Feria sectorial',  'status' => 'pendiente',  'created_at' => now(), 'updated_at' => now()],
        ]);

        // ─── PURCHASE REQUESTS ───────────────────────────────────────────────
        DB::table('purchase_requests')->insert([
            ['user_id' => 2, 'item' => '💻 Ordenador portátil', 'quantity' => 1, 'reason' => 'Mi equipo actual tiene averías frecuentes y ralentiza el trabajo.', 'estimated_price' => 1200.00, 'status' => 'pendiente',  'admin_notes' => null,        'created_at' => now(),         'updated_at' => now()],
            ['user_id' => 3, 'item' => '🖥️ Monitor',            'quantity' => 2, 'reason' => 'Ampliación de espacio de trabajo con doble pantalla para diseño.', 'estimated_price' => 350.00,  'status' => 'aprobada',   'admin_notes' => 'Aprobado.',  'created_at' => now()->subDays(2), 'updated_at' => now()->subDays(2)],
            ['user_id' => 5, 'item' => '🖨️ Impresora',          'quantity' => 1, 'reason' => 'La impresora del departamento de finanzas está averiada.', 'estimated_price' => 280.00,  'status' => 'rechazada',  'admin_notes' => 'Pendiente revisión técnica primero.', 'created_at' => now()->subDays(5), 'updated_at' => now()->subDays(5)],
        ]);

        // ─── ABSENCES ────────────────────────────────────────────────────────
        DB::table('absences')->insert([
            ['user_id' => 6, 'type' => 'Vacaciones',    'start_date' => now()->addDays(14)->toDateString(), 'end_date' => now()->addDays(21)->toDateString(), 'reason' => 'Vacaciones de verano', 'status' => 'aprobada',  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'type' => 'Visita médica', 'start_date' => $tomorrow,                          'end_date' => $tomorrow,                          'reason' => 'Revisión anual',       'status' => 'pendiente', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
