@extends('layouts.app')
@section('title','Reservar Sala')

@push('css')
<style>
.form-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:20px;
  padding:32px;
  max-width:600px;
  margin:0 auto;
}
.info-box{
  background:var(--amber-dim);
  border:1px solid rgba(247,168,79,.2);
  border-radius:12px;
  padding:14px 16px;
  font-size:13px;
  color:var(--amber);
  margin-bottom:20px;
}
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🚪 Reservar sala</h2>
    <p class="section-subtitle">Solicita una sala de reuniones para tu equipo</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('rooms.index') }}" class="btn btn-ghost">← Volver</a>
  </div>
</div>

<div class="form-card">
    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="room">Sala *</label>
            <select name="room" id="room" class="form-control" required>
                <option value="">-- Selecciona una sala --</option>
                @foreach($rooms as $room)
                <option value="{{ $room->name }}" {{ old('room')===$room->name?'selected':'' }}>
                    {{ $room->name }} ({{ $room->capacity }} personas) — {{ $room->description }}
                </option>
                @endforeach
            </select>
            @error('room')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="date">Fecha *</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                @error('date')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="hour">Hora de inicio *</label>
                <select name="hour" id="hour" class="form-control" required>
                    @foreach(['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00'] as $h)
                    <option value="{{ $h }}" {{ old('hour')===$h?'selected':'' }}>{{ $h }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="duration">Duración</label>
            <select name="duration" id="duration" class="form-control">
                @foreach([1=>'1 hora',2=>'2 horas',3=>'3 horas',4=>'4 horas (media jornada)',8=>'8 horas (jornada completa)'] as $val=>$label)
                <option value="{{ $val }}" {{ old('duration')==$val?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="reason">Motivo de la reunión *</label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ old('reason') }}" placeholder="Ej: Reunión de equipo, Sprint review, Entrevista..." required>
            @error('reason')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="info-box">
            ⚡ La reserva quedará en estado <strong>Pendiente</strong> hasta que el administrador la confirme.
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary">Solicitar reserva</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-ghost">Cancelar</a>
        </div>
    </form>
</div>
@endsection
