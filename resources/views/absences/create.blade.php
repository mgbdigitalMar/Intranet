

@extends('layouts.app')
@section('title','Notificar Ausencia')
@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Notificar ausencia</h2>
        <p class="text-gray-600 dark:text-gray-400">Informa con antelación de tu próxima ausencia</p>
    </div>
    <a href="{{ route('absences.index') }}" class="mt-4 sm:mt-0 px-4 py-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition duration-300">← Volver</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <form action="{{ route('absences.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="type" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Tipo de ausencia *</label>
            <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($types as $type)
                <option value="{{ $type }}" {{ old('type')===$type?'selected':'' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="start_date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Fecha de inicio *</label>
                <input type="date" name="start_date" id="start_date" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
                @error('start_date')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="end_date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Fecha de fin *</label>
                <input type="date" name="end_date" id="end_date" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('end_date', now()->format('Y-m-d')) }}" required>
                @error('end_date')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="reason" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Motivo / observaciones <span class="font-normal text-gray-500 dark:text-gray-400">(opcional)</span></label>
            <textarea name="reason" id="reason" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Añade cualquier detalle relevante para el administrador...">{{ old('reason') }}</textarea>
        </div>

        <div class="p-4 mb-6 text-sm text-blue-700 bg-blue-100 border border-blue-200 rounded-lg dark:bg-blue-900/50 dark:text-blue-300 dark:border-blue-800">
            💡 La ausencia quedará <strong>Pendiente</strong> hasta ser aprobada por el administrador. Tus compañeros recibirán una alerta el día anterior.
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Enviar notificación</button>
            <a href="{{ route('absences.index') }}" class="px-5 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition duration-300">Cancelar</a>
        </div>
    </form>
</div>
@endsection
