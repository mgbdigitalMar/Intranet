@extends('layouts.app')
@section('title','Vehículos')

@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Vehículos de Empresa</h2>
        <p class="text-gray-600 dark:text-gray-400">Reserva un vehículo para desplazamientos corporativos</p>
    </div>
    <a href="{{ route('cars.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">+ Reservar vehículo</a>
</div>

{{-- Fleet status --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @foreach($cars as $car)
    @php
        $todayReserved = $allRes->where('car', $car->fullName())->where('date', now()->toDateString())->where('status','confirmada')->first();
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center flex flex-col items-center">
        <div class="text-5xl mb-3">🚗</div>
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $car->name }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $car->plate }} · {{ $car->model }}</p>
        @if($todayReserved)
        <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-900/50 dark:text-red-300">🔴 Reservado hoy</span>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Destino: {{ $todayReserved->destination }}</p>
        @else
        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900/50 dark:text-green-300">🟢 Disponible</span>
        @endif
    </div>
    @endforeach
</div>

{{-- Reservations table --}}
<h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">📋 Reservas de vehículos</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($allRes as $r)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h4 class="font-bold text-gray-800 dark:text-gray-200">🚗 {{ $r->car }}</h4>
            @include('partials.status', ['status'=>$r->status])
        </div>
        <div class="p-4 text-sm text-gray-600 dark:text-gray-400 space-y-2 flex-grow">
            <p><strong>👤 Empleado:</strong> {{ $r->user->name }}</p>
            <p><strong>📅 Fecha:</strong> {{ $r->date->format('d/m/Y') }} · {{ $r->hour }}</p>
            <p><strong>📍 Destino:</strong> {{ $r->destination }}</p>
            <p><strong>📝 Motivo:</strong> {{ $r->reason ?: '—' }}</p>
        </div>
        @if(session('user_role')==='admin')
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-2">
            @if($r->status==='pendiente')
            <form action="{{ route('cars.approve', $r->id) }}" method="POST">@csrf<button type="submit" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition-colors">✅ Aprobar</button></form>
            @endif
            <form action="{{ route('cars.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition-colors" title="Cancelar">🗑️ Cancelar</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center text-gray-500 dark:text-gray-400">
        <p>Sin reservas de vehículos</p>
    </div>
    @endforelse
</div>
@endsection
