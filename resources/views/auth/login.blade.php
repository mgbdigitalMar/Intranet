<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Intranet-Margube · Iniciar sesión</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css'])
<style>
html,body{overflow-x:hidden;max-width:100vw;}
:root{
  --bg:#0a0a0f;
  --surface:#12121a;
  --surface2:#181824;
  --border:#2a2a3d;
  --text:#f0f0f5;
  --text2:#a0a0b8;
  --text3:#606080;
  --primary:#6366f1;
  --primary-light:#818cf8;
  --primary-dim:rgba(99,102,241,.15);
  --red:#ef4444;
  --red-dim:rgba(239,68,68,.15);
  --green:#10b981;
  --green-dim:rgba(16,185,129,.15);
}
[data-theme="light"]{
  --bg:#f8fafc;
  --surface:#ffffff;
  --surface2:#f1f5f9;
  --border:#e2e8f0;
  --text:#0f172a;
  --text2:#475569;
  --text3:#94a3b8;
  --primary:#6366f1;
  --primary-light:#818cf8;
  --primary-dim:rgba(99,102,241,.12);
  --red:#ef4444;
  --red-dim:rgba(239,68,68,.12);
  --green:#10b981;
  --green-dim:rgba(16,185,129,.12);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);
  min-height:100vh;display:flex;align-items:center;justify-content:center;
  background-image: 
    radial-gradient(ellipse at 20% 30%,rgba(79,121,247,.18) 0%,transparent 50%),
    radial-gradient(ellipse at 80% 70%,rgba(139,92,246,.12) 0%,transparent 50%),
    radial-gradient(ellipse at 50% 100%,rgba(79,121,247,.08) 0%,transparent 40%);
  position:relative;overflow:hidden;}
body::before{content:'';position:fixed;inset:0;
  background-image:radial-gradient(circle,var(--border) 1px,transparent 1px);
  background-size:32px 32px;opacity:.15;pointer-events:none;}
body::after{content:'';position:fixed;top:-50%;left:-50%;width:200%;height:200%;
  background:radial-gradient(circle,rgba(79,121,247,.03) 0%,transparent 50%);
  animation:pulse 8s ease-in-out infinite;pointer-events:none;}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.1);opacity:0.5}}
h1,h2{font-family:'Syne',sans-serif;}

/* Card */
.card{background:var(--surface);border:1px solid var(--border);border-radius:24px;
  padding:48px 44px;width:440px;max-width:95vw;position:relative;z-index:1;
  box-shadow: 
    0 0 100px rgba(79,121,247,.08),
    0 25px 50px -12px rgba(0,0,0,.4),
    0 0 0 1px rgba(255,255,255,.03) inset;
  animation:slideUp .5s ease;}
@keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}

/* Logo */
.logo{display:flex;align-items:center;gap:14px;margin-bottom:36px;}
.logo-icon{width:52px;height:52px;background:linear-gradient(135deg,var(--primary) 0%,#818cf8 100%);border-radius:14px;
  display:flex;align-items:center;justify-content:center;font-size:24px;
  box-shadow:0 8px 20px rgba(79,121,247,.35),0 0 0 1px rgba(255,255,255,.1) inset;
  animation:float 3s ease-in-out infinite;}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-4px)}}
.logo h1{font-size:24px;font-weight:800;letter-spacing:-.5px;}
.logo span{color:var(--primary);}

/* Typography */
h2{font-size:28px;font-weight:800;margin-bottom:8px;letter-spacing:-.5px;
  background:linear-gradient(135deg,var(--text) 0%,var(--primary-light) 100%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.sub{color:var(--text2);font-size:15px;margin-bottom:32px;}

/* Forms */
.form-group{margin-bottom:20px;}
.form-group label{display:block;font-size:13px;font-weight:600;color:var(--text2);margin-bottom:8px;letter-spacing:.3px;}
.form-control{width:100%;padding:14px 16px;background:var(--surface2);border:1px solid var(--border);
  border-radius:12px;color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;
  transition:all .2s;outline:none;}
.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 4px var(--primary-dim),0 4px 12px rgba(79,121,247,.15);}
.form-control::placeholder{color:var(--text3,#64748b);}

/* Button */
.btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;
  padding:14px 20px;border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;
  font-size:15px;font-weight:700;cursor:pointer;border:none;
  background:linear-gradient(135deg,var(--primary) 0%,#6366f1 100%);color:#fff;
  margin-top:12px;transition:all .25s;position:relative;overflow:hidden;}
.btn::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,.2) 0%,transparent 50%);
  opacity:0;transition:opacity .25s;}
