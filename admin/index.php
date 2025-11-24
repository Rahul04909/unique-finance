<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
    :root{--ad-bg:#f6f8fc;--ad-panel:#ffffff;--ad-card:#ffffff;--ad-text:#0f172a;--ad-muted:#64748b;--ad-primary:#2563eb;--ad-secondary:#2f6fed;--ad-border:#e5e7eb;--sidebar-width:264px}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;background:var(--ad-bg);color:var(--ad-text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .admin-sidebar + .admin-content{margin-left:var(--sidebar-width)}
    .admin-sidebar ~ .admin-content{margin-left:var(--sidebar-width)}
    .admin-content{min-height:100vh;display:flex;flex-direction:column}
    .ad-topbar{position:sticky;top:0;z-index:900;background:#ffffff;border-bottom:1px solid var(--ad-border);display:flex;align-items:center;gap:12px;padding:12px 18px}
    .ad-brand{font-weight:800;letter-spacing:.4px;color:var(--ad-text)}
    .ad-search{flex:1;display:flex;gap:8px}
    .ad-input{flex:1;background:#ffffff;border:1px solid var(--ad-border);color:var(--ad-text);border-radius:12px;padding:10px 12px;font-weight:600}
    .ad-actions{display:flex;gap:8px}
    .ad-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 12px;border-radius:12px;border:1px solid var(--ad-border);background:#ffffff;color:var(--ad-text);font-weight:700}
    .ad-btn.primary{background:rgba(37,99,235,.08);border-color:rgba(37,99,235,.2);color:#2563eb}
    .ad-wrapper{padding:18px}
    .ad-grid{display:grid;grid-template-columns:repeat(12,1fr);gap:16px}
    .ad-card{background:#ffffff;border:1px solid var(--ad-border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.08)}
    .kpi{grid-column:span 3;display:flex;flex-direction:column;gap:8px;padding:16px}
    .kpi .kpi-top{display:flex;align-items:center;justify-content:space-between}
    .kpi .kpi-title{color:var(--ad-muted);font-weight:700}
    .kpi .kpi-val{font-size:26px;font-weight:900}
    .kpi .kpi-trend{height:36px}
    .panel{grid-column:span 8;padding:16px;display:flex;flex-direction:column;gap:12px}
    .side{grid-column:span 4;padding:16px;display:flex;flex-direction:column;gap:12px}
    .panel-head{display:flex;align-items:center;justify-content:space-between}
    .panel-title{font-weight:800}
    .panel-actions{display:flex;gap:8px}
    .table{width:100%;border-collapse:collapse}
    .table th,.table td{padding:10px;border-bottom:1px solid var(--ad-border)}
    .table th{color:var(--ad-muted);text-align:left}
    .chip{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;font-size:12px;font-weight:700}
    .chip.green{background:rgba(34,197,94,.12);color:#9ff5c9;border:1px solid rgba(34,197,94,.25)}
    .chip.yellow{background:rgba(245,158,11,.12);color:#ffe3b3;border:1px solid rgba(245,158,11,.25)}
    .chip.red{background:rgba(239,68,68,.12);color:#ffcaca;border:1px solid rgba(239,68,68,.25)}
    .qa{display:grid;grid-template-columns:repeat(2,1fr);gap:10px}
    .qa .ad-btn{justify-content:center}
    .mini-list{display:flex;flex-direction:column;gap:8px}
    .mini-item{display:flex;align-items:center;justify-content:space-between;padding:10px;border:1px solid var(--ad-border);border-radius:12px;background:#ffffff}
    .progress{height:8px;border-radius:8px;background:#ffffff;border:1px solid var(--ad-border);overflow:hidden}
    .progress > span{display:block;height:100%;background:linear-gradient(90deg,#22c55e,#2f6fed)}
    .chart-wrap{height:220px}
    .chart-wrap canvas{width:100%;height:220px;display:block}
    @media(max-width:1200px){.kpi{grid-column:span 6}.panel{grid-column:span 12}.side{grid-column:span 12}}
    @media(max-width:720px){.ad-grid{gap:12px}.kpi{grid-column:span 12}}
  </style>
</head>
<body>
  <?php include __DIR__.'/sidebar.php'; ?>
  <main class="admin-content">
    <div class="ad-topbar">
      <div class="ad-brand">Admin</div>
      <div class="ad-search">
        <input class="ad-input" type="search" placeholder="Search applicants, loans, payments">
      </div>
      <div class="ad-actions">
        <button class="ad-btn">🔔 Alerts</button>
        <button class="ad-btn">⚙️ Settings</button>
        <button class="ad-btn primary">➕ New</button>
      </div>
    </div>
    <div class="ad-wrapper">
      <div class="ad-grid">
        <div class="ad-card kpi">
          <div class="kpi-top"><div class="kpi-title">Applications</div><div class="chip green">+12%</div></div>
          <div class="kpi-val">1,248</div>
        </div>
        <div class="ad-card kpi">
          <div class="kpi-top"><div class="kpi-title">Active Loans</div><div class="chip yellow">+5%</div></div>
          <div class="kpi-val">846</div>
        </div>
        <div class="ad-card kpi">
          <div class="kpi-top"><div class="kpi-title">Due Today</div><div class="chip red">-3%</div></div>
          <div class="kpi-val">63</div>
        </div>
        <div class="ad-card kpi">
          <div class="kpi-top"><div class="kpi-title">Collections</div><div class="chip green">+9%</div></div>
          <div class="kpi-val">₹ 28.4L</div>
        </div>
        <div class="ad-card panel">
          <div class="panel-head">
            <div class="panel-title">Recent Applications</div>
            <div class="panel-actions"><button class="ad-btn">Export</button><button class="ad-btn">Filter</button></div>
          </div>
          <div class="chart-wrap"><canvas id="asChart"></canvas></div>
          <table class="table">
            <thead>
              <tr><th>ID</th><th>Name</th><th>Product</th><th>Status</th><th>Amount</th></tr>
            </thead>
            <tbody>
              <tr><td>#A1024</td><td>Rahul Sharma</td><td>Personal Loan</td><td><span class="chip green">Approved</span></td><td>₹ 5,00,000</td></tr>
              <tr><td>#A1025</td><td>Neha Patel</td><td>Home Loan</td><td><span class="chip yellow">Under Review</span></td><td>₹ 35,00,000</td></tr>
              <tr><td>#A1026</td><td>Amit Verma</td><td>Car Loan</td><td><span class="chip red">Pending Docs</span></td><td>₹ 8,50,000</td></tr>
            </tbody>
          </table>
        </div>
        <div class="ad-card side">
          <div class="panel-title">Quick Actions</div>
          <div class="qa">
            <button class="ad-btn">New Application</button>
            <button class="ad-btn">KYC Verify</button>
            <button class="ad-btn">Create Disbursement</button>
            <button class="ad-btn">Schedule Payment</button>
          </div>
          <div class="panel-title">Upcoming Payments</div>
          <div class="mini-list">
            <div class="mini-item"><div>Priya Singh • PL-842</div><div class="chip yellow">Tomorrow</div></div>
            <div class="mini-item"><div>Manish Gupta • HL-203</div><div class="chip yellow">Tomorrow</div></div>
            <div class="mini-item"><div>Vikas Jain • CL-733</div><div class="chip green">In 3 days</div></div>
          </div>
          <div class="panel-title">Portfolio Health</div>
          <div class="progress"><span style="width:72%"></span></div>
        </div>
      </div>
    </div>
  </main>
  <script>
    (function(){
      var c=document.getElementById('asChart');
      if(!c) return;
      function render(){
        c.width = c.clientWidth;
        c.height = 220;
        var ctx=c.getContext('2d');
        var w=c.width,h=c.height;
        ctx.clearRect(0,0,w,h);
        var data=[12,18,16,22,28,26,32,30,36,40];
        var max=Math.max.apply(null,data);
        ctx.lineWidth=2;
        var g=ctx.createLinearGradient(0,0,w,0);
        g.addColorStop(0,'#22c55e');
        g.addColorStop(1,'#2f6fed');
        ctx.strokeStyle=g;
        ctx.beginPath();
        for(var i=0;i<data.length;i++){
          var x=i*(w/(data.length-1));
          var y=h-(data[i]/max)*h;
          if(i===0) ctx.moveTo(x,y); else ctx.lineTo(x,y)
        }
        ctx.stroke();
        ctx.fillStyle='rgba(47,111,237,.12)';
        ctx.beginPath();
        ctx.moveTo(0,h);
        for(var j=0;j<data.length;j++){
          var x2=j*(w/(data.length-1));
          var y2=h-(data[j]/max)*h;
          ctx.lineTo(x2,y2)
        }
        ctx.lineTo(w,h);
        ctx.closePath();
        ctx.fill();
      }
      render();
      window.addEventListener('resize', render);
    })();
  </script>
</body>
</html>