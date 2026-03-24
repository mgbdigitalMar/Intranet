@extends('layouts.app')
@section('title','Nueva Solicitud')

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
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🛒 Nueva solicitud de compra</h2>
    <p class="section-subtitle">Rellena el formulario para solicitar material o equipamiento</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('purchases.index') }}" class="btn btn-ghost">← Volver</a>
  </div>
</div>

<div class="form-card">
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="item-select">Artículo *</label>
            <select name="item" id="item-select" class="form-control" required>
                <option value="">-- Selecciona un artículo --</option>
                @foreach($catalog as $cat)
                <option value="{{ $cat }}" {{ (old('item', request('item'))===$cat)?'selected':'' }}>{{ $cat }}</option>
                @endforeach
            </select>
            @error('item')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group hidden" id="custom-item-group">
            <label for="custom_item">Especifica el artículo *</label>
            <input type="text" name="custom_item" id="custom_item" class="form-control" value="{{ old('custom_item') }}" placeholder="Describe el artículo que necesitas">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="quantity">Cantidad *</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity',1) }}" min="1" max="100" required>
                @error('quantity')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="estimated_price">Precio estimado (€) <span style="font-weight:400;color:var(--text3)">(opcional)</span></label>
                <input type="number" name="estimated_price" id="estimated_price" class="form-control" value="{{ old('estimated_price') }}" step="0.01" min="0" placeholder="0.00">
            </div>
        </div>

        <div class="form-group">
            <label for="reason">Justificación / Motivo *</label>
            <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="¿Por qué necesitas este artículo? ¿Cómo lo vas a utilizar?" required>{{ old('reason') }}</textarea>
            @error('reason')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary">Enviar solicitud</button>
            <a href="{{ route('purchases.index') }}" class="btn btn-ghost">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('item-select');
    const grp = document.getElementById('custom-item-group');
    const customInput = document.getElementById('custom_item');

    function toggleCustomItem(show) {
        if(show) {
            grp.classList.remove('hidden');
            grp.style.display = 'block';
        } else {
            grp.classList.add('hidden');
            grp.style.display = 'none';
        }
        customInput.required = show;
    }

    sel.addEventListener('change', () => {
        toggleCustomItem(sel.value === 'Otro');
    });

    // Initial check on page load
    toggleCustomItem(sel.value === 'Otro');
});
</script>
@endsection
