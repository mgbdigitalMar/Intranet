@extends('layouts.app')
@section('title','Noticias & Eventos')
@section('content')

<div class="page-header">
  <div>
    <h2>Noticias & Eventos</h2>
    <p>Todo lo que ocurre en la empresa</p>
  </div>
  <div class="page-header-actions">
    @if(session('user_role')==='admin')
      <a href="{{ route('news.create') }}" class="btn btn-primary">+ Nueva publicación</a>
    @endif
  </div>
</div>

<div class="filter-tabs">
  <a href="{{ route('news.index') }}" class="filter-tab {{ !request('type') || request('type')==='all' ? 'active' : '' }}">Todos</a>
  <a href="{{ route('news.index', ['type'=>'noticia']) }}" class="filter-tab {{ request('type')==='noticia' ? 'active' : '' }}">📰 Noticias</a>
  <a href="{{ route('news.index', ['type'=>'evento']) }}" class="filter-tab {{ request('type')==='evento' ? 'active' : '' }}">🎉 Eventos</a>
</div>

@if($news->isEmpty())
  <div class="empty"><div class="e-icon">📭</div><p>No hay publicaciones todavía.</p></div>
@else
<div class="news-grid">
  @foreach($news as $item)
  <div class="news-card">
    <div class="news-card-header">
      <span class="tag {{ $item->typeColor() }}">{{ $item->typeBadge() }}</span>
      <div class="news-card-title">{{ $item->title }}</div>
      <div class="news-card-meta">
        📅 {{ $item->created_at->format('d/m/Y') }} · ✍️ {{ $item->author->name ?? 'Empresa' }}
        @if($item->event_date)
          · 🗓️ {{ $item->event_date->isoFormat('ddd D MMM · HH:mm') }}
        @endif
      </div>
    </div>
    <div class="news-card-body">{{ $item->body }}</div>
    @if(session('user_role')==='admin')
    <div class="news-card-footer">
      <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-ghost">✏️ Editar</a>
      <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta publicación?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
      </form>
    </div>
    @endif
  </div>
  @endforeach
</div>
<div style="margin-top:22px">{{ $news->links() }}</div>
@endif

@endsection
