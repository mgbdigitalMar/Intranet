@extends('layouts.app')
@section('title','Notificar Ausencia')

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
    <h2 class="section-title" style="margin-bottom:4px;">🏖️ Notificar ausencia</h2>
    <p class="section-subtitle">Informa con antelación de tu próxima ausencia</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('absences.index') }}" class="btn btn-ghost">← Volver</a>
  </div>
</div>

<div class="form-card">
    <form action="{{ route('absences.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="type">Tipo de ausencia *</label>
            <select name="type" id="type" class="form-control" required>
                @foreach($types as $type)
                <option value="{{ $type }}" {{ old('type')===$type?'selected':'' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Fecha de inicio *</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
                @error('start_date')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="end_date">Fecha de fin *</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', now()->format('Y-m-d')) }}" required>
                @error('end_date')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="reason">Motivo / observaciones <span style="font-weight:400;color:var(--text3)">(opcional)</span></label>
            <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="Añade cualquier detalle relevante para el administrador...">{{ old('reason') }}</textarea>
        </div>

        <div class="info-box">
            💡 La ausencia ficará <strong>Pendiente</strong> hasta ser aprobada por el administrador. Tus compañeros recibirán una alerta el día anterior.
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary">Enviar notificación</button>
            <a href="{{ route('absences.index') }}" class="btn btn-ghost">Cancelar</a>
        </div>
    </form>
</div>
@endsection
