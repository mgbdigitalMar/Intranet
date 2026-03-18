<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>{{ config('app.name','IntraNet') }} · @yield('title','Portal')</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
html,body{overflow-x:hidden;max-width:100vw;}
:root{
  --bg:#0d1117;--surface:#161b27;--surface2:#1e2638;--surface3:#242d42;
  --border:#2a3450;--border2:#3a4870;
  --text:#e8ecf5;--text2:#8b97b8;--text3:#5a6885;
  --primary:#4f79f7;--primary-light:#6b8ff9;--primary-dim:rgba(79,121,247,.12);
  --amber:#f7a84f;--amber-dim:rgba(247,168,79,.12);
  --green:#4fca8a;--green-dim:rgba(79,202,138,.12);
  --red:#f74f6e;--red-dim:rgba(247,79,110,.12);
  --purple:#9b6ff7;--purple-dim:rgba(155,111,247,.12);
  --cyan:#4fc8f7;--cyan-dim:rgba(79,200,247,.12);
  --sidebar-w:248px;--radius:12px;--shadow:0 4px 24px rgba(0,0,0,.4);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;}
h1,h2,h3,h4,h5{font-family:'Syne',sans-serif;}
a{text-decoration:none;color:inherit;}

/* ── SIDEBAR ── */
.sidebar{width:var(--sidebar-w);background:var(--surface);border-right:1px solid var(--border);
  display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:100;overflow-y:auto;}
.sidebar-logo{display:flex;align-items:center;gap:10px;padding:20px 18px;border-bottom:1px solid var(--border);}
.logo-icon{width:38px;height:38px;background:var(--primary);border-radius:10px;
  display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;}
.sidebar-logo h2{font-size:18px;font-weight:800;letter-spacing:-.3px;}
.sidebar-logo span{color:var(--primary);}
.sidebar-user{padding:14px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;}
.avatar{width:36px;height:36px;border-radius:50%;background:var(--primary-dim);
  display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;
  color:var(--primary);flex-shrink:0;border:2px solid var(--border2);text-transform:uppercase;}
.avatar-lg{width:52px;height:52px;font-size:18px;}
.user-info .uname{font-size:13px;font-weight:600;}
.user-info .urole{font-size:11px;color:var(--text2);}
.badge-admin{background:var(--amber-dim);color:var(--amber);font-size:9px;font-weight:700;
  padding:2px 6px;border-radius:4px;letter-spacing:.5px;text-transform:uppercase;}
.sidebar-nav{flex:1;padding:10px;}
.nav-section{font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;
  color:var(--text3);padding:10px 8px 5px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:9px;
  cursor:pointer;transition:all .15s;margin-bottom:2px;font-size:13.5px;font-weight:500;
  color:var(--text2);}
.nav-item:hover{background:var(--surface2);color:var(--text);}
.nav-item.active{background:var(--primary-dim);color:var(--primary);font-weight:600;}
.nav-item .ni{font-size:16px;width:20px;text-align:center;}
.sidebar-bottom{padding:12px 10px;border-top:1px solid var(--border);}
.logout-btn{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:9px;
  cursor:pointer;color:var(--text2);font-size:13.5px;font-weight:500;transition:all .15s;}
