@extends('layouts.app')
@section('title','Dashboard')

@push('css')
<style>
/* Dashboard specific overrides */
.stats-grid{margin-bottom:24px;}
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<div class="hero-section animate-slideUp">
  <div class="hero-content">
    <h1 class="hero-title">Bienvenido de nuevo, {{ session('user_name') }} 👋</h1>
    <p class="hero-subtitle">Aquí tienes un resumen de lo que está pasando en la empresa hoy. Accede rápidamente a todas las herramientas que necesitas.</p>
    <div class="hero-actions">
      <a href="{{ route('rooms.index') }}" class="btn btn-primary">
        <span>📅</span> Reservar sala
      </a>
      <a href="{{ route('cars.index') }}" class="btn btn-ghost">
        <span>🚗</span> Solicitar vehículo
      </a>
    </div>
    <div style="margin-top:20px;display:flex;flex-wrap:wrap;gap:8px;">
      <div class="hero-stat"><strong>🚪 {{ $stats['rooms'] }}</strong> salas reservadas</div>
      <div class="hero-stat"><strong>🚗 {{ $stats['cars'] }}</strong> vehículos</div>
      <div class="hero-stat"><strong>🛒 {{ $stats['purchases'] }}</strong> solicitudes</div>
    </div>
  </div>
</div>

{{-- Alerts --}}
@if(count($alerts))
<div class="alerts stagger">
  @foreach($alerts as $al)
  <div class="alert alert-{{ $al['type'] }} animate-slideUp">
    <span class="al-icon">{{ $al['type']==='birthday'?'🎂':($al['type']==='event'?'📅':'🏖️') }}</span>
    <span>{!! $al['msg'] !!}</span>
    <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
  </div>
  @endforeach
</div>
@endif

{{-- Features Quick Access --}}
<div class="section-header">
  <h2 class="section-title">Acceso rápido</h2>
  <p class="section-subtitle">Las herramientas más utilizadas</p>
</div>

<div class="features-grid stagger">
  <a href="{{ route('rooms.index') }}" class="feature-card" style="text-decoration:none;display:block;">
    <div class="feature-icon blue">🚪</div>
    <h3 class="feature-title">Salas de reuniones</h3>
    <p class="feature-desc">Reserva salas equipadas para tus reuniones y eventos corporativos.</p>
  </a>
  <a href="{{ route('cars.index') }}" class="feature-card" style="text-decoration:none;display:block;">
    <div class="feature-icon amber">🚗</div>
    <h3 class="feature-title">Vehículos de empresa</h3>
    <p class="feature-desc">Solicita coches corporativos para desplazamientos profesionales.</p>
  </a>
  <a href="{{ route('purchases.index') }}" class="feature-card" style="text-decoration:none;display:block;">
    <div class="feature-icon green">🛒</div>
    <h3 class="feature-title">Solicitudes de compra</h3>
    <p class="feature-desc">Gestiona compras de material y equipamiento para el trabajo.</p>
  </a>
  <a href="{{ route('absences.index') }}" class="feature-card" style="text-decoration:none;display:block;">
    <div class="feature-icon purple">🏖️</div>
    <h3 class="feature-title">Gestión de ausencias</h3>
    <p class="feature-desc">Solicita vacaciones, permisos y gestiona tus días libres.</p>
  </a>
</div>

{{-- Stats Grid --}}
<div class="section-header" style="margin-top:12px;">
  <h2 class="section-title">Estadísticas del día</h2>
  <p class="section-subtitle">Resumen de actividad</p>
</div>

<div class="stats-grid stagger">
  <div class="stat-card blue">
    <div class="stat-icon">🚪</div>
    <div class="stat-val">{{ $stats['rooms'] }}</div>
    <div class="stat-label">Reservas de salas hoy</div>
  </div>
  <div class="stat-card amber">
    <div class="stat-icon">🚗</div>
    <div class="stat-val">{{ $stats['cars'] }}</div>
    <div class="stat-label">Vehículos reservados</div>
  </div>
  <div class="stat-card green">
    <div class="stat-icon">🛒</div>
    <div class="stat-val">{{ $stats['purchases'] }}</div>
    <div class="stat-label">Solicitudes pendientes</div>
  </div>
  <div class="stat-card purple">
    <div class="stat-icon">🏖️</div>
    <div class="stat-val">{{ $stats['absences'] }}</div>
    <div class="stat-label">Ausencias este mes</div>
  </div>
