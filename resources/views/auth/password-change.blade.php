@extends('layouts.app')
@section('title','Cambiar contraseña')

@push('css')
<style>
.form-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:20px;
  padding:32px;
  max-width:480px;
}
</style>
@endpush

@section('content')
<div class="page-header">
  <h2 class="section-title">🔐 Cambiar contraseña</h2>
  <p class="section-subtitle">Tu cuenta ha sido creada. Cambia la contraseña temporal.</p>
</div>

<div class="form-card">
  <form action="{{ route('password.change.update') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Bienvenido {{ session('user_name') }}!</label>
      <div style="color:var(--text2);margin-bottom:20px;">
        Contraseña temporal usada: <strong>emp123</strong>. Cámbiala ahora.
      </div>
    </div>
    <div class="form-group">
      <label>Nueva contraseña *</label>
      <input type="password" name="new_password" class="form-control" required minlength="6">
      @error('new_password')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label>Confirmar nueva contraseña *</label>
      <input type="password" name="new_password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cambiar y entrar al portal</button>
  </form>
</div>
@endsection

