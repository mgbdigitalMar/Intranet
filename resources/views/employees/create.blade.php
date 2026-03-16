@extends('layouts.app')
@section('title','Añadir Empleado')
@section('content')

<div class="page-header">
  <div><h2>Añadir empleado</h2><p>Crea una nueva cuenta para un miembro del equipo</p></div>
  <a href="{{ route('employees.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:680px">
  <form action="{{ route('employees.store') }}" method="POST">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label>Nombre completo *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
          placeholder="Nombre Apellido" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Correo electrónico *</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
          placeholder="empleado@empresa.com" required>
        @error('email')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Departamento *</label>
        <select name="department" class="form-control" required>
          <option value="">-- Selecciona --</option>
          @foreach($departments as $dept)
            <option value="{{ $dept }}" {{ old('department')===$dept?'selected':'' }}>{{ $dept }}</option>
          @endforeach
        </select>
        @error('department')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Cargo *</label>
        <input type="text" name="position" class="form-control" value="{{ old('position') }}"
          placeholder="Ej: Desarrollador Senior" required>
        @error('position')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Teléfono <span style="color:var(--text3)">opcional</span></label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
          placeholder="600 000 000">
      </div>
      <div class="form-group">
        <label>Fecha de nacimiento <span style="color:var(--text3)">opcional</span></label>
        <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
        <div class="form-hint">Para alertas de cumpleaños automáticas</div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Rol en el sistema *</label>
        <select name="role" class="form-control" required>
          <option value="employee" {{ old('role')==='employee'?'selected':'selected' }}>👤 Empleado</option>
          <option value="admin"    {{ old('role')==='admin'?'selected':'' }}>⭐ Administrador</option>
        </select>
      </div>
      <div class="form-group">
        <label>Contraseña inicial</label>
        <input type="text" name="password" class="form-control" value="emp123" placeholder="emp123">
        <div class="form-hint">Si la dejas vacía, se usará <strong>emp123</strong></div>
      </div>
    </div>

    <div style="background:var(--green-dim);border:1px solid rgba(79,202,138,.2);border-radius:9px;
      padding:12px 14px;margin-bottom:16px;font-size:13px;color:var(--green)">
      ✅ El empleado podrá acceder inmediatamente con su correo y la contraseña asignada.
    </div>

    <div style="display:flex;gap:10px">
      <button type="submit" class="btn btn-primary">Crear empleado</button>
      <a href="{{ route('employees.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>
@endsection
