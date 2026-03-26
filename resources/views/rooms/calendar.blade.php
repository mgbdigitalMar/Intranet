@extends('layouts.app')
@section('title', 'Calendario - Salas')

@push('css')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css' rel='stylesheet' />
<style>
  #calendar { max-width: 1200px; margin: 20px auto; background: var(--surface); border-radius: 12px; padding: 20px; border: 1px solid var(--border); }
  .fc-event.occupied { background-color: var(--red) !important; border-color: var(--red) !important; color: white !important; }
  .fc-event.requested { background-color: orange !important; border-color: orange !important; color: white !important; }
  .fc-daygrid-day { height: 120px; }
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <h2 class="section-title">📅 Calendario de Salas</h2>
<p class="section-subtitle">Calendario con estado diario: Verde (libre), Rojo (todo ocupado). Círculos indican número disponible.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('rooms.index') }}" class="btn btn-ghost">← Lista</a>
  </div>
</div>

<div id='calendar'></div>

@push('js')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek'
    },
    events: @json($events),
    eventDidMount: function(info) {
      const free = info.event.extendedProps.free || 0;
      if (free === 0) {
        info.el.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:bold;color:white;">●●●</div>';
      } else {
        const dots = '●'.repeat(free);
        info.el.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:bold;color:white;">' + dots + '</div>';
      }
    },
    height: 'auto'
  });
  calendar.render();
});
</script>
@endpush
@endsection