</div>

<div class="two-col" style="margin-bottom:18px">
  {{-- Upcoming events --}}
  <div class="card card-glow">
    <div class="card-title"><span>📅</span> Próximos eventos</div>
    @if($upcomingEvents->isEmpty())
      <div class="empty"><div class="e-icon">📭</div><p>No hay eventos próximos</p></div>
    @else
    <div class="timeline">
      @foreach($upcomingEvents as $ev)
      <div class="tl-item">
        <div class="tl-date">{{ $ev->event_date->isoFormat('ddd D MMM · HH:mm') }}</div>
        <div class="tl-content">{{ $ev->title }}</div>
        <div class="tl-sub">🎉 Evento corporativo</div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  {{-- Birthdays --}}
  <div class="card card-glow">
    <div class="card-title"><span>🎂</span> Próximos cumpleaños</div>
    @if($birthdays->isEmpty())
      <div class="empty"><div class="e-icon">🎉</div><p>Sin cumpleaños próximos</p></div>
    @else
      <div style="display:flex;flex-direction:column;gap:8px">
        @foreach($birthdays as $b)
        @php
          $u    = $b['user'];
          $days = $b['days'];
          $label = $days === 0 ? '🎉 ¡Hoy!' : ($days === 1 ? '🎂 Mañana' : "En {$days} días");
        @endphp
        <div style="display:flex;align-items:center;gap:12px;padding:12px;background:var(--surface2);border-radius:12px;border:1px solid var(--border);transition:all .2s;">
          <div class="avatar avatar-lg">{{ $u->initials() }}</div>
          <div style="flex:1">
            <div style="font-weight:700;font-size:14px;color:var(--text);">{{ $u->name }}</div>
            <div style="font-size:12px;color:var(--text2);">{{ $u->department }}</div>
          </div>
          <span class="tag tag-amber">{{ $label }}</span>
        </div>
        @endforeach
      </div>
    @endif
  </div>
</div>

{{-- Recent absences --}}
<div class="card card-glow">
  <div class="card-title"><span>🏖️</span> Ausencias recientes</div>
  @if($recentAbsences->isEmpty())
    <div class="empty"><div class="e-icon">✅</div><p>Sin ausencias registradas</p></div>
  @else
  <div style="display:flex;flex-direction:column;gap:12px">
    @foreach($recentAbsences as $ab)
    <div style="background:var(--surface2);border-radius:12px;padding:16px;border:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;transition:all .2s;">
      <div style="display:flex;align-items:center;gap:12px;">
        <div class="avatar">{{ $ab->user->initials() }}</div>
        <div>
          <div style="font-weight:700;font-size:14px;color:var(--text);margin-bottom:2px;">{{ $ab->user->name }}</div>
          <div style="font-size:12.5px;color:var(--text2);">
            {{ $ab->type }} · {{ $ab->start_date->format('d/m/Y') }} @if($ab->start_date != $ab->end_date) → {{ $ab->end_date->format('d/m/Y') }} @endif
          </div>
        </div>
      </div>
      @include('partials.status', ['status' => $ab->status])
    </div>
    @endforeach
  </div>
  @endif
</div>

{{-- Final CTA --}}
<div class="cta-section" style="margin-top:8px;">
  <div class="cta-content">
    <h3 class="cta-title">¿Necesitas algo más?</h3>
    <p class="cta-desc">Explora todas las herramientas disponibles en la intranet para gestionar tu día a día.</p>
    <a href="{{ route('employees.index') }}" class="cta-btn">
      <span>👥</span> Ver directorio de empleados
    </a>
  </div>
</div>

@endsection
