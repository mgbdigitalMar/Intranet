@extends('layouts.app')
@section('title','Vehículos')

@push('css')
<style>
  .car-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:16px;
    padding:24px;
    text-align:center;
    transition:all .25s ease;
  }
  .car-card:hover{
    border-color:var(--border2);
    transform:translateY(-3px);
    box-shadow:var(--shadow);
  }
  .car-status{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
  }
  .car-status.reserved{
    background:var(--red-dim);
    color:var(--red);
  }
  .car-status.available{
    background:var(--green-dim);
    color:var(--green);
  }
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🚗 Vehículos de Empresa</h2>
    <p class="section-subtitle">Reserva un vehículo para desplazamientos corporativos</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('cars.create') }}" class="btn btn-primary"><span>+</span> Reservar vehículo</a>
  </div>
</div>

{{-- Fleet status --}}
<div class="three-col" style="margin-bottom:28px;">
    @foreach($cars as $car)
    @php
        $todayReserved = $allRes->where('car', $car->fullName())->where('date', now()->toDateString())->where('status','confirmada')->first();
    @endphp
    <div class="car-card">
        <div style="font-size:42px;margin-bottom:12px;">🚗</div>
        <h3 style="font-weight:700;font-size:17px;margin-bottom:4px;">{{ $car->name }}</h3>
        <p style="font-size:12px;color:var(--text2);margin-bottom:14px;">{{ $car->plate }} · {{ $car->model }}</p>
        @if($todayReserved)
        <span class="car-status reserved">🔴 Reservado hoy</span>
        <p style="font-size:11px;color:var(--text2);margin-top:8px;">Destino: {{ $todayReserved->destination }}</p>
        @else
        <span class="car-status available">🟢 Disponible</span>
        @endif
    </div>
    @endforeach
</div>

<div style="background:var(--surface);padding:20px;border-radius:12px;border:1px solid var(--border);margin-bottom:24px;">
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
        <a href="{{ route('cars.index') }}" class="btn btn-ghost">Limpiar</a>
    </form>
    @if($from && $to)
        <p style="margin-top:12px;font-size:14px;color:var(--text);">
            Mostrando reservas del {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}
            ({{ $allRes->count() }} resultados)
        </p>
    @endif
</div>

{{-- Reservations table --}}
<div class="section-header">
  <h2 class="section-title"><span>📋</span> Reservas de vehículos</h2>
  <p class="section-subtitle">Historial de reservas</p>
</div>

<div class="data-grid">
    @forelse($allRes as $r)
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title">🚗 {{ $r->car }}</div>
            @include('partials.status', ['status'=>$r->status])
        </div>
        <div class="data-card-body">
            <div class="data-card-row"><span>👤</span> <strong>{{ $r->user->name }}</strong></div>
            <div class="data-card-row"><span>📅</span> <strong>{{ $r->date->format('d/m/Y') }} · {{ $r->hour }}</strong></div>
            <div class="data-card-row"><span>📍</span> <strong>{{ $r->destination }}</strong></div>
            <div class="data-card-row"><span>📝</span> <strong>{{ $r->reason ?: '—' }}</strong></div>
        </div>
        @if(session('user_role')==='admin')
        <div class="data-card-footer" style="border-top:1px solid var(--border);padding-top:12px;margin-top:12px;">
            @if($r->status==='pendiente')
            <form action="{{ route('cars.approve', $r->id) }}" method="POST">@csrf<button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button></form>
            @endif
            <form action="{{ route('cars.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="Cancelar">🗑️</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="empty" style="grid-column:1/-1;"><div class="e-icon">🚗</div><p>Sin reservas de vehículos</p></div>
    @endforelse
</div>
@endsection
