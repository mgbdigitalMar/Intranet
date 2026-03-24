

@extends('layouts.app')
@section('title','Nueva Solicitud')
@section('content')

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Nueva solicitud de compra</h2>
        <p class="text-gray-600 dark:text-gray-400">Rellena el formulario para solicitar material o equipamiento</p>
    </div>
    <a href="{{ route('purchases.index') }}" class="mt-4 sm:mt-0 px-4 py-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition duration-300">← Volver</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="item-select" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Artículo *</label>
            <select name="item" id="item-select" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Selecciona un artículo --</option>
                @foreach($catalog as $cat)
                <option value="{{ $cat }}" {{ (old('item', request('item'))===$cat)?'selected':'' }}>{{ $cat }}</option>
                @endforeach
            </select>
            @error('item')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-6 hidden" id="custom-item-group">
            <label for="custom_item" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Especifica el artículo *</label>
            <input type="text" name="custom_item" id="custom_item" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('custom_item') }}" placeholder="Describe el artículo que necesitas">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="quantity" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Cantidad *</label>
                <input type="number" name="quantity" id="quantity" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('quantity',1) }}" min="1" max="100" required>
                @error('quantity')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="estimated_price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Precio estimado (€) <span class="font-normal text-gray-500 dark:text-gray-400">(opcional)</span></label>
                <input type="number" name="estimated_price" id="estimated_price" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('estimated_price') }}" step="0.01" min="0" placeholder="0.00">
            </div>
        </div>

        <div class="mb-6">
            <label for="reason" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Justificación / Motivo *</label>
            <textarea name="reason" id="reason" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="¿Por qué necesitas este artículo? ¿Cómo lo vas a utilizar?">{{ old('reason') }}</textarea>
            @error('reason')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Enviar solicitud</button>
            <a href="{{ route('purchases.index') }}" class="px-5 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition duration-300">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('item-select');
    const grp = document.getElementById('custom-item-group');
    const customInput = document.getElementById('custom_item');

    function toggleCustomItem(show) {
        grp.classList.toggle('hidden', !show);
        customInput.required = show;
    }

    sel.addEventListener('change', () => {
        toggleCustomItem(sel.value === 'Otro');
    });

    // Initial check on page load
    toggleCustomItem(sel.value === 'Otro');
});
</script>
@endsection
