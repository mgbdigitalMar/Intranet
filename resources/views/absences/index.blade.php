@extends('layouts.app')
@section('title','Ausencias')
@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Ausencias</h2>
        <p class="text-gray-600 dark:text-gray-400">Notifica tus ausencias con antelación</p>
    </div>
    <a href="{{ route('absences.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">+ Notificar ausencia</a>
</div>

{{-- My absences --}}
<h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">🏖️ Mis ausencias</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @forelse($mine as $ab)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $ab->type }}</h4>
            @include('partials.status', ['status'=>$ab->status])
        </div>
        <div class="p-4 text-sm text-gray-600 dark:text-gray-400 space-y-2">
            <p><strong>📅 Inicio:</strong> {{ $ab->start_date->format('d/m/Y') }}</p>
            <p><strong>📅 Fin:</strong> {{ $ab->end_date->format('d/m/Y') }} ({{ $ab->start_date->diffInDays($ab->end_date) + 1 }}d)</p>
            <p><strong>📝 Motivo:</strong> {{ $ab->reason ?: '—' }}</p>
        </div>
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center text-gray-500 dark:text-gray-400">
        <p>No has notificado ninguna ausencia todavía</p>
    </div>
    @endforelse
</div>

{{-- Admin: all absences --}}
@if(session('user_role')==='admin')
<h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4 mt-10">📋 Todas las ausencias (Admin)</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($all as $ab)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $ab->user->name }}</h4>
            @include('partials.status', ['status'=>$ab->status])
        </div>
        <div class="p-4 text-sm text-gray-600 dark:text-gray-400 space-y-2 flex-grow">
            <p><strong>📝 Tipo:</strong> {{ $ab->type }}</p>
            <p><strong>📅 Fechas:</strong> {{ $ab->start_date->format('d/m/Y') }} → {{ $ab->end_date->format('d/m/Y') }}</p>
            <p><strong>⏳ Duración:</strong> {{ $ab->start_date->diffInDays($ab->end_date) + 1 }} día(s)</p>
            <p><strong>📄 Motivo:</strong> {{ $ab->reason ?: '—' }}</p>
        </div>
        @if($ab->status==='pendiente' || session('user_role')==='admin')
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-2">
            @if($ab->status==='pendiente')
            <form action="{{ route('absences.approve', $ab->id) }}" method="POST">@csrf<button type="submit" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition-colors">✅ Aprobar</button></form>
            <form action="{{ route('absences.reject', $ab->id) }}" method="POST">@csrf<button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition-colors">❌ Rechazar</button></form>
            @endif
            <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors" title="Eliminar">🗑️</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center text-gray-500 dark:text-gray-400">
        <p>Sin ausencias registradas</p>
    </div>
    @endforelse
</div>
@endif

@endsection
