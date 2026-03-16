<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\RoomReservation;
use App\Models\CarReservation;
use App\Models\PurchaseRequest;
use App\Models\Absence;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $today    = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();

        // Stats (cached)
        $stats = Cache::remember("dashboard_stats_user_{session('user_id')}", 300, function () use ($today) {
            return [
                'rooms'     => RoomReservation::where('date', $today)->count(),
                'cars'      => CarReservation::where('date', '>=', $today)->count(),
                'purchases' => PurchaseRequest::where('status', 'pendiente')->count(),
                'absences'  => Absence::whereYear('start_date', now()->year)->whereMonth('start_date', now()->month)->count(),
            ];
        });

        // Upcoming events (next 30 days)
        $upcomingEvents = News::where('type', 'evento')
            ->whereNotNull('event_date')
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->limit(5)
            ->get();

        // Upcoming birthdays
        $allUsers = User::whereNotNull('birthday')->get();
        $birthdays = $allUsers->map(function ($u) {
            return ['user' => $u, 'days' => $u->daysUntilBirthday()];
        })->sortBy('days')->take(6)->values();

        // Recent absences
        $recentAbsences = Absence::with('user')->orderBy('created_at', 'desc')->limit(5)->get();

        // ALERTS
        $alerts = [];

        // Birthday alerts: today and tomorrow
        foreach ($allUsers as $u) {
            if ($u->id === session('user_id')) continue;
            $days = $u->daysUntilBirthday();
            if ($days === 0)
                $alerts[] = ['type' => 'birthday', 'msg' => "🎉 ¡Hoy es el cumpleaños de <strong>{$u->name}</strong>!"];
            if ($days === 1)
                $alerts[] = ['type' => 'birthday', 'msg' => "🎂 Mañana es el cumpleaños de <strong>{$u->name}</strong>. ¡No olvides felicitarle!"];
        }

        // Event alerts: today and tomorrow
        foreach ($upcomingEvents as $ev) {
            $evDate = $ev->event_date->toDateString();
            if ($evDate === $today)
                $alerts[] = ['type' => 'event', 'msg' => "📅 Hoy hay un evento: <strong>{$ev->title}</strong>"];
            if ($evDate === $tomorrow)
                $alerts[] = ['type' => 'event', 'msg' => "🔔 Mañana hay un evento: <strong>{$ev->title}</strong>"];
        }

        // Absence alerts
        $todayAbsences = Absence::with('user')
            ->where(function($q) use ($today, $tomorrow) {
                $q->where('start_date', $today)->orWhere('start_date', $tomorrow);
            })
            ->where('status', 'aprobada')
            ->get();

        foreach ($todayAbsences as $ab) {
            if ($ab->user_id === session('user_id')) continue;
            $when = $ab->start_date->toDateString() === $today ? 'hoy' : 'mañana';
            $alerts[] = ['type' => 'absence', 'msg' => "🏖️ <strong>{$ab->user->name}</strong> estará ausente {$when} ({$ab->type})"];
        }

        return view('dashboard', compact('stats', 'upcomingEvents', 'birthdays', 'recentAbsences', 'alerts'));
    }
}
