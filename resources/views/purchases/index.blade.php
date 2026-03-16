@extends('layouts.app')
@section('title','Solicitudes de Compra')
@section('content')

<div class="page-header">
  <div><h2>Solicitudes de Compra</h2><p>Solicita equipamiento para tu puesto de trabajo</p></div>
  <a href="{{ route('purchases.create') }}" class="btn btn-primary">+ Nueva solicitud</a>
</div>

{{-- Catalog quick buttons --}}
<div class="card" style="margin-bottom:20px">
  <div class="card-title">🛒 Catálogo rápido</div>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    @foreach([['💻','Portátil'],['🖥️','Monitor'],['⌨️','Teclado'],['🖱️','Ratón'],['🖨️','Impresora'],['📱','Móvil'],['🎧','Auriculares'],['💺','Silla ergo.']] as [$icon,$name])
    <a href="{{ route('purchases.create') }}?item={{ urlencode("$icon $name") }}"
       style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;
              padding:14px 16px;text-align:center;min-width:100px;transition:all .15s;text-decoration:none"
       onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
      <div style="font-size:26px;margin-bottom:4px">{{ $icon }}</div>
      <div style="font-size:12px;font-weight:600;color:var(--text2)">{{ $name }}</div>
    </a>
    @endforeach
  </div>
</div>

{{-- My requests table --}}
<div class="card">
  <div class="card-title">📋 {{ session('user_role')==='admin'?'Todas las solicitudes':'Mis solicitudes' }}</div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Artículo</th>
          <th>Cant.</th>
          @if(session('user_role')==='admin')<th>Solicitante</th>@endif
          <th>Justificación</th>
          <th>Precio est.</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $req)
        <tr>
          <td><strong>{{ $req->item }}</strong></td>
          <td>{{ $req->quantity }}</td>
          @if(session('user_role')==='admin')<td>{{ $req->user->name }}</td>@endif
          <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $req->reason }}">{{ $req->reason }}</td>
          <td>{{ $req->estimated_price ? '€'.number_format($req->estimated_price,2) : '—' }}</td>
          <td>{{ $req->created_at->format('d/m/Y') }}</td>
          <td>@include('partials.status', ['status'=>$req->status])</td>
          <td style="display:flex;gap:6px;flex-wrap:wrap">
            @if($req->status==='pendiente')
              @if(session('user_role')==='admin')
                <form action="{{ route('purchases.approve', $req->id) }}" method="POST">
                  @csrf <button type="submit" class="btn btn-sm btn-success" title="Aprobar">✅</button>
                </form>
                <form action="{{ route('purchases.reject', $req->id) }}" method="POST">
                  @csrf <button type="submit" class="btn btn-sm btn-danger" title="Rechazar">❌</button>
                </form>
              @elseif($req->user_id===session('user_id'))
                <form action="{{ route('purchases.destroy', $req->id) }}" method="POST" onsubmit="return confirm('¿Eliminar solicitud?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                </form>
              @endif
            @endif
            @if($req->admin_notes)
              <span title="{{ $req->admin_notes }}" style="cursor:help;font-size:18px">💬</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:30px;color:var(--text2)">Sin solicitudes de compra</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
