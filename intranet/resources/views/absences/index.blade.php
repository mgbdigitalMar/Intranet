@extends('layouts.app')
@section('title','Ausencias')
@section('content')

<div class="page-header">
  <div><h2>Ausencias</h2><p>Notifica tus ausencias con antelación</p></div>
  <a href="{{ route('absences.create') }}" class="btn btn-primary">+ Notificar ausencia</a>
</div>

{{-- My absences --}}
<div class="card" style="margin-bottom:20px">
  <div class="card-title">🏖️ Mis ausencias</div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Tipo</th><th>Fecha inicio</th><th>Fecha fin</th><th>Días</th><th>Motivo</th><th>Estado</th><th></th></tr></thead>
      <tbody>
        @forelse($mine as $ab)
        <tr>
          <td><strong>{{ $ab->type }}</strong></td>
          <td>{{ $ab->start_date->format('d/m/Y') }}</td>
          <td>{{ $ab->end_date->format('d/m/Y') }}</td>
          <td>{{ $ab->start_date->diffInDays($ab->end_date) + 1 }} día(s)</td>
          <td>{{ $ab->reason ?: '—' }}</td>
          <td>@include('partials.status', ['status'=>$ab->status])</td>
          <td>
            @if($ab->status==='pendiente')
            <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta notificación?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
            </form>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:30px;color:var(--text2)">No has notificado ninguna ausencia todavía</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Admin: all absences --}}
@if(session('user_role')==='admin')
<div class="card">
  <div class="card-title">📋 Todas las ausencias (Admin)</div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Empleado</th><th>Tipo</th><th>Inicio</th><th>Fin</th><th>Días</th><th>Motivo</th><th>Estado</th><th>Acciones</th></tr></thead>
      <tbody>
        @forelse($all as $ab)
        <tr>
          <td><strong>{{ $ab->user->name }}</strong></td>
          <td>{{ $ab->type }}</td>
          <td>{{ $ab->start_date->format('d/m/Y') }}</td>
          <td>{{ $ab->end_date->format('d/m/Y') }}</td>
          <td>{{ $ab->start_date->diffInDays($ab->end_date) + 1 }}</td>
          <td>{{ $ab->reason ?: '—' }}</td>
          <td>@include('partials.status', ['status'=>$ab->status])</td>
          <td style="display:flex;gap:6px;flex-wrap:wrap">
            @if($ab->status==='pendiente')
            <form action="{{ route('absences.approve', $ab->id) }}" method="POST">
              @csrf <button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>
            </form>
            <form action="{{ route('absences.reject', $ab->id) }}" method="POST">
              @csrf <button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button>
            </form>
            @endif
            <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-ghost btn-icon">🗑️</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:30px;color:var(--text2)">Sin ausencias registradas</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection
