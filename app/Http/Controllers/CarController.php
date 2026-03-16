<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarReservation;
use App\Models\CompanyCar;

class CarController extends Controller
{
    use \App\Traits\ReservationTrait;

    public function index()
    {
        $today  = now()->toDateString();
        $cars   = CompanyCar::all();
        $allRes = CarReservation::with('user')->orderBy('date','desc')->get();
        $myRes  = CarReservation::with('user')->where('user_id', session('user_id'))->orderBy('date','desc')->get();
        return view('cars.index', compact('cars','allRes','myRes','today'));
    }

    public function create()
    {
        $cars = CompanyCar::all();
        return view('cars.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car'         => 'required',
            'date'        => 'required|date|after_or_equal:today',
            'hour'        => 'required',
            'destination' => 'required|max:255',
        ], [
            'car.required'         => 'Selecciona un vehículo.',
            'destination.required' => 'Indica el destino.',
            'date.after_or_equal'  => 'La fecha no puede ser anterior a hoy.',
        ]);

        CarReservation::create([
            'user_id'     => session('user_id'),
            'car'         => $request->car,
            'date'        => $request->date,
            'hour'        => $request->hour,
            'destination' => $request->destination,
            'reason'      => $request->reason,
            'status'      => 'pendiente',
        ]);

        return redirect()->route('cars.index')->with('success', 'Reserva de vehículo solicitada. Pendiente de confirmación.');
    }

    public function destroy($id)
    {
        return $this->commonDestroy($id, CarReservation::class, 'cars.index', 'Reserva cancelada.');
    }

    public function approve($id)
    {
        return $this->commonApprove($id, CarReservation::class, 'Reserva de vehículo confirmada.', 'confirmada');
    }
}
