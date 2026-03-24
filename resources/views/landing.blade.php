@extends('layouts.app')

@section('title', 'Intranet SaaS - Plataforma Moderna de Gestión Empresarial')

@section('content')
{{-- HERO SECTION --}}
<section class="relative overflow-hidden py-20 lg:py-32">
  {{-- Background Effects --}}
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-[var(--primary)] opacity-[0.08] rounded-full blur-[120px] animate-pulse" style="animation-duration: 4s;"></div>
    <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-[var(--cyan)] opacity-[0.06] rounded-full blur-[100px] animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[var(--purple)] opacity-[0.05] rounded-full blur-[150px] animate-pulse" style="animation-duration: 6s; animation-delay: 2s;"></div>
    {{-- Grid Pattern Overlay --}}
    <div class="absolute inset-0 bg-[linear-gradient(rgba(79,121,247,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(79,121,247,0.03)_1px,transparent_1px)] bg-[size:60px_60px]"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
      {{-- Left Content --}}
      <div class="text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[var(--primary-dim)] border border-[var(--primary)]/20 mb-8 animate-fade-in">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--primary)] opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-[var(--primary)]"></span>
          </span>
          <span class="text-sm font-semibold text-[var(--primary)]">Plataforma #1 en gestión interna</span>
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.1] mb-7 animate-slide-up" style="font-family: 'Syne', sans-serif;">
          Transforma tu empresa con <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--primary)] to-[var(--cyan)]">Intranet SaaS</span>
        </h1>
        
        <p class="text-lg sm:text-xl text-[var(--text2)] mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed animate-slide-up" style="animation-delay: 0.1s;">
          Plataforma integral de gestión interna: reservas de salas, vehículos corporativos, gestión de empleados y solicitudes de compra. 
          Eficiente, segura y 100% responsive.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-slide-up" style="animation-delay: 0.2s;">
          <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl bg-[var(--primary)] text-white transition-all duration-300 hover:bg-[var(--primary-light)] shadow-lg shadow-[var(--primary)]/25 hover:shadow-[var(--primary)]/50 hover:-translate-y-1">
            <span class="relative flex items-center gap-2">
              Comenzar Gratis
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </span>
          </a>
          <a href="mailto:contacto@intramargube.com" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl border-2 border-[var(--border)] text-[var(--text)] hover:border-[var(--primary)] hover:text-[var(--primary)] hover:bg-[var(--primary-dim)] transition-all duration-300 bg-[var(--surface)]">
            Solicitar Demo
          </a>
        </div>

        {{-- Trust Badges --}}
        <div class="mt-10 pt-8 border-t border-[var(--border)] animate-slide-up" style="animation-delay: 0.3s;">
          <p class="text-sm text-[var(--text3)] mb-4">Empresas que confían en nosotros</p>
          <div class="flex items-center justify-center lg:justify-start gap-6 opacity-60">
            <div class="flex items-center gap-2 text-[var(--text2)]">
              <svg class="w-5 h-5 text-[var(--green)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              <span class="text-sm font-medium">99.9% Uptime</span>
            </div>
            <div class="flex items-center gap-2 text-[var(--text2)]">
              <svg class="w-5 h-5 text-[var(--green)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              <span class="text-sm font-medium">SOC2 Certified</span>
            </div>
            <div class="flex items-center gap-2 text-[var(--text2)]">
              <svg class="w-5 h-5 text-[var(--green)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              <span class="text-sm font-medium">GDPR Ready</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Right Content - Stats & Mockup --}}
      <div class="relative">
        {{-- Stats Bar --}}
        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl p-6 mb-6 shadow-xl shadow-[var(--primary)]/5 animate-slide-up" style="animation-delay: 0.15s;">
          <div class="grid grid-cols-3 gap-4">
            <div class="text-center">
              <div class="text-3xl font-bold text-[var(--primary)] mb-1">99.9%</div>
              <div class="text-sm text-[var(--text2)]">Uptime</div>
            </div>
            <div class="text-center border-x border-[var(--border)]">
              <div class="text-3xl font-bold text-[var(--amber)] mb-1">500+</div>
              <div class="text-sm text-[var(--text2)]">Empresas</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-[var(--green)] mb-1">10K</div>
              <div class="text-sm text-[var(--text2)]">Reservas</div>
            </div>
          </div>
        </div>

        {{-- Hero Mockup Card --}}
        <div class="relative bg-gradient-to-br from-[var(--primary)] via-[var(--primary-light)] to-[var(--cyan)] rounded-2xl p-10 text-center shadow-2xl shadow-[var(--primary)]/30 animate-slide-up overflow-hidden" style="animation-delay: 0.25s;">
          <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMtOS45NDEgMC0xOCA4LjA1OS0xOCAxOHM4LjA1OSAxOCAxOCAxOCAxOC04LjA1OSAxOC0xOC04LjA1OS0xOC0xOC0xOHptMCAzMmMtNy43MzIgMC0xNC02LjI2OC0xNC0xNHM2LjI2OC0xNCAxNC0xNCAxNCA2LjI2OCAxNCAxNC02LjI2OCAxNC0xNCAxNHoiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iLjEiLz48L2c+PC9zdmc+')] opacity-30"></div>
          {{-- Glow effect --}}
          <div class="absolute -top-20 -right-20 w-40 h-40 bg-white/20 rounded-full blur-3xl"></div>
          <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
          <div class="relative">
            <div class="w-20 h-20 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <div class="text-2xl font-bold text-white mb-2">Gestión Inteligente</div>
            <div class="text-white/80">Para empresas modernas</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- FEATURES SECTION --}}
