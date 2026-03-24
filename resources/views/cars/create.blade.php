@extends('layouts.app')
@section('title','Reservar Vehículo')

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
  background:var(--primary-dim);
  border:1px solid rgba(79,121,247,.2);
  border-radius:12px;
  padding:14px 16px;
  font-size:13px;
  color:var(--primary);
  margin-bottom:20px;
}
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🚗 Reservar vehículo</h2>
    <p class="section-subtitle">Solicita un vehículo de empresa para tu desplazamiento</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('cars.index') }}" class="btn btn-ghost">← Volver</a>
  </div>
</div>

<div class="form-card">
    <form action="{{ route('cars.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="car">Vehículo *</label>
            <select name="car" id="car" class="form-control" required>
                <option value="">-- Selecciona un vehículo --</option>
                @foreach($cars as $car)
                <option value="{{ $car->fullName() }}" {{ old('car')===$car->fullName()?'selected':'' }}>
                    {{ $car->name }} · {{ $car->plate }} ({{ $car->model }})
                </option>
                @endforeach
            </select>
            @error('car')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="date">Fecha de salida *</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" min="{{ now()->format('Y-m-d') }}" required>
                @error('date')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="hour">Hora de salida *</label>
                <select name="hour" id="hour" class="form-control" required>
                    @foreach(['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'] as $h)
                    <option value="{{ $h }}" {{ old('hour')===$h?'selected':'' }}>{{ $h }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="destination">Destino *</label>
            <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination') }}" placeholder="Ciudad o dirección de destino" required>
            @error('destination')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="reason">Motivo del desplazamiento <span style="font-weight:400;color:var(--text3)">(opcional)</span></label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ old('reason') }}" placeholder="Ej: Visita a cliente, Reunión comercial...">
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary">Solicitar vehículo</button>
            <a href="{{ route('cars.index') }}" class="btn btn-ghost">Cancelar</a>
        </div>
    </form>
</div>
@endsection
