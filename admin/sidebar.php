<aside class="admin-sidebar">
  <div class="as-brand">
    <button class="as-collapse" type="button" aria-label="Collapse sidebar"></button>
    <a href="/" class="as-logo">Finance Admin</a>
  </div>
  <nav class="as-nav" aria-label="Admin navigation">
    <ul>
      <li><a class="as-link active" href="/admin/dashboard.php"><span class="as-ico">🏦</span><span class="as-lbl">Dashboard</span></a></li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">🧾</span><span class="as-lbl">Applicants</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">New Applications</a></li>
          <li><a class="as-sublink" href="#">KYC Verification</a></li>
          <li><a class="as-sublink" href="#">Pre-approval</a></li>
          <li><a class="as-sublink" href="/admin/applications/h-loan-applications.php">Home Loan Applications</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">💳</span><span class="as-lbl">Loans</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">All Loans</a></li>
          <li><a class="as-sublink" href="#">Underwriting</a></li>
          <li><a class="as-sublink" href="#">Disbursements</a></li>
          <li><a class="as-sublink" href="#">Restructures</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">💰</span><span class="as-lbl">Payments</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">Schedules</a></li>
          <li><a class="as-sublink" href="#">Received</a></li>
          <li><a class="as-sublink" href="#">Reversals</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">📉</span><span class="as-lbl">Collections</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">Delinquencies</a></li>
          <li><a class="as-sublink" href="#">Follow-ups</a></li>
          <li><a class="as-sublink" href="#">Write-offs</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">🧠</span><span class="as-lbl">Risk & Underwriting</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">Credit Scoring</a></li>
          <li><a class="as-sublink" href="#">Fraud</a></li>
          <li><a class="as-sublink" href="#">Exposure</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">📊</span><span class="as-lbl">Reports</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">Performance</a></li>
          <li><a class="as-sublink" href="#">Portfolio</a></li>
          <li><a class="as-sublink" href="#">Compliance</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">📒</span><span class="as-lbl">Accounting</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">Chart of Accounts</a></li>
          <li><a class="as-sublink" href="#">Journal Entries</a></li>
          <li><a class="as-sublink" href="#">Reconciliation</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">👥</span><span class="as-lbl">Users</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">All Users</a></li>
          <li><a class="as-sublink" href="#">Roles & Permissions</a></li>
          <li><a class="as-sublink" href="#">Teams</a></li>
        </ul>
      </li>
      <li class="has-sub">
        <button class="as-link as-toggle" type="button" aria-expanded="false"><span class="as-ico">⚙️</span><span class="as-lbl">Settings</span><span class="as-caret"></span></button>
        <ul class="as-sub">
          <li><a class="as-sublink" href="#">General</a></li>
          <li><a class="as-sublink" href="#">Integrations</a></li>
          <li><a class="as-sublink" href="#">SMTP Settings</a></li>
          <li><a class="as-sublink" href="/admin/seo/sitemap-generator.php">SEO & Sitemap</a></li>
        </ul>
      </li>
      <li><a class="as-link" href="#"><span class="as-ico">📝</span><span class="as-lbl">Audit Logs</span></a></li>
      <li><a class="as-link" href="#"><span class="as-ico">🔌</span><span class="as-lbl">Integrations</span></a></li>
    </ul>
  </nav>
  <div class="as-footer">
    <a class="as-link" href="#"><span class="as-ico">🛟</span><span class="as-lbl">Support</span></a>
    <div class="as-version">v1.0</div>
  </div>