.logout-btn:hover{background:var(--red-dim);color:var(--red);}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
.topbar{background:var(--surface);border-bottom:1px solid var(--border);padding:14px 28px;
  display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-left h1{font-size:18px;font-weight:700;}
.topbar-left p{font-size:12px;color:var(--text2);}
.topbar-right{display:flex;align-items:center;gap:10px;}
.date-chip{font-size:12px;color:var(--text2);background:var(--surface2);border:1px solid var(--border);
  border-radius:8px;padding:5px 12px;font-weight:500;}
.page-body{padding:28px;flex:1;}

/* ── ALERTS ── */
.alerts{display:flex;flex-direction:column;gap:8px;margin-bottom:22px;}
.alert{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:11px;font-size:13.5px;font-weight:500;animation:slideIn .3s ease;}
@keyframes slideIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
.alert-birthday{background:var(--amber-dim);border:1px solid rgba(247,168,79,.25);color:var(--amber);}
.alert-event{background:var(--primary-dim);border:1px solid rgba(79,121,247,.25);color:var(--primary-light);}
.alert-absence{background:var(--red-dim);border:1px solid rgba(247,79,110,.25);color:var(--red);}
.alert-success{background:var(--green-dim);border:1px solid rgba(79,202,138,.25);color:var(--green);}
.alert-error{background:var(--red-dim);border:1px solid rgba(247,79,110,.25);color:var(--red);}
.alert .al-icon{font-size:18px;}
.alert-close{margin-left:auto;cursor:pointer;opacity:.6;background:none;border:none;color:inherit;font-size:16px;padding:0 4px;}
.alert-close:hover{opacity:1;}

/* ── CARDS ── */
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:22px;}
.card-title{font-size:15px;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
.card-sm{padding:16px;}

/* ── STATS ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  padding:20px;position:relative;overflow:hidden;}
.stat-card::after{content:'';position:absolute;top:0;right:0;width:70px;height:70px;
  border-radius:0 12px 0 70px;opacity:.08;}
.stat-card.blue::after{background:var(--primary);}
.stat-card.amber::after{background:var(--amber);}
.stat-card.green::after{background:var(--green);}
.stat-card.purple::after{background:var(--purple);}
.stat-icon{font-size:22px;margin-bottom:10px;}
.stat-val{font-size:30px;font-weight:800;font-family:'Syne',sans-serif;}
.stat-label{font-size:12px;color:var(--text2);margin-top:2px;}

/* ── GRID LAYOUTS ── */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.three-col{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.four-col{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}

/* ── TABLE ── */
.table-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;font-size:13.5px;}
th{text-align:left;padding:10px 14px;font-size:11px;font-weight:700;letter-spacing:.5px;
  text-transform:uppercase;color:var(--text3);border-bottom:1px solid var(--border);}
td{padding:12px 14px;border-bottom:1px solid var(--border);color:var(--text2);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:var(--surface2);}
td strong{color:var(--text);}

/* ── TAGS ── */
.tag{display:inline-flex;align-items:center;gap:3px;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;}
.tag-blue{background:var(--primary-dim);color:var(--primary);}
.tag-amber{background:var(--amber-dim);color:var(--amber);}
.tag-green{background:var(--green-dim);color:var(--green);}
.tag-red{background:var(--red-dim);color:var(--red);}
.tag-purple{background:var(--purple-dim);color:var(--purple);}
.tag-cyan{background:var(--cyan-dim);color:var(--cyan);}
.tag-grey{background:var(--surface2);color:var(--text2);}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:10px 18px;
  border-radius:10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:600;
  cursor:pointer;border:none;transition:all .2s;text-decoration:none;}
.btn-primary{background:var(--primary);color:#fff;}
.btn-primary:hover{background:var(--primary-light);transform:translateY(-1px);box-shadow:0 8px 20px rgba(79,121,247,.35);}
.btn-ghost{background:var(--surface2);color:var(--text);border:1px solid var(--border);}
.btn-ghost:hover{background:var(--surface3);}
.btn-danger{background:var(--red-dim);color:var(--red);border:1px solid rgba(247,79,110,.2);}
.btn-danger:hover{background:var(--red);color:#fff;}
.btn-success{background:var(--green-dim);color:var(--green);border:1px solid rgba(79,202,138,.2);}
.btn-success:hover{background:var(--green);color:#fff;}
.btn-amber{background:var(--amber-dim);color:var(--amber);border:1px solid rgba(247,168,79,.2);}
.btn-amber:hover{background:var(--amber);color:#fff;}
.btn-sm{padding:6px 13px;font-size:12.5px;border-radius:8px;gap:5px;}
.btn-full{width:100%;}
.btn-icon{width:34px;height:34px;padding:0;border-radius:9px;}

/* ── FORMS ── */
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:12.5px;font-weight:600;color:var(--text2);margin-bottom:7px;letter-spacing:.3px;}
.form-control{width:100%;padding:10px 13px;background:var(--surface2);border:1px solid var(--border);
  border-radius:10px;color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;transition:border-color .2s;outline:none;}
.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px var(--primary-dim);}
.form-control::placeholder{color:var(--text3);}
.form-control option{background:var(--surface2);}
textarea.form-control{resize:vertical;min-height:90px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.form-error{font-size:12px;color:var(--red);margin-top:4px;}
.form-hint{font-size:12px;color:var(--text3);margin-top:4px;}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;}
.page-header h2{font-size:22px;font-weight:800;}
.page-header p{font-size:13px;color:var(--text2);margin-top:2px;}
.page-header-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap;}

/* ── EMPLOYEE CARD ── */
.emp-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;}
.emp-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  padding:20px;text-align:center;transition:all .2s;}
.emp-card:hover{border-color:var(--primary);transform:translateY(-2px);box-shadow:0 8px 24px rgba(79,121,247,.1);}
.emp-card .avatar{margin:0 auto 12px;}
.emp-name{font-weight:700;font-size:15px;margin-bottom:2px;}
.emp-role{font-size:12px;color:var(--text2);margin-bottom:10px;}
.emp-bday{display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--amber);
  background:var(--amber-dim);padding:4px 11px;border-radius:20px;margin-bottom:6px;}
