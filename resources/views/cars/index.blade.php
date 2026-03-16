@extends('layouts.app')
@section('title','Vehículos')
@section('content')

<div class="page-header">
  <div><h2>Vehículos de Empresa</h2><p>Reserva un vehículo para desplazamientos corporativos</p></div>
  <a href="{{ route('cars.create') }}" class="btn btn-primary">+ Reservar vehículo</a>
</div>

{{-- Fleet status --}}
<div class="three-col" style="margin-bottom:20px">
  @foreach($cars as $car)
  @php
    $todayReserved = $allRes->where('car', $car->fullName())->where('date', now()->toDateString())->where('status','confirmada')->first();
  @endphp
  <div class="card" style="text-align:center">
    <div style="font-size:36px;margin-bottom:8px">🚗</div>
    <div style="font-weight:700;font-size:15px;margin-bottom:2px">{{ $car->name }}</div>
    <div style="font-size:12px;color:var(--text2);margin-bottom:10px">{{ $car->plate }} · {{ $car->model }}</div>
    <span class="tag {{ $todayReserved?'tag-red':'tag-green' }}">{{ $todayReserved?'🔴 Reservado hoy':'🟢 Disponible' }}</span>
    @if($todayReserved)
      <div style="font-size:11px;color:var(--text2);margin-top:6px">Destino: {{ $todayReserved->destination }}</div>
    @endif
  </div>
  @endforeach
</div>

{{-- Reservations table --}}
<div class="card">
  <div class="card-title">📋 Reservas de vehículos</div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Vehículo</th><th>Fecha · Hora</th><th>Destino</th><th>Motivo</th><th>Empleado</th><th>Estado</th><th>Acciones</th></tr></thead>
      <tbody>
        @forelse($allRes as $r)
        <tr>
          <td><strong>{{ $r->car }}</strong></td>
          <td>{{ $r->date->format('d/m/Y') }} · {{ $r->hour }}</td>
          <td>📍 {{ $r->destination }}</td>
          <td>{{ $r->reason }}</td>
          <td>{{ $r->user->name }}</td>
          <td>@include('partials.status', ['status'=>$r->status])</td>
          <td style="display:flex;gap:6px;flex-wrap:wrap">
            @if(session('user_role')==='admin' && $r->status==='pendiente')
            <form action="{{ route('cars.approve', $r->id) }}" method="POST">
              @csrf <button type="submit" class="btn btn-sm btn-success">✅</button>
            </form>
            @endif
            @if(session('user_role')==='admin' || $r->user_id===session('user_id'))
            <form action="{{ route('cars.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
            </form>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:30px;color:var(--text2)">Sin reservas de vehículos</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
