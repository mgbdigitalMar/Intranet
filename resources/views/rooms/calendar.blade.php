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
    <p class="section-subtitle">Visualiza ocupación de salas por fecha (rojo=confirmado, naranja=pendiente)</p>
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
      if (info.event.extendedProps.status === 'confirmada') {
        info.el.classList.add('occupied');
      } else if (info.event.extendedProps.status === 'pendiente') {
        info.el.classList.add('requested');
      }
    },
    height: 'auto'
  });
  calendar.render();
});
</script>
@endpush
@endsection