.emp-email{font-size:11.5px;color:var(--text3);margin-top:4px;}

/* ── NEWS CARD ── */
.news-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;}
.news-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  overflow:hidden;transition:all .2s;}
.news-card:hover{border-color:var(--primary);transform:translateY(-2px);}
.news-card-header{padding:18px 20px 14px;border-bottom:1px solid var(--border);}
.news-card-title{font-size:16px;font-weight:700;margin:8px 0 6px;line-height:1.3;}
.news-card-meta{font-size:12px;color:var(--text2);}
.news-card-body{padding:14px 20px;font-size:13.5px;color:var(--text2);line-height:1.65;}
.news-card-footer{padding:0 20px 16px;display:flex;gap:8px;}

/* ── TIMELINE ── */
.timeline{position:relative;padding-left:22px;}
.timeline::before{content:'';position:absolute;left:7px;top:0;bottom:0;width:2px;background:var(--border);}
.tl-item{position:relative;padding-bottom:18px;}
.tl-item::before{content:'';position:absolute;left:-18px;top:4px;width:10px;height:10px;
  border-radius:50%;background:var(--primary);border:2px solid var(--surface);}
.tl-item.amber::before{background:var(--amber);}
.tl-item.green::before{background:var(--green);}
.tl-date{font-size:11px;color:var(--text3);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px;}
.tl-content{font-size:13.5px;font-weight:500;color:var(--text);}
.tl-sub{font-size:12px;color:var(--text2);}

/* ── EMPTY STATE ── */
.empty{text-align:center;padding:40px 20px;color:var(--text2);}
.empty .e-icon{font-size:36px;margin-bottom:10px;}
.empty p{font-size:13.5px;}

/* ── SEARCH BAR ── */
.search-bar{display:flex;align-items:center;gap:8px;background:var(--surface);
  border:1px solid var(--border);border-radius:10px;padding:8px 13px;min-width:240px;}
.search-bar input{background:none;border:none;outline:none;color:var(--text);
  font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;flex:1;}
.search-bar input::placeholder{color:var(--text3);}

/* ── ADMIN BANNER ── */
.admin-banner{background:var(--amber-dim);border:1px solid rgba(247,168,79,.2);border-radius:11px;
  padding:12px 16px;margin-bottom:20px;display:flex;align-items:center;gap:10px;
  font-size:13.5px;color:var(--amber);font-weight:500;}

/* ── FILTER TABS ── */
.filter-tabs{display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;}
.filter-tab{padding:7px 16px;border-radius:20px;font-size:13px;font-weight:600;cursor:pointer;
  border:1px solid var(--border);background:var(--surface);color:var(--text2);transition:all .15s;text-decoration:none;}
.filter-tab:hover,.filter-tab.active{background:var(--primary-dim);color:var(--primary);border-color:rgba(79,121,247,.3);}

/* ── PROGRESS ── */
.progress{height:6px;background:var(--surface2);border-radius:20px;overflow:hidden;margin-top:6px;}
.progress-fill{height:100%;border-radius:20px;}

/* ── SCROLLBAR ── */
::-webkit-scrollbar{width:5px;height:5px;}
::-webkit-scrollbar-track{background:var(--bg);}
::-webkit-scrollbar-thumb{background:var(--border2);border-radius:3px;}

/* ── RESPONSIVE (Salas, Vehículos, Compras, Ausencias, Admin) ── */
@media(max-width:768px){
  .sidebar{transform:translateX(-100%);transition: transform .3s ease;}
  .sidebar.open{transform:translateX(0);}
  .main{margin-left:0;}
  .stats-grid{grid-template-columns:1fr;}
  .four-col{grid-template-columns:1fr;}
  .three-col{grid-template-columns:1fr;}
  .two-col{grid-template-columns:1fr;}
  .form-row{grid-template-columns:1fr;}
  .topbar{padding:12px 16px;}
  .page-body{padding:16px;}
  .card{padding:18px;}
  .table-wrap{margin:-12px; border-radius:12px; overflow:hidden;}
  .table-wrap table{font-size:11px;min-width:700px;}
  th,td{padding:12px 8px;vertical-align:middle;}
  .emp-grid{grid-template-columns:repeat(auto-fit,minmax(140px,1fr));}
  .news-grid{grid-template-columns:1fr;}
  h1,h2{font-size:1.1rem;}
  .btn{padding:10px 14px;}
}