</aside>
<style>
:root{--as-bg:#0f172a;--as-text:#e5e7eb;--as-muted:#94a3b8;--as-hover:#1e293b;--as-accent:#22c55e;--as-border:rgba(255,255,255,.08)}
.admin-sidebar{position:fixed;top:0;left:0;height:100vh;width:264px;background:linear-gradient(180deg,#0b1221,#0f172a);color:var(--as-text);border-right:1px solid var(--as-border);display:flex;flex-direction:column;box-shadow:0 10px 30px rgba(2,6,23,.3);z-index:1000}
.admin-sidebar.collapsed{width:84px}
.as-brand{display:flex;align-items:center;gap:10px;padding:14px 12px;border-bottom:1px solid var(--as-border)}
.as-collapse{width:36px;height:36px;border-radius:10px;border:1px solid var(--as-border);background:#0b1221}
.as-logo{color:#fff;text-decoration:none;font-weight:700;letter-spacing:.3px}
.as-nav{flex:1 1 auto;overflow-y:auto;overflow-x:hidden;padding:10px 8px}
.as-nav ul{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px}
.as-link{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;text-decoration:none;color:var(--as-text);font-size:14px;font-weight:600;border:1px solid transparent}
.as-link.active{background:rgba(34,197,94,.12);color:#c3ffe0}
.as-link:hover{background:var(--as-hover)}
.as-ico{width:22px;min-width:22px;height:22px;display:inline-flex;align-items:center;justify-content:center}
.as-lbl{white-space:nowrap}
.has-sub .as-toggle{width:100%;text-align:left;background:transparent;border:0}
.has-sub.open > .as-toggle{background:rgba(34,197,94,.12);border-color:rgba(34,197,94,.25);color:#c3ffe0;box-shadow:0 8px 18px rgba(2,6,23,.25)}
.has-sub.open > .as-toggle .as-ico{color:#22c55e}
.as-caret{margin-left:auto;width:0;height:0;border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid var(--as-muted);transition:transform .2s ease}
.has-sub.open .as-caret{transform:rotate(180deg)}
.as-sub{list-style:none;margin:6px 8px;padding:8px 10px 8px 44px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-left:2px solid #22c55e;border-radius:12px;max-height:0;overflow:hidden;opacity:0;transform:translateY(-6px);transition:max-height .25s ease, opacity .25s ease, transform .25s ease}
.has-sub.open .as-sub{opacity:1;transform:translateY(0)}
.as-sublink{position:relative;display:flex;align-items:center;justify-content:space-between;gap:8px;padding:9px 10px;color:var(--as-muted);text-decoration:none;border-radius:8px;font-size:13px;font-weight:600}
.as-sublink::before{content:"";position:absolute;left:-18px;top:50%;transform:translateY(-50%);width:6px;height:6px;border-radius:50%;background:#22c55e;opacity:.55}
.as-sublink:hover{background:#0d1831;color:#e2e8f0}
.as-sublink .badge{display:inline-flex;align-items:center;padding:4px 8px;border-radius:999px;font-size:11px;font-weight:700;background:rgba(47,111,237,.14);color:#9ec1ff;border:1px solid rgba(47,111,237,.23)}
.admin-sidebar::-webkit-scrollbar{width:10px}
.admin-sidebar::-webkit-scrollbar-track{background:#0b1221}
.admin-sidebar::-webkit-scrollbar-thumb{background:#1e293b;border-radius:10px;border:2px solid #0b1221}
.as-footer{border-top:1px solid var(--as-border);padding:10px 8px;display:flex;align-items:center;justify-content:space-between}
.as-version{color:var(--as-muted);font-size:12px}
.admin-sidebar.collapsed .as-lbl{display:none}
.admin-sidebar.collapsed .as-sub{display:none}
.admin-sidebar.collapsed .as-caret{display:none}
.admin-sidebar + .admin-content{margin-left:var(--sidebar-width)}
.admin-sidebar ~ .admin-content{margin-left:var(--sidebar-width)}
</style>
<script>
(function(){
var s=document.querySelector('.admin-sidebar');
var c=s.querySelector('.as-collapse');
var t=s.querySelectorAll('.has-sub > .as-toggle');
var stored=localStorage.getItem('as-collapsed')==='1';
if(stored){s.classList.add('collapsed')}
document.documentElement.style.setProperty('--sidebar-width',stored?'84px':'264px');
t.forEach(function(b){b.addEventListener('click',function(){if(s.classList.contains('collapsed')) return;var li=b.parentElement;var sub=li.querySelector('.as-sub');var expanded=b.getAttribute('aria-expanded')==='true';s.querySelectorAll('.has-sub.open').forEach(function(o){if(o!==li){var ob=o.querySelector('.as-toggle');var os=o.querySelector('.as-sub');o.classList.remove('open');if(ob){ob.setAttribute('aria-expanded','false')}if(os){os.style.maxHeight=0}}});b.setAttribute('aria-expanded',expanded?'false':'true');li.classList.toggle('open',!expanded);if(sub){sub.style.maxHeight=expanded?0:sub.scrollHeight+'px'}})});
 if(c){c.addEventListener('click',function(){var col=s.classList.toggle('collapsed');document.documentElement.style.setProperty('--sidebar-width',col?'84px':'264px');localStorage.setItem('as-collapsed',col?'1':'0');if(col){t.forEach(function(b){var li=b.parentElement;var sub=li.querySelector('.as-sub');b.setAttribute('aria-expanded','false');li.classList.remove('open');if(sub){sub.style.maxHeight=0}})}})}
})();
</script>