.btn:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(79,121,247,.4);}
.btn:hover::before{opacity:1;}
.btn:active{transform:translateY(0);}

/* Error */
.error-box{background:var(--red-dim);border:1px solid rgba(239,68,68,.2);color:var(--red);
  padding:12px 16px;border-radius:12px;font-size:13px;margin-bottom:20px;
  display:flex;align-items:center;gap:10px;}
.error-box::before{content:'⚠️';}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}
.shake{animation:shake .3s ease;}

/* Demo */
.demo-box{margin-top:24px;padding:16px 20px;background:linear-gradient(135deg,var(--primary-dim) 0%,rgba(139,92,246,.08) 100%);
  border:1px solid rgba(79,121,247,.15);border-radius:14px;font-size:13px;
  color:var(--text2);line-height:1.8;}
.demo-box strong{color:var(--primary);}

/* Theme toggle */
.theme-btn{position:absolute;top:24px;right:24px;background:var(--surface);border:1px solid var(--border);
  color:var(--text);border-radius:50%;width:44px;height:44px;cursor:pointer;font-size:18px;
  display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,.1);
  transition:all .2s;z-index:10;}
.theme-btn:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(0,0,0,.15);}

/* Mobile */
@media(max-width:480px){
  body{padding:16px;}
  .card{padding:32px 24px;border-radius:20px;}
  .logo{margin-bottom:28px;}
  .logo-icon{width:44px;height:44px;font-size:20px;}
  .logo h1{font-size:20px;}
  h2{font-size:22px;}
  .sub{font-size:13px;margin-bottom:24px;}
  .form-group{margin-bottom:16px;}
  .form-control{padding:12px 14px;font-size:14px;}
  .btn{padding:12px 18px;font-size:14px;}
  .demo-box{font-size:11px;padding:12px 14px;}
  .theme-btn{top:16px;right:16px;width:40px;height:40px;}
}
</style>
<script>
  const theme = localStorage.getItem('theme') || 'dark';
  document.documentElement.setAttribute('data-theme', theme);
</script>
</head>
<body>

<button id="themeToggle" style="position:absolute;top:24px;right:24px;background:var(--surface);border:1px solid var(--border);color:var(--text);border-radius:50%;width:42px;height:42px;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,.1);transition:all .2s;" title="Cambiar tema">☀️</button>

<div class="card">
  <div class="logo">
    <img src="{{ asset('logo.png') }}" alt="Intranet Logo" class="logo-icon">
    <h1>Intra<span>Net</span></h1>
  </div>
  <h2>Bienvenido de nuevo</h2>
  <p class="sub">Accede al portal corporativo</p>

  @if($errors->any())
    <div class="error-box shake">❌ {{ $errors->first() }}</div>
  @endif
  @if(session('success'))
    <div style="background:var(--green-dim);border:1px solid rgba(79,202,138,.2);color:var(--green);
      padding:10px 14px;border-radius:9px;font-size:13px;margin-bottom:16px;">
      ✅ {{ session('success') }}
    </div>
  @endif

  <form action="/login" method="POST">
    @csrf
    <div class="form-group">
      <label>Correo electrónico</label>
      <input type="email" name="email" class="form-control" placeholder="tu@empresa.com"
        value="{{ old('email') }}" required autofocus>
    </div>
    <div class="form-group" style="position:relative;">
      <label>Contraseña</label>
      <div style="display:flex; gap:8px; align-items:end;">
        <input type="password" name="password" id="login-password" class="form-control" placeholder="••••••••" required style="flex:1;">
        <button type="button" class="toggle-password" onclick="togglePassword('login-password')" style="border:none; background:none; cursor:pointer; padding:8px 12px; color:var(--text2); font-size:16px;">👁</button>
      </div>
    </div>
    <script>
function togglePassword(id) {
  const input = document.getElementById(id);
  const toggle = input.nextElementSibling;
  if (input.type === 'password') {
    input.type = 'text';
    toggle.textContent = '🙈';
  } else {
    input.type = 'password';
    toggle.textContent = '👁';
  }
}
    </script>
    <button type="submit" class="btn">Entrar al portal →</button>
  </form>
</div>

<script>
  const themeToggleBtn = document.getElementById('themeToggle');
  const updateIcon = () => {
    themeToggleBtn.innerHTML = document.documentElement.getAttribute('data-theme') === 'light' ? '🌙' : '☀️';
  };
  updateIcon();
  themeToggleBtn.addEventListener('click', () => {
    const newTheme = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateIcon();
  });
</script>
</body>
</html>
