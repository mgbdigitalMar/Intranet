@extends('layouts.app')
@section('title','Empleados')

@push('css')
<style>
/* ── EMPLOYEE CARDS ── */
.emp-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;}

.emp-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:20px;
  text-align:center;
  transition:all .2s;
}

.emp-card:hover{
  border-color:var(--primary);
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(79,121,247,.1);
}

.emp-card .avatar{margin:0 auto 12px;}
.emp-name{font-weight:700;font-size:15px;margin-bottom:2px;}
.emp-role{font-size:12px;color:var(--text2);margin-bottom:10px;}
.emp-bday{display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--amber);background:var(--amber-dim);padding:4px 11px;border-radius:20px;margin-bottom:6px;}
.emp-email{font-size:11.5px;color:var(--text3);margin-top:4px;}
</style>
@endpush

@section('content')

<div class="page-header">
  <div><h2>Directorio de Empleados</h2><p>Todos los miembros del equipo</p></div>
  <div class="page-header-actions">
    <form action="{{ route('employees.index') }}" method="GET" style="display:flex;gap:8px;flex-wrap:wrap;width:100%">
      <div class="search-bar">
        <span>🔍</span>
        <input type="text" name="search" placeholder="Buscar por nombre, cargo..." value="{{ request('search') }}">
      </div>
      <select name="department" class="form-control" style="width:auto;min-width:150px">
        <option value="">Todos los departamentos</option>
        @foreach($departments as $dept)
          <option value="{{ $dept }}" {{ request('department')===$dept?'selected':'' }}>{{ $dept }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-ghost">Filtrar</button>
      @if(request('search') || request('department'))
        <a href="{{ route('employees.index') }}" class="btn btn-ghost">✕</a>
      @endif
    </form>
    @if(session('user_role')==='admin')
      <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Añadir empleado</a>
    @endif
  </div>
</div>

@if($employees->isEmpty())
  <div class="empty"><div class="e-icon">🔍</div><p>No se encontraron empleados con ese criterio.</p></div>
@else
<div class="emp-grid">
  @foreach($employees as $emp)
  @php $days = $emp->daysUntilBirthday(); @endphp
  <div class="emp-card">
    <div class="avatar avatar-lg" style="margin:0 auto 12px">{{ $emp->initials() }}</div>
    <div class="emp-name">{{ $emp->name }}</div>
    <div class="emp-role">{{ $emp->position }} · <span style="color:var(--primary)">{{ $emp->department }}</span></div>

    @if($emp->birthday)
    @php
      $bdayLabel = $days === 0 ? '🎉 ¡Hoy!' : ($days === 1 ? '🎂 Mañana' : $emp->birthday->format('d M'));
    @endphp
    <div class="emp-bday">🎂 {{ $bdayLabel }}</div>
    @endif

    <div class="emp-email">{{ $emp->email }}</div>
    @if($emp->phone)<div class="emp-email">📞 {{ $emp->phone }}</div>@endif

    @if($emp->isAdmin())
      <div style="margin-top:8px"><span class="badge-admin">⭐ Admin</span></div>
    @endif

    @if(session('user_role')==='admin')
    <div style="display:flex;gap:8px;margin-top:14px;justify-content:center;flex-wrap:wrap">
      <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-sm btn-ghost">✏️</a>
      @if($emp->id !== session('user_id'))
      <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a {{ $emp->name }}?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
      </form>
      @endif
    </div>
    @endif
  </div>
  @endforeach
</div>
@endif

@endsection
