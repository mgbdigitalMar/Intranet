@extends('layouts.app')
@section('title','Editar Empleado')

@push('css')
<style>
.form-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:20px;
  padding:32px;
  max-width:680px;
}
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">✏️ Editar empleado</h2>
    <p class="section-subtitle">Modifica los datos de {{ $employee->name }}</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('employees.index') }}" class="btn btn-ghost">← Volver</a>
  </div>
</div>

<div class="form-card">
  <form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label>Nombre completo *</label>
        <input type="text" name="name" class="form-control"
          value="{{ old('name', $employee->name) }}" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Correo electrónico *</label>
        <input type="email" name="email" class="form-control"
          value="{{ old('email', $employee->email) }}" required>
        @error('email')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Departamento *</label>
        <select name="department" class="form-control" required>
          @foreach($departments as $dept)
            <option value="{{ $dept }}" {{ old('department',$employee->department)===$dept?'selected':'' }}>{{ $dept }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Cargo *</label>
        <input type="text" name="position" class="form-control"
          value="{{ old('position', $employee->position) }}" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Teléfono</label>
        <input type="text" name="phone" class="form-control"
          value="{{ old('phone', $employee->phone) }}" placeholder="600 000 000">
      </div>
      <div class="form-group">
        <label>Fecha de nacimiento</label>
        <input type="date" name="birthday" class="form-control"
          value="{{ old('birthday', $employee->birthday?->format('Y-m-d')) }}">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Rol en el sistema *</label>
        <select name="role" class="form-control" required
          {{ $employee->id === session('user_id') ? 'disabled' : '' }}>
          <option value="employee" {{ old('role',$employee->role)==='employee'?'selected':'' }}>👤 Empleado</option>
          <option value="admin"    {{ old('role',$employee->role)==='admin'?'selected':'' }}>⭐ Administrador</option>
        </select>
        @if($employee->id === session('user_id'))
          <div class="form-hint">No puedes cambiar tu propio rol.</div>
          <input type="hidden" name="role" value="{{ $employee->role }}">
        @endif
      </div>
      <div class="form-group" style="position:relative;">
        <label>Contraseña actual / nueva <span style="color:var(--text3)">ver actual, introduce nueva para cambiar</span></label>
        <div style="display:flex; gap:8px; align-items:end;">
          <input type="password" name="password" id="edit-password" class="form-control" value="emp123" placeholder="emp123 (actual) / nueva..." style="flex:1;">
          <button type="button" class="toggle-password" onclick="togglePassword('edit-password')" style="border:none; background:none; cursor:pointer; padding:8px 12px; color:var(--text2); font-size:16px;">👁</button>
        </div>
        <div class="form-hint">Deja vacía para mantener actual. El valor por defecto es <strong>emp123</strong></div>
      </div>
    </div>

    <script>
function togglePassword(id) {
  const input = document.getElementById(id);
  const toggle = input.nextElementSibling;
  if (input.type === 'password') {
    input.type = 'text';
    toggle.textContent = '🙈';
  } else {
    input.type = 'password';
    toggle.textContent = '👁';
  }
}
    </script>
    
    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
      <a href="{{ route('employees.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>
@endsection
