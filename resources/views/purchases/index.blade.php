@extends('layouts.app')
@section('title','Solicitudes de Compra')

@push('css')
<style>
.purchase-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:16px;
  overflow:hidden;
  transition:all .25s ease;
}
.purchase-card:hover{
  border-color:var(--primary);
  transform:translateY(-4px);
  box-shadow:0 12px 32px rgba(0,0,0,.2);
}
.purchase-card::before{
  content:'';
  position:absolute;
  top:0;
  left:0;
  right:0;
  height:3px;
  background:linear-gradient(90deg,var(--primary),var(--primary-light));
  transform:scaleX(0);
  transform-origin:left;
  transition:transform .3s ease;
}
.purchase-card:hover::before{
  transform:scaleX(1);
}
.catalog-item{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:14px;
  padding:20px 14px;
  text-align:center;
  transition:all .25s ease;
  text-decoration:none;
  display:block;
}
.catalog-item:hover{
  background:var(--surface2);
  border-color:var(--primary);
  transform:translateY(-4px);
  box-shadow:0 8px 24px rgba(79,121,247,.2);
}
.catalog-icon{
  font-size:32px;
  margin-bottom:10px;
  display:block;
}
.catalog-name{
  font-size:12px;
  font-weight:600;
  color:var(--text);
}
.justification-box{
  background:var(--surface2);
  border-radius:12px;
  padding:14px;
  margin-bottom:14px;
}
.admin-notes{
  background:linear-gradient(135deg,var(--amber-dim) 0%,rgba(247,168,79,.05) 100%);
  border:1px solid rgba(247,168,79,.2);
  border-radius:12px;
  padding:14px;
}
</style>
@endpush

@section('content')

<div class="page-header">
  <div>
    <h2 class="section-title" style="margin-bottom:4px;">🛒 Solicitudes de Compra</h2>
    <p class="section-subtitle">Solicita equipamiento para tu puesto de trabajo</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('purchases.create') }}" class="btn btn-primary"><span>+</span> Nueva solicitud</a>
  </div>
</div>

{{-- Catalog quick buttons --}}
<div class="card card-glow" style="margin-bottom:28px;">
  <div class="card-title"><span>🛒</span> Catálogo rápido</div>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:14px;">
      @foreach([['💻','Portátil'],['🖥️','Monitor'],['⌨️','Teclado'],['🖱️','Ratón'],['🖨️','Impresora'],['📱','Móvil'],['🎧','Auriculares'],['💺','Silla']] as [$icon,$name])
      <a href="{{ route('purchases.create') }}?item={{ urlencode("$icon $name") }}" class="catalog-item">
         <span class="catalog-icon">{{ $icon }}</span>
         <span class="catalog-name">{{ $name }}</span>
      </a>
      @endforeach
  </div>
</div>

{{-- All requests --}}
<div class="section-header">
  <h2 class="section-title"><span>📋</span> {{ session('user_role')==='admin'?'Todas las solicitudes':'Mis solicitudes' }}</h2>
</div>

<div class="data-grid">
    @forelse($items as $req)
    <div class="purchase-card" style="position:relative;">
        <div style="padding:18px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;background:var(--surface2);">
            <h4 style="font-weight:700;font-size:15px;">{{ $req->item }} <span style="color:var(--text2);font-weight:600;">(x{{ $req->quantity }})</span></h4>
            @include('partials.status', ['status'=>$req->status])
        </div>
        <div style="padding:20px;flex:1;">
            @if(session('user_role')==='admin')
            <p style="font-size:13px;color:var(--text2);margin-bottom:10px;"><strong>👤 Solicitante:</strong> {{ $req->user->name }}</p>
            @endif
            <p style="font-size:13px;color:var(--text2);margin-bottom:10px;"><strong>📅 Fecha:</strong> {{ $req->created_at->format('d/m/Y') }}</p>
            <p style="font-size:13px;color:var(--text2);margin-bottom:14px;"><strong>💰 Precio est.:</strong> {{ $req->estimated_price ? '€'.number_format($req->estimated_price,2) : '—' }}</p>
            
            <div class="justification-box">
                <div style="font-size:10px;color:var(--text3);font-weight:700;text-transform:uppercase;margin-bottom:8px;">Justificación</div>
                <p style="font-size:14px;color:var(--text);line-height:1.6;">{{ $req->reason }}</p>
            </div>

            @if($req->admin_notes)
            <div class="admin-notes">
                <div style="font-size:10px;color:var(--amber);font-weight:700;text-transform:uppercase;margin-bottom:6px;">Notas del Admin</div>
                <p style="font-size:13px;">{{ $req->admin_notes }}</p>
            </div>
            @endif
        </div>
        @if($req->status==='pendiente' && session('user_role') === 'admin')
        <div style="padding:14px 20px;background:var(--surface2);border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:10px;">
            <form action="{{ route('purchases.approve', $req->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>
            </form>
            <form action="{{ route('purchases.reject', $req->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button>
            </form>
            <form action="{{ route('purchases.destroy', $req->id) }}" method="POST" onsubmit="return confirm('¿Eliminar solicitud?')">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-ghost" title="Eliminar">🗑️</button>
            </form>
        </div>
        @endif
    </div>
    @empty
    <div class="empty" style="grid-column:1/-1;"><div class="e-icon">🛒</div><p>Sin solicitudes de compra</p></div>
    @endforelse
</div>
@endsection