<section id="features" class="py-20 lg:py-28 bg-[var(--surface)]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[var(--primary-dim)] text-2xl mb-4">⚡</span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4" style="font-family: 'Syne', sans-serif;">
        Características <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--primary)] to-[var(--cyan)]">Premium</span>
      </h2>
      <p class="text-lg text-[var(--text2)] max-w-2xl mx-auto">
        Todo lo que necesitas para gestionar tu empresa de manera eficiente
      </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      {{-- Feature 1: Room Reservations --}}
      <div class="group relative bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--primary)]/10 hover:border-[var(--primary)]/30">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--primary-dim)] to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
        <div class="relative">
          <div class="w-14 h-14 rounded-xl bg-[var(--primary-dim)] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7 text-[var(--primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <div class="text-4xl font-bold text-[var(--text)] mb-2">+250</div>
          <h3 class="text-lg font-semibold mb-3">Reservas de Salas</h3>
          <p class="text-sm text-[var(--text2)] leading-relaxed">
            Gestión completa de espacios compartidos con calendarios inteligentes y notificaciones automáticas.
          </p>
        </div>
      </div>

      {{-- Feature 2: Corporate Vehicles --}}
      <div class="group relative bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--cyan)]/10 hover:border-[var(--cyan)]/30" style="animation-delay: 0.1s;">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--cyan-dim)] to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
        <div class="relative">
          <div class="w-14 h-14 rounded-xl bg-[var(--cyan-dim)] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7 text-[var(--cyan)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h8m-8 4h8m-4 4v4m-4-4h8a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2zm4 12h2m-2 0h2m-2 0h2"/>
            </svg>
          </div>
          <div class="text-4xl font-bold text-[var(--text)] mb-2">52</div>
          <h3 class="text-lg font-semibold mb-3">Vehículos Corporativos</h3>
          <p class="text-sm text-[var(--text2)] leading-relaxed">
            Control total de flota: reservas, kilometraje, mantenimiento y aprobaciones instantáneas.
          </p>
        </div>
      </div>

      {{-- Feature 3: Employee Management --}}
      <div class="group relative bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--green)]/10 hover:border-[var(--green)]/30" style="animation-delay: 0.2s;">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--green-dim)] to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
        <div class="relative">
          <div class="w-14 h-14 rounded-xl bg-[var(--green-dim)] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7 text-[var(--green)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
          </div>
          <div class="text-4xl font-bold text-[var(--text)] mb-2">152</div>
          <h3 class="text-lg font-semibold mb-3">Gestión Empleados</h3>
          <p class="text-sm text-[var(--text2)] leading-relaxed">
            Directorios completos, permisos granulares, onboarding automatizado y directorio inteligente.
          </p>
        </div>
      </div>

      {{-- Feature 4: Purchase Requests --}}
      <div class="group relative bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--amber)]/10 hover:border-[var(--amber)]/30" style="animation-delay: 0.3s;">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--amber-dim)] to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
        <div class="relative">
          <div class="w-14 h-14 rounded-xl bg-[var(--amber-dim)] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7 text-[var(--amber)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
          </div>
          <div class="text-4xl font-bold text-[var(--text)] mb-2">94%</div>
          <h3 class="text-lg font-semibold mb-3">Solicitudes de Compra</h3>
          <p class="text-sm text-[var(--text2)] leading-relaxed">
            Workflow de aprobaciones ultrarrápido con límites presupuestarios y tracking en tiempo real.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ABOUT SECTION --}}
