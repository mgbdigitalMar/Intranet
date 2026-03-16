@extends('layouts.app')
@section('title','Editar Empleado')
@section('content')

<div class="page-header">
  <div><h2>Editar empleado</h2><p>Modifica los datos de {{ $employee->name }}</p></div>
  <a href="{{ route('employees.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:680px">
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
      <div class="form-group">
        <label>Nueva contraseña <span style="color:var(--text3)">dejar vacío para no cambiar</span></label>
        <input type="text" name="password" class="form-control" placeholder="Nueva contraseña...">
      </div>
    </div>

    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
      <a href="{{ route('employees.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>
@endsection
