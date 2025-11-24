<?php
session_start();
require_once __DIR__.'/../database/db-config.php';
$pdo = db();
if (isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $identifier = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  if ($identifier !== '' && $password !== '') {
    $stmt = $pdo->prepare('SELECT id, username, email, password_hash FROM admins WHERE username = ? OR email = ? LIMIT 1');
    $stmt->execute([$identifier, $identifier]);
    $u = $stmt->fetch();
    if ($u && password_verify($password, $u['password_hash'])) {
      $_SESSION['admin_id'] = $u['id'];
      $_SESSION['admin_username'] = $u['username'];
      header('Location: index.php');
      exit;
    } else {
      $error = 'Invalid credentials';
    }
  } else {
    $error = 'Enter email/username and password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    :root{--bg:#f6f8fc;--text:#0f172a;--muted:#64748b;--border:#e5e7eb;--card:#ffffff;--primary:#2563eb;--green:#16a34a;--red:#ef4444}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;background:var(--bg);color:var(--text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .login-wrap{min-height:100vh;display:grid;grid-template-columns:1.2fr 1fr}
    .login-left{display:flex;align-items:center;justify-content:center;padding:24px}
    .lottie-box{width:min(800px,90%);height:min(520px,70vh);background:#fff;border:1px solid var(--border);border-radius:24px;box-shadow:0 10px 30px rgba(2,6,23,.08);display:flex;align-items:center;justify-content:center}
    .login-right{display:flex;align-items:center;justify-content:center;background:#ffffff}
    .form-card{width:100%;max-width:440px;background:var(--card);border:1px solid var(--border);border-radius:18px;box-shadow:0 10px 30px rgba(2,6,23,.08);padding:22px}
    .brand{display:flex;align-items:center;gap:8px;font-weight:900;font-size:20px;margin-bottom:10px}
    .sub{color:var(--muted);font-weight:600;margin-bottom:16px}
    .field{margin-bottom:12px}
    .label{display:block;font-size:13px;font-weight:800;color:var(--muted);margin-bottom:6px}
    .input-wrap{position:relative}
    .input{width:100%;padding:12px 14px;border-radius:12px;border:1px solid var(--border);background:#fff;color:var(--text);font-weight:600}
    .toggle-eye{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:38px;height:38px;border-radius:10px;border:1px solid var(--border);background:#fff;display:inline-flex;align-items:center;justify-content:center}
    .actions{display:flex;align-items:center;justify-content:space-between;margin-top:10px}
    .link{color:var(--primary);text-decoration:none;font-weight:800}
    .btn{width:100%;margin-top:14px;padding:12px;border-radius:12px;border:1px solid var(--border);background:rgba(37,99,235,.08);color:var(--primary);font-weight:800}
    .or{display:flex;align-items:center;gap:10px;color:var(--muted);font-weight:800;margin:16px 0}
    .or::before,.or::after{content:"";flex:1;height:1px;background:var(--border)}
    .social{display:flex;gap:10px}
    .sbtn{flex:1;display:flex;align-items:center;gap:8px;justify-content:center;padding:10px;border-radius:12px;border:1px solid var(--border);background:#fff;color:var(--text);font-weight:800}
    .sbtn.fb{color:#1877f2;background:rgba(24,119,242,.08)}
    .sbtn.gg{color:#ea4335;background:rgba(234,67,53,.08)}
    .sbtn.gh{color:#0f172a;background:#f3f4f6}
    .meta{margin-top:12px;color:var(--muted);font-size:12px;font-weight:700;text-align:center}
    .error{margin-bottom:10px;color:#ef4444;font-weight:800}
    @media(max-width:960px){.login-wrap{grid-template-columns:1fr}.login-left{display:none}}
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
  <meta name="theme-color" content="#2563eb">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='12' fill='%232563eb'/%3E%3Ctext x='50%' y='54%' text-anchor='middle' font-size='28' fill='%23ffffff' font-family='Arial' font-weight='700'%3EAD%3C/text%3E%3C/svg%3E">
</head>
<body>
  <div class="login-wrap">
    <div class="login-left">
      <div class="lottie-box">
        <div id="loginLottie" style="width:100%;height:100%"></div>
      </div>
    </div>
    <div class="login-right">
      <form class="form-card" action="" method="post">
        <div class="brand">Finance Admin</div>
        <div class="sub">Sign in to continue</div>
        <?php if(isset($error) && $error){ echo '<div class="error">'.htmlspecialchars($error,ENT_QUOTES).'</div>'; } ?>
        <div class="field">
          <label class="label" for="email">Email</label>
          <div class="input-wrap">
            <input class="input" id="email" name="email" type="text" placeholder="email or username" required>
          </div>
        </div>
        <div class="field">
          <label class="label" for="password">Password</label>
          <div class="input-wrap">
            <input class="input" id="password" name="password" type="password" placeholder="••••••••" required>
            <button class="toggle-eye" type="button" aria-label="Toggle password visibility" id="togglePwd">
              <svg id="eyeOpen" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" fill="currentColor"/></svg>
              <svg id="eyeClosed" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:none"><path d="M3 3l18 18" stroke="currentColor" stroke-width="2"/><path d="M1 12s4-7 11-7c2.6 0 4.9.8 6.8 2.1" stroke="currentColor" stroke-width="2"/><path d="M23 12s-4 7-11 7c-2.6 0-4.9-.8-6.8-2.1" stroke="currentColor" stroke-width="2"/></svg>
            </button>
          </div>
        </div>
        <div class="actions">
          <label style="display:flex;align-items:center;gap:8px"><input type="checkbox" name="remember"> <span style="font-weight:700;color:var(--muted)">Remember me</span></label>
          <a class="link" href="#">Forgot password?</a>
        </div>
        <button class="btn" type="submit">Sign in</button>
        <div class="or">Or continue with</div>
        <div class="social">
          <button class="sbtn fb" type="button" aria-label="Continue with Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.15 8.44 9.94v-7.03H8.08V12.06h2.36V9.86c0-2.33 1.39-3.62 3.52-3.62.1 0 .21 0 .31.01h2.07v2.32h-1.44c-1.13 0-1.36.54-1.36 1.35v2.14h2.68l-.43 2.91h-2.25v7.03C18.34 21.2 22 17.05 22 12.06z"/></svg>
            Facebook
          </button>
          <button class="sbtn gg" type="button" aria-label="Continue with Google">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 4.8c1.89 0 3.61.7 4.96 1.86l2.98-2.98C17.67 1.65 14.98.6 12 .6 7.69.6 3.91 3.04 2.14 6.76l3.64 2.84C6.69 6.82 9.12 4.8 12 4.8z" fill="#4285F4"/><path d="M23.64 12.27c0-.95-.08-1.64-.23-2.36H12v4.47h6.56c-.13 1.03-.84 2.58-2.41 3.62l3.7 2.86c2.16-1.99 3.39-4.93 3.39-8.59z" fill="#4285F4"/><path d="M5.78 14.22a7.2 7.2 0 0 1 0-4.44L2.14 6.94A11.39 11.39 0 0 0 .6 12c0 1.77.42 3.44 1.18 4.94l3.99-2.72z" fill="#FBBC05"/><path d="M12 23.4c3.24 0 5.93-1.07 7.91-2.92l-3.7-2.86c-1.04.7-2.39 1.18-4.21 1.18-3.22 0-5.96-2.17-6.93-5.12l-4 2.72C3.91 20.96 7.69 23.4 12 23.4z" fill="#34A853"/><path d="M12 4.8c1.89 0 3.61.7 4.96 1.86l2.98-2.98C17.67 1.65 14.98.6 12 .6 7.69.6 3.91 3.04 2.14 6.76l3.64 2.84C6.69 6.82 9.12 4.8 12 4.8z" fill="#EA4335"/></svg>
            Google
          </button>
          <button class="sbtn gh" type="button" aria-label="Continue with GitHub">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 .8C6.13.8 1.6 5.33 1.6 11.2c0 4.6 2.98 8.49 7.1 9.86.52.1.71-.23.71-.5 0-.25-.01-.92-.01-1.8-2.9.63-3.52-1.4-3.52-1.4-.48-1.2-1.18-1.52-1.18-1.52-.97-.66.07-.64.07-.64 1.08.08 1.64 1.11 1.64 1.11 .95 1.63 2.49 1.16 3.09.88 .1-.69.37-1.16.67-1.43-2.31-.26-4.74-1.15-4.74-5.12 0-1.13.4-2.05 1.06-2.77 -.11-.26-.46-1.3.1-2.7 0 0 .87-.28 2.86 1.06 .83-.23 1.73-.35 2.62-.35 .89 0 1.79.12 2.62.35 1.98-1.34 2.86-1.06 2.86-1.06 .56 1.4.21 2.44.1 2.7 .66.72 1.06 1.64 1.06 2.77 0 3.98-2.44 4.86-4.77 5.11 .38.32.72.95.72 1.92 0 1.38-.01 2.49-.01 2.84 0 .27.19.61.72.5 4.11-1.37 7.09-5.26 7.09-9.86C22.4 5.33 17.87.8 12 .8z"/></svg>
            GitHub
          </button>
        </div>
        <div class="meta">By continuing, you agree to our Terms & Privacy Policy</div>
      </form>
    </div>
  </div>
  <script>
    (function(){
      var container=document.getElementById('loginLottie');
      if(container && window.lottie){
        window.lottie.loadAnimation({
          container: container,
          renderer: 'svg',
          loop: true,
          autoplay: true,
          path: '../assets/img/lottie/admin-login.json'
        });
      }
      var pwd=document.getElementById('password');
      var btn=document.getElementById('togglePwd');
      var open=document.getElementById('eyeOpen');
      var closed=document.getElementById('eyeClosed');
      if(btn && pwd){
        btn.addEventListener('click',function(){
          var isPw=pwd.getAttribute('type')==='password';
          pwd.setAttribute('type', isPw?'text':'password');
          open.style.display=isPw?'none':'block';
          closed.style.display=isPw?'block':'none';
        });
      }
    })();
  </script>
</body>
</html>