@extends('layouts.app')
@section('title','Salas')
@section('content')

<div class="page-header">
  <div><h2>Reservas de Salas</h2><p>Gestiona la disponibilidad de las salas de reuniones</p></div>
  <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Reservar sala</a>
</div>

{{-- Room status cards --}}
<div class="four-col" style="margin-bottom:20px">
  @foreach($rooms as $room)
  @php
    $todayRes = $todayRes->where('room', $room->name);
    $isOccupied = false;
    foreach($todayRes as $r) {
      $start = \Carbon\Carbon::parse($r->date->format('Y-m-d').' '.$r->hour);
      $end   = $start->copy()->addHours($r->duration);
      if(now()->between($start,$end) && $r->status==='confirmada') { $isOccupied=true; break; }
    }
  @endphp
  <div class="card card-sm" style="text-align:center">
    <div style="font-size:28px;margin-bottom:8px">🚪</div>
    <div style="font-weight:700;font-size:14px;margin-bottom:3px">{{ $room->name }}</div>
    <div style="font-size:11px;color:var(--text2);margin-bottom:10px">Cap. {{ $room->capacity }} personas</div>
    <span class="tag {{ $isOccupied?'tag-red':'tag-green' }}">{{ $isOccupied?'🔴 Ocupada':'🟢 Libre ahora' }}</span>
  </div>
  @endforeach
</div>

<div class="two-col" style="margin-bottom:20px">
  {{-- My reservations --}}
  <div class="card">
    <div class="card-title">📋 Mis reservas</div>
    @if($myRes->isEmpty())
      <div class="empty"><p>No tienes reservas activas</p></div>
    @else
    @foreach($myRes->take(5) as $r)
    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--border)">
      <div>
        <div style="font-weight:600;font-size:13.5px">{{ $r->room }}</div>
        <div style="font-size:12px;color:var(--text2)">{{ $r->date->format('d/m/Y') }} · {{ $r->hour }} ({{ $r->duration }}h)</div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        @include('partials.status', ['status' => $r->status])
        <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Cancelar">🗑️</button>
        </form>
      </div>
    </div>
    @endforeach
    @endif
  </div>

  {{-- Quick info --}}
  <div class="card">
    <div class="card-title">ℹ️ Horarios disponibles</div>
    <div style="font-size:13.5px;color:var(--text2);line-height:1.9">
      <div>⏰ Disponible de <strong style="color:var(--text)">08:00 a 20:00</strong></div>
      <div>📅 Reservas desde hoy en adelante</div>
      <div>⚡ Confirmación por el administrador</div>
      <div style="margin-top:14px;padding:12px;background:var(--surface2);border-radius:9px;font-size:12.5px">
        💡 <strong style="color:var(--text)">Tip:</strong> Indica el motivo de la reunión para facilitar la aprobación.
      </div>
    </div>
  </div>
</div>

{{-- All reservations --}}
<div class="card">
  <div class="card-title">📅 Todas las reservas</div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Sala</th><th>Fecha</th><th>Hora</th><th>Empleado</th><th>Motivo</th><th>Estado</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($allRes as $r)
        <tr>
          <td><strong>{{ $r->room }}</strong></td>
          <td>{{ $r->date->format('d/m/Y') }}</td>
          <td>{{ $r->hour }} ({{ $r->duration }}h)</td>
          <td>{{ $r->user->name }}</td>
          <td>{{ $r->reason }}</td>
          <td>@include('partials.status', ['status' => $r->status])</td>
          <td style="display:flex;gap:6px;flex-wrap:wrap">
            @if(session('user_role')==='admin' && $r->status==='pendiente')
            <form action="{{ route('rooms.approve', $r->id) }}" method="POST">
              @csrf <button type="submit" class="btn btn-sm btn-success">✅ Confirmar</button>
            </form>
            @endif
            @if(session('user_role')==='admin' || $r->user_id===session('user_id'))
            <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
            </form>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:30px;color:var(--text2)">Sin reservas registradas</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
