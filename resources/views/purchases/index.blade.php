@extends('layouts.app')
@section('title','Solicitudes de Compra')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Solicitudes de Compra</h2>
        <p class="text-gray-600 dark:text-gray-400">Solicita equipamiento para tu puesto de trabajo</p>
    </div>
    <a href="{{ route('purchases.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">+ Nueva solicitud</a>
</div>

{{-- Catalog quick buttons --}}
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🛒 Catálogo rápido</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 text-center">
        @foreach([['💻','Portátil'],['🖥️','Monitor'],['⌨️','Teclado'],['🖱️','Ratón'],['🖨️','Impresora'],['📱','Móvil'],['🎧','Auriculares'],['💺','Silla ergo.']] as [$icon,$name])
        <a href="{{ route('purchases.create') }}?item={{ urlencode("$icon $name") }}"
           class="p-4 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-lg transition duration-300">
           <div class="text-4xl">{{ $icon }}</div>
           <div class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $name }}</div>
        </a>
        @endforeach
    </div>
</div>

{{-- All requests --}}
<h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">📋 {{ session('user_role')==='admin'?'Todas las solicitudes':'Mis solicitudes' }}</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($items as $req)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col">
        {{-- Card Header --}}
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $req->item }} <span class="text-gray-500 dark:text-gray-400 font-semibold">(x{{ $req->quantity }})</span></h4>
            @include('partials.status', ['status'=>$req->status])
        </div>
        {{-- Card Body --}}
        <div class="p-4 flex-grow">
            @if(session('user_role')==='admin')
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2"><strong>👤 Solicitante:</strong> {{ $req->user->name }}</p>
            @endif
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2"><strong>📅 Fecha:</strong> {{ $req->created_at->format('d/m/Y') }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4"><strong>💰 Precio est.:</strong> {{ $req->estimated_price ? '€'.number_format($req->estimated_price,2) : '—' }}</p>
            
            <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg mb-4">
                <h5 class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase mb-1">Justificación</h5>
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $req->reason }}</p>
            </div>

            @if($req->admin_notes)
            <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 p-3 rounded-lg">
                <h5 class="text-xs font-semibold uppercase mb-1">Notas del Admin</h5>
                <p class="text-sm">{{ $req->admin_notes }}</p>
            </div>
            @endif
        </div>
        {{-- Card Footer --}}
        @if($req->status==='pendiente' && session('user_role') === 'admin')
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end space-x-2">
            <form action="{{ route('purchases.approve', $req->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition-colors">✅ Aprobar</button>
            </form>
            <form action="{{ route('purchases.reject', $req->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition-colors">❌ Rechazar</button>
            </form>
            <form action="{{ route('purchases.destroy', $req->id) }}" method="POST" onsubmit="return confirm('¿Eliminar solicitud?')">
                @csrf 
                @method('DELETE')
                <button type="submit" class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors" title="Eliminar">🗑️</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center text-gray-500 dark:text-gray-400">
        <p>Sin solicitudes de compra</p>
    </div>
    @endforelse
</div>
@endsection