<section class="py-20 lg:py-28">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
      <div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="font-family: 'Syne', sans-serif;">
          Plataforma Empresarial <span class="text-[var(--primary)]">Premium</span>
        </h2>
        <p class="text-lg text-[var(--text2)] mb-8 leading-relaxed">
          Somos especialistas en software de gestión interna que potencia la productividad de empresas modernas. 
          Nuestra SaaS ha transformado operaciones en más de 500 organizaciones con uptime 99.9% y escalabilidad infinita.
        </p>
        <div class="flex flex-wrap gap-3">
          <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--primary-dim)] text-[var(--primary)] font-medium text-sm">
            🔒 Secure
          </span>
          <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--green-dim)] text-[var(--green)] font-medium text-sm">
            ☁️ Scalable
          </span>
          <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--purple-dim)] text-[var(--purple)] font-medium text-sm">
            📱 Responsive
          </span>
          <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--cyan-dim)] text-[var(--cyan)] font-medium text-sm">
            🚀 Cloud-based
          </span>
        </div>
      </div>
      <div class="flex justify-center">
        <div class="relative">
          <div class="w-40 h-40 sm:w-48 sm:h-48 rounded-3xl bg-gradient-to-br from-[var(--primary)] to-[var(--cyan)] flex items-center justify-center text-5xl sm:text-6xl font-bold text-white shadow-2xl shadow-[var(--primary)]/30 transform hover:scale-105 transition-transform duration-300">
            IN
          </div>
          <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-2xl bg-[var(--surface)] border border-[var(--border)] flex items-center justify-center shadow-xl">
            <span class="text-3xl">✨</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- TESTIMONIALS --}}
