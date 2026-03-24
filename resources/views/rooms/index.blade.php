@extends('layouts.app')
@section('title','Salas')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Reservas de Salas</h2>
        <p class="text-gray-600 dark:text-gray-400">Gestiona la disponibilidad de las salas de reuniones</p>
    </div>
    <a href="{{ route('rooms.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">+ Reservar sala</a>
</div>

{{-- Room status cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    @foreach($rooms as $room)
    @php
        $roomTodayRes = $todayRes->where('room', $room->name);
        $isOccupied = false;
        foreach($roomTodayRes as $r) {
            $start = \Carbon\Carbon::parse($r->date->format('Y-m-d').' '.$r->hour);
            $end = $start->copy()->addHours($r->duration);
            if(now()->between($start, $end) && $r->status === 'confirmada') {
                $isOccupied = true;
                break;
            }
        }
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 text-center flex flex-col items-center">
        <div class="text-4xl mb-2">🚪</div>
        <h3 class="font-bold text-gray-800 dark:text-gray-200">{{ $room->name }}</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Cap. {{ $room->capacity }} personas</p>
        @if($isOccupied)
        <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-900/50 dark:text-red-300">🔴 Ocupada</span>
        @else
        <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900/50 dark:text-green-300">🟢 Libre ahora</span>
        @endif
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    {{-- My reservations --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">📋 Mis próximas reservas</h3>
        @if($myRes->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 py-4"><p>No tienes reservas activas</p></div>
        @else
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($myRes->take(5) as $r)
            <li class="py-3 flex justify-between items-center">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $r->room }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $r->date->format('d/m/Y') }} · {{ $r->hour }} ({{ $r->duration }}h)</p>
                </div>
                <div class="flex items-center gap-3">
                    @include('partials.status', ['status' => $r->status])
                    <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" title="Cancelar">🗑️</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    {{-- Quick info --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">ℹ️ Información</h3>
        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-3">
            <p>⏰ Disponible de <strong class="text-gray-800 dark:text-gray-200">08:00 a 20:00</strong></p>
            <p>📅 Reservas desde hoy en adelante</p>
            <p>⚡ Confirmación por el administrador</p>
        </div>
        <div class="mt-4 p-3 bg-gray-100 dark:bg-gray-700/50 rounded-lg text-sm text-gray-700 dark:text-gray-300">
            💡 <strong class="font-semibold">Tip:</strong> Indica el motivo de la reunión para facilitar la aprobación.
        </div>
    </div>
</div>

{{-- All reservations --}}
<h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">📅 Todas las reservas</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($allRes as $r)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h4 class="font-bold text-gray-800 dark:text-gray-200">🚪 {{ $r->room }}</h4>
            @include('partials.status', ['status' => $r->status])
        </div>
        <div class="p-4 text-sm text-gray-600 dark:text-gray-400 space-y-2 flex-grow">
            <p><strong>👤 Empleado:</strong> {{ $r->user->name }}</p>
            <p><strong>📅 Fecha:</strong> {{ $r->date->format('d/m/Y') }}</p>
            <p><strong>⏰ Hora:</strong> {{ $r->hour }} ({{ $r->duration }}h)</p>
            <p><strong>📝 Motivo:</strong> {{ $r->reason }}</p>
        </div>
        @if(session('user_role')==='admin' || $r->user_id===session('user_id'))
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-2">
            @if(session('user_role')==='admin' && $r->status==='pendiente')
            <form action="{{ route('rooms.approve', $r->id) }}" method="POST">@csrf<button type="submit" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition-colors">✅ Aprobar</button></form>
            @endif
            <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition-colors" title="Cancelar">🗑️ Cancelar</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center text-gray-500 dark:text-gray-400">
        <p>Sin reservas registradas</p>
    </div>
    @endforelse
</div>

@endsection
