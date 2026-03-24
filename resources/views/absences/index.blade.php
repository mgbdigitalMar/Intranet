@extends('layouts.app')
@section('title','Ausencias')

@push('css')
<style>
.absence-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:16px;
  overflow:hidden;
  transition:all .25s ease;
}
.absence-card:hover{
  border-color:var(--primary);
  transform:translateY(-4px);
  box-shadow:0 12px 32px rgba(0,0,0,.2);
}
.catalog-item{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:14px;
  padding:20px 14px;
  text-align:center;
  transition:all .25s ease;
  text-decoration:none;
  display:block;
}
.catalog-item:hover{
  background:var(--surface2);
  border-color:var(--primary);
  transform:translateY(-4px);
  box-shadow:0 8px 24px rgba(79,121,247,.2);
}
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🏖️ Ausencias</h2>
    <p class="section-subtitle">Notifica tus ausencias con antelación</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('absences.create') }}" class="btn btn-primary"><span>+</span> Notificar ausencia</a>
  </div>
</div>

{{-- My absences --}}
<div class="section-header">
  <h2 class="section-title"><span>🏖️</span> Mis ausencias</h2>
</div>

<div class="data-grid" style="margin-bottom:32px;">
    @forelse($mine as $ab)
    <div class="absence-card">
        <div style="padding:18px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;background:var(--surface2);">
            <h4 style="font-weight:700;font-size:15px;">{{ $ab->type }}</h4>
            @include('partials.status', ['status'=>$ab->status])
        </div>
        <div style="padding:20px;font-size:14px;color:var(--text2);">
            <p style="margin-bottom:10px;"><strong>📅 Inicio:</strong> {{ $ab->start_date->format('d/m/Y') }}</p>
            <p style="margin-bottom:10px;"><strong>📅 Fin:</strong> {{ $ab->end_date->format('d/m/Y') }} ({{ $ab->start_date->diffInDays($ab->end_date) + 1 }}d)</p>
            <p><strong>📝 Motivo:</strong> {{ $ab->reason ?: '—' }}</p>
        </div>
    </div>
    @empty
    <div class="empty" style="grid-column:1/-1;"><div class="e-icon">🏖️</div><p>No has notificado ninguna ausencia todavía</p></div>
    @endforelse
</div>

{{-- Admin: all absences --}}
@if(session('user_role')==='admin')
<div class="section-header" style="margin-top:36px;">
  <h2 class="section-title"><span>📋</span> Todas las ausencias (Admin)</h2>
</div>

<div class="data-grid">
    @forelse($all as $ab)
    <div class="absence-card">
        <div style="padding:18px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;background:var(--surface2);">
            <h4 style="font-weight:700;font-size:15px;">{{ $ab->user->name }}</h4>
            @include('partials.status', ['status'=>$ab->status])
        </div>
        <div style="padding:20px;font-size:14px;color:var(--text2);flex:1;">
            <p style="margin-bottom:10px;"><strong>📝 Tipo:</strong> {{ $ab->type }}</p>
            <p style="margin-bottom:10px;"><strong>📅 Fechas:</strong> {{ $ab->start_date->format('d/m/Y') }} → {{ $ab->end_date->format('d/m/Y') }}</p>
            <p style="margin-bottom:10px;"><strong>⏳ Duración:</strong> {{ $ab->start_date->diffInDays($ab->end_date) + 1 }} día(s)</p>
            <p><strong>📄 Motivo:</strong> {{ $ab->reason ?: '—' }}</p>
        </div>
        @if($ab->status==='pendiente' || session('user_role')==='admin')
        <div style="padding:14px 20px;background:var(--surface2);border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:10px;">
            @if($ab->status==='pendiente')
            <form action="{{ route('absences.approve', $ab->id) }}" method="POST">@csrf<button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button></form>
            <form action="{{ route('absences.reject', $ab->id) }}" method="POST">@csrf<button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button></form>
            @endif
            <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-ghost" title="Eliminar">🗑️</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="empty" style="grid-column:1/-1;"><div class="e-icon">✅</div><p>Sin ausencias registradas</p></div>
    @endforelse
</div>
@endif

@endsection