@media(max-width:480px){
  .topbar h1{font-size:16px;}
  .card{padding:14px;}
  .card-title{font-size:14px;}
  .table-wrap table{font-size:10px;}
  th,td{padding:6px 4px;}
  .btn{padding:8px 12px;font-size:13px;}
}

/* Tablet */
@media(min-width:769px) and (max-width:1024px){
  .stats-grid,.four-col{grid-template-columns:1fr 1fr;}
  .three-col{grid-template-columns:1fr 1fr;}
  .sidebar{width:260px;}
}

@media(min-width:1025px){
  .stats-grid{grid-template-columns:repeat(4,1fr);}
}
</style>
</head>
<body>

{{-- SIDEBAR OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">🏢</div>
    <h2>Intra<span>Net</span></h2>
  </div>

  <div class="sidebar-user">
    <div class="avatar">{{ strtoupper(substr(session('user_name','?'),0,2)) }}</div>
    <div class="user-info">
      <div class="uname">{{ session('user_name') }}</div>
      <div class="urole">
        @if(session('user_role')==='admin')
          <span class="badge-admin">⭐ Admin</span>
        @else
          Empleado
        @endif
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Principal</div>
    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <span class="ni">📊</span> Dashboard
    </a>
    <a href="{{ route('news.index') }}" class="nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
      <span class="ni">📰</span> Noticias & Eventos
    </a>

    <div class="nav-section">Reservas</div>
    <a href="{{ route('rooms.index') }}" class="nav-item {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
      <span class="ni">🚪</span> Salas
    </a>
    <a href="{{ route('cars.index') }}" class="nav-item {{ request()->routeIs('cars.*') ? 'active' : '' }}">
      <span class="ni">🚗</span> Vehículos
    </a>

    <div class="nav-section">Gestión</div>
    <a href="{{ route('purchases.index') }}" class="nav-item {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
      <span class="ni">🛒</span> Solicitudes compra
    </a>
    <a href="{{ route('absences.index') }}" class="nav-item {{ request()->routeIs('absences.*') ? 'active' : '' }}">
      <span class="ni">🏖️</span> Ausencias
    </a>
    <a href="{{ route('employees.index') }}" class="nav-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
      <span class="ni">👥</span> Empleados
    </a>

    @if(session('user_role')==='admin')
    <div class="nav-section">Administración</div>
    <a href="{{ route('admin.index') }}" class="nav-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
      <span class="ni">⚙️</span> Panel Admin
    </a>
    @endif
  </nav>

  <div class="sidebar-bottom">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="logout-btn" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">
        <span class="ni">🚪</span> Cerrar sesión
      </button>
    </form>
  </div>
</aside>

{{-- MAIN --}}
<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h1>@yield('title','Dashboard')</h1>
      <p>{{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
    </div>
    <div class="topbar-right">
      <span class="date-chip">{{ now()->format('d/m/Y') }}</span>
      <div class="avatar sidebar-toggle" id="sidebarToggle" style="cursor:pointer" title="{{ session('user_name') }} - Click para menú">{{ strtoupper(substr(session('user_name','?'),0,2)) }}</div>
    </div>
  </div>

  <div class="page-body">
    {{-- Flash messages --}}
    @if(session('success'))
      <div class="alerts">
        <div class="alert alert-success">
          <span class="al-icon">✅</span>
          <span>{{ session('success') }}</span>
          <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
        </div>
      </div>
    @endif
    @if(session('error'))
      <div class="alerts">
        <div class="alert alert-error">
          <span class="al-icon">❌</span>
          <span>{{ session('error') }}</span>
          <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
        </div>
      </div>
    @endif

    @yield('content')
  </div>
</div>

<script>
// Auto-dismiss flash alerts after 5s
setTimeout(() => {
  document.querySelectorAll('.alert-success, .alert-error').forEach(el => {
    el.style.transition = 'opacity .4s';
    el.style.opacity = '0';
    setTimeout(() => el.remove(), 400);
  });
}, 5000);

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  
  function toggleSidebar() {
    sidebar.classList.toggle('open');
    if(sidebar.classList.contains('open')) {
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    } else {
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
  }
  
  if (toggle && sidebar) {
    toggle.addEventListener('click', toggleSidebar);
  }
  
  if (overlay) {
    overlay.addEventListener('click', toggleSidebar);
  }
});
</script>
</body>
</html>