<section id="testimonials" class="py-20 lg:py-28 bg-[var(--surface)]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <span class="inline-block text-5xl mb-4">💬</span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4" style="font-family: 'Syne', sans-serif;">
        Lo que dicen nuestros <span class="text-[var(--amber)]">clientes</span>
      </h2>
      <p class="text-lg text-[var(--text2)] max-w-2xl mx-auto">
        Descubre por qué cientos de empresas confían en nosotros
      </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      {{-- Testimonial 1 --}}
      <div class="bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-[var(--primary)]/20">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--primary)] to-[var(--primary-light)] flex items-center justify-center text-white font-semibold">
            JD
          </div>
          <div>
            <div class="font-semibold">Juan Díaz</div>
            <div class="text-sm text-[var(--text2)]">Gerente de Operaciones</div>
          </div>
        </div>
        <p class="text-[var(--text2)] text-sm leading-relaxed mb-4 italic">
          "La revolución en gestión de reservas. Todo fluye perfecto y nuestros equipos ahorran horas diarias."
        </p>
        <div class="flex gap-1 text-[var(--amber)]">⭐⭐⭐⭐⭐</div>
      </div>

      {{-- Testimonial 2 --}}
      <div class="bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-[var(--purple)]/20">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--purple)] to-[var(--cyan)] flex items-center justify-center text-white font-semibold">
            MP
          </div>
          <div>
            <div class="font-semibold">María Pérez</div>
            <div class="text-sm text-[var(--text2)]">RH Manager</div>
          </div>
        </div>
        <p class="text-[var(--text2)] text-sm leading-relaxed mb-4 italic">
          "Interfaz súper intuitiva en móvil y desktop. Nuestros empleados la adoptaron en días."
        </p>
        <div class="flex gap-1 text-[var(--amber)]">⭐⭐⭐⭐⭐</div>
      </div>

      {{-- Testimonial 3 --}}
      <div class="bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-[var(--amber)]/20">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--amber)] to-[var(--green)] flex items-center justify-center text-white font-semibold">
            LC
          </div>
          <div>
            <div class="font-semibold">Luis Castro</div>
            <div class="text-sm text-[var(--text2)]">Finanzas</div>
          </div>
        </div>
        <p class="text-[var(--text2)] text-sm leading-relaxed mb-4 italic">
          "Aprobaciones de compra en minutos. Control presupuestario perfecto sin complicaciones."
        </p>
        <div class="flex gap-1 text-[var(--amber)]">⭐⭐⭐⭐⭐</div>
      </div>

      {{-- Testimonial 4 --}}
      <div class="bg-[var(--surface2)] border border-[var(--border)] rounded-2xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-[var(--green)]/20">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--green)] to-[var(--purple)] flex items-center justify-center text-white font-semibold">
            AS
          </div>
          <div>
            <div class="font-semibold">Ana Soto</div>
            <div class="text-sm text-[var(--text2)]">IT Admin</div>
          </div>
        </div>
        <p class="text-[var(--text2)] text-sm leading-relaxed mb-4 italic">
          "Zero mantenimiento. Siempre estable, rápida y escalable con nuestro crecimiento."
        </p>
        <div class="flex gap-1 text-[var(--amber)]">⭐⭐⭐⭐⭐</div>
      </div>
    </div>
  </div>
</section>

{{-- FINAL CTA --}}
<section class="py-20 lg:py-28 relative overflow-hidden">
  {{-- Background Effects --}}
  <div class="absolute inset-0 pointer-events-none">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[var(--primary)] opacity-[0.1] rounded-full blur-[100px]"></div>
  </div>

  <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 sm:p-12 shadow-2xl">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="font-family: 'Syne', sans-serif;">
        ¿Listo para transformar tu empresa?
      </h2>
      <p class="text-lg sm:text-xl text-[var(--text2)] mb-8 max-w-2xl mx-auto">
        Únete a cientos de empresas que ya optimizan su gestión interna con nuestra plataforma SaaS.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl bg-[var(--primary)] text-white hover:bg-[var(--primary-light)] transition-all duration-300 shadow-lg shadow-[var(--primary)]/25 hover:shadow-[var(--primary)]/40 hover:-translate-y-0.5">
          Empezar Ahora
          <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
        <a href="mailto:contacto@intramargube.com" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl border-2 border-[var(--border2)] text-[var(--text)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-all duration-300 hover:bg-[var(--primary-dim)]">
          Solicitar Demo
        </a>
      </div>
      <p class="text-sm text-[var(--text3)] mt-6">Sin compromiso. Configuración en 5 minutos.</p>
    </div>
  </div>
</section>

<style>
/* Landing Page Animations */
@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fade-in 0.6s ease-out forwards;
}

.animate-slide-up {
  opacity: 0;
  animation: slide-up 0.8s ease-out forwards;
}

/* Staggered animations for features */
.grid > div:nth-child(1) { animation-delay: 0s; }
.grid > div:nth-child(2) { animation-delay: 0.1s; }
.grid > div:nth-child(3) { animation-delay: 0.2s; }
.grid > div:nth-child(4) { animation-delay: 0.3s; }

/* Smooth scrolling */
html { scroll-behavior: smooth; }

/* Button hover glow effect */
a[href*="mailto"], a[href*="register"] {
  position: relative;
  overflow: hidden;
}

a[href*="mailto"]::before, a[href*="register"]::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
  transition: left 0.5s;
}

a[href*="mailto"]:hover::before, a[href*="register"]:hover::before {
  left: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid {
    gap: 1rem;
  }
  
  h1, h2 {
    font-size: clamp(1.75rem, 5vw, 2.5rem);
  }
}
</style>
@endsection
