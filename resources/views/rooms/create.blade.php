@extends('layouts.app')
@section('title','Reservar Sala')
@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Reservar sala</h2>
        <p class="text-gray-600 dark:text-gray-400">Solicita una sala de reuniones para tu equipo</p>
    </div>
    <a href="{{ route('rooms.index') }}" class="mt-4 sm:mt-0 px-4 py-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition duration-300">← Volver</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="room" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Sala *</label>
            <select name="room" id="room" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Selecciona una sala --</option>
                @foreach($rooms as $room)
                <option value="{{ $room->name }}" {{ old('room')===$room->name?'selected':'' }}>
                    {{ $room->name }} ({{ $room->capacity }} personas) — {{ $room->description }}
                </option>
                @endforeach
            </select>
            @error('room')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Fecha *</label>
                <input type="date" name="date" id="date" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                @error('date')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="hour" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Hora de inicio *</label>
                <select name="hour" id="hour" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach(['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00'] as $h)
                    <option value="{{ $h }}" {{ old('hour')===$h?'selected':'' }}>{{ $h }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-6">
            <label for="duration" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Duración</label>
            <select name="duration" id="duration" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach([1=>'1 hora',2=>'2 horas',3=>'3 horas',4=>'4 horas (media jornada)',8=>'8 horas (jornada completa)'] as $val=>$label)
                <option value="{{ $val }}" {{ old('duration')==$val?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="reason" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Motivo de la reunión *</label>
            <input type="text" name="reason" id="reason" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('reason') }}" placeholder="Ej: Reunión de equipo, Sprint review, Entrevista..." required>
            @error('reason')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="p-4 mb-6 text-sm text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-lg dark:bg-yellow-900/50 dark:text-yellow-300 dark:border-yellow-800">
            ⚡ La reserva quedará en estado <strong>Pendiente</strong> hasta que el administrador la confirme.
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Solicitar reserva</button>
            <a href="{{ route('rooms.index') }}" class="px-5 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition duration-300">Cancelar</a>
        </div>
    </form>
</div>
@endsection
