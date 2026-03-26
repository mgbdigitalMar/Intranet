@extends('layouts.app')
@section('title','Salas')

@push('css')
<style>
  .room-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:16px;
    padding:20px;
    text-align:center;
    transition:all .25s ease;
  }
  .room-card:hover{
    border-color:var(--border2);
    transform:translateY(-3px);
    box-shadow:var(--shadow);
  }
  .room-status{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
  }
  .room-status.occupied{
    background:var(--red-dim);
    color:var(--red);
  }
  .room-status.available{
    background:var(--green-dim);
    color:var(--green);
  }
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🚪 Reservas de Salas</h2>
    <p class="section-subtitle">Gestiona la disponibilidad de las salas de reuniones</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('rooms.create') }}" class="btn btn-primary"><span>+</span> Reservar sala</a>
  </div>
</div>

{{-- Room status cards --}}
<div class="four-col" style="margin-bottom:28px;">
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
    <div class="room-card">
        <div style="font-size:32px;margin-bottom:12px;">🚪</div>
        <h3 style="font-weight:700;font-size:16px;margin-bottom:4px;">{{ $room->name }}</h3>
        <p style="font-size:12px;color:var(--text2);margin-bottom:14px;">Cap. {{ $room->capacity }} personas</p>
        @if($isOccupied)
        <span class="room-status occupied">🔴 Ocupada</span>
        @else
        <span class="room-status available">🟢 Libre ahora</span>
        @endif
    </div>
    @endforeach
</div>

<div class="two-col">
    {{-- My reservations --}}
    <div class="card card-glow">
        <div class="card-title"><span>📋</span> Mis próximas reservas</div>
        @if($myRes->isEmpty())
        <div class="empty"><div class="e-icon">📅</div><p>No tienes reservas activas</p></div>
        @else
        <div style="display:flex;flex-direction:column;gap:8px;">
            @foreach($myRes->take(5) as $r)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:14px;background:var(--surface2);border-radius:12px;border:1px solid var(--border);">
                <div>
                    <div style="font-weight:700;font-size:14px;">{{ $r->room }}</div>
                    <div style="font-size:12px;color:var(--text2);">{{ $r->date->format('d/m/Y') }} · {{ $r->hour }} ({{ $r->duration }}h)</div>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    @include('partials.status', ['status' => $r->status])
                    <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none;border:none;cursor:pointer;font-size:16px;opacity:.7;transition:opacity .2s;" title="Cancelar">🗑️</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Quick info --}}
    <div class="card card-glow">
        <div class="card-title"><span>ℹ️</span> Información</div>
        <div style="font-size:14px;color:var(--text2);line-height:1.9;">
            <p><strong>⏰</strong> Disponible de <span style="color:var(--text);font-weight:600;">08:00 a 20:00</span></p>
            <p><strong>📅</strong> Reservas desde hoy en adelante</p>
            <p><strong>⚡</strong> Confirmación por el administrador</p>
        </div>
        <div style="margin-top:16px;padding:14px;background:var(--surface2);border-radius:12px;border:1px solid var(--border);font-size:13px;color:var(--text2);">
            <strong style="color:var(--primary);">💡 Tip:</strong> Indica el motivo de la reunión para facilitar la aprobación.
        </div>
    </div>
</div>

<div style="background:var(--surface);padding:20px;border-radius:12px;border:1px solid var(--border);margin:24px 0;">
    <form method="GET" style="display:flex;flex-wrap:wrap;gap:12px;align-items:end;max-width:400px;">
        <div>
            <label style="display:block;font-weight:500;margin-bottom:4px;color:var(--text);">Desde</label>
            <input type="date" name="from" value="{{ $from }}" class="form-control" style="width:140px;">
        </div>
        <div>
            <label style="display:block;font-weight:500;margin-bottom:4px;color:var(--text);">Hasta</label>
            <input type="date" name="to" value="{{ $to }}" class="form-control" style="width:140px;">
        </div>
        <button type="submit" class="btn btn-primary" style="white-space:nowrap;">🔍 Filtrar</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-ghost">Limpiar</a>
    </form>
    @if($from && $to)
        <p style="margin-top:12px;font-size:14px;color:var(--text);">
            Mostrando reservas del {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}
            ({{ $allRes->count() }} resultados)
        </p>
    @endif
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
