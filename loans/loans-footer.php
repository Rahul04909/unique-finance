<?php
?>
<footer class="lf-footer">
  <div class="lf-container">
    <div class="lf-top" aria-label="Loans footer navigation">
      <div class="lf-col">
        <h3 class="lf-heading">Insurance</h3>
        <ul class="lf-links">
          <li><a href="#">Health Insurance</a></li>
          <li><a href="#">Term Insurance</a></li>
          <li><a href="#">Car Insurance</a></li>
          <li><a href="#">Bike Insurance</a></li>
          <li><a href="#">Travel Insurance</a></li>
          <li><a href="#">Home Insurance</a></li>
          <li><a href="#">Group Health Insurance</a></li>
        </ul>
      </div>
      <div class="lf-col">
        <h3 class="lf-heading">Loans</h3>
        <ul class="lf-links">
          <li><a href="#">Personal Loan</a></li>
          <li><a href="#">Home Loan</a></li>
          <li><a href="#">Business Loan</a></li>
          <li><a href="#">Education Loan</a></li>
          <li><a href="#">Car Loan</a></li>
          <li><a href="#">Gold Loan</a></li>
        </ul>
      </div>
      <div class="lf-col">
        <h3 class="lf-heading">Calculators</h3>
        <ul class="lf-links">
          <li><a href="#">EMI Calculator</a></li>
          <li><a href="#">Term Insurance Calculator</a></li>
          <li><a href="#">Income Tax Calculator</a></li>
          <li><a href="#">HLV Calculator</a></li>
        </ul>
      </div>
    </div>
    <div class="lf-bottom">
      <div class="lf-brand">
        <span class="lf-badge">Loans</span>
        <span class="lf-note">Compare, apply, and manage finances smarter</span>
      </div>
    </div>
  </div>
  <style>
  .lf-footer{--lf-bg:#0e1f4a;--lf-surface:#132761;--lf-heading:#ffffff;--lf-text:#cbd5e1;--lf-muted:#9fb0d6;--lf-border:#284076;--lf-accent:#2f6fed}
  .lf-footer{background:var(--lf-bg);color:var(--lf-text);border-radius:32px 32px 0 0;margin-top:24px}
  .lf-container{max-width:1200px;margin:0 auto;padding:24px 16px}
  .lf-top{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:24px;padding-bottom:16px;border-bottom:1px solid var(--lf-border)}
  .lf-heading{margin:0 0 12px 0;color:var(--lf-heading);font-size:16px;font-weight:800}
  .lf-links{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px}
  .lf-links li{position:relative;padding-left:18px}
  .lf-links li::before{content:"";position:absolute;left:0;top:.55em;width:8px;height:8px;border-radius:50%;background:#37579e;border:1px solid #5f7cc0}
  .lf-links a{color:var(--lf-text);text-decoration:none;font-size:14px;font-weight:600}
  .lf-links a:hover{color:#ffffff}
  .lf-bottom{display:flex;align-items:center;justify-content:space-between;gap:12px;padding-top:14px}
  .lf-badge{display:inline-flex;align-items:center;justify-content:center;height:28px;padding:0 10px;border-radius:999px;background:var(--lf-surface);color:#fff;border:1px solid var(--lf-border);font-size:12px;font-weight:800}
  .lf-note{color:var(--lf-muted);font-size:13px;font-weight:700}
  @media(max-width:880px){.lf-top{grid-template-columns:repeat(2,1fr)}}
  @media(max-width:560px){.lf-top{grid-template-columns:1fr}.lf-container{padding:22px 16px}.lf-links a{font-size:15px}}
  </style>
</footer>
