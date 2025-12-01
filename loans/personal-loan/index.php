<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'Personal Loan - Apply Online';
$seoBrand = 'Unique Finance Group';
$fullTitle = $seoTitle.' - '.$seoBrand;
$seoDescription = 'Apply for a personal loan online from 30+ lenders. Choose the best offers based on eligibility, enjoy digital processing, and instant disbursal. Mobile-responsive, secure form with EMI calculator and curated salary-based offers.';
$ogImagePath = '/assets/img/hero/hero-banner-3.avif';
$ogImage = $origin . $ogImagePath;
$submitted = false;
$error = '';
$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['name']) ? trim($_POST['name']) : '';
  $mobile = isset($_POST['mobile']) ? preg_replace('/[^0-9]/','', $_POST['mobile']) : '';
  if ($name && $mobile && strlen($mobile) >= 10) {
    $submitted = true;
    $successMsg = 'Your personal loan request has been submitted.';
  } else {
    $error = 'Please enter valid name and mobile number.';
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta name="theme-color" content="#0b46c1">
  <meta property="og:title" content="<?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($seoBrand, ENT_QUOTES); ?>">
  <meta property="og:locale" content="en_US">
  <meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
  <style>
    .pl{--blue:#2f6fed;--primary:#0b46c1;--text:#0f172a;--muted:#64748b;--border:#e6eeff;--bg:#ffffff}
    .pl *, .pl *::before, .pl *::after{box-sizing:border-box}
    body{margin:0}
    .pl{background:#fff;color:var(--text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .pl-container{max-width:1200px;margin:0 auto;padding:16px}
    .pl-breadcrumb{font-size:13px;color:#334155;margin-bottom:8px}
    .pl-breadcrumb a{text-decoration:none;color:#0b46c1;font-weight:700}
    .pl-hero{display:grid;grid-template-columns:1.1fr .9fr;gap:20px;align-items:start}
    .pl-hero-left{border:1px solid var(--border);border-radius:16px;background:#f8fbff;box-shadow:0 12px 28px rgba(12,41,106,.06);padding:18px}
    .pl-hero-left h1{margin:0 0 8px;font-size:28px;font-weight:900;color:#1f2937}
    .pl-points{list-style:none;margin:8px 0 12px;padding:0;display:flex;flex-direction:column;gap:10px;color:#334155}
    .pl-points li{display:flex;align-items:center;gap:10px}
    .pl-points .icon{width:30px;height:30px;border-radius:8px;background:#e6f0ff;color:#0b46c1;display:inline-flex;align-items:center;justify-content:center;font-weight:900}
    .pl-hero-ill{margin-top:8px;border-radius:16px;overflow:hidden}
    .pl-hero-ill img{display:block;width:100%;height:auto}
    .pl-rating{display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;margin-top:12px}
    .pl-rating .card{border:1px solid var(--border);border-radius:12px;background:#fff;box-shadow:0 8px 20px rgba(12,41,106,.06);padding:12px;text-align:center;color:#334155}
    .pl-rating .stars{color:#f59e0b;font-size:18px;letter-spacing:2px}
    .pl-form-card{border:1px solid var(--border);border-radius:16px;background:#fff;box-shadow:0 12px 28px rgba(12,41,106,.06);padding:18px}
    .pl-form-card .title{font-weight:900;color:#1f2937;margin-bottom:10px}
    .pl-form .field{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
    .pl-form input{padding:12px;border-radius:12px;border:1px solid var(--border);font-size:14px}
    .pl-btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 14px;border-radius:12px;background:var(--primary);color:#fff;border:0;font-weight:800;font-size:15px;width:100%}
    .pl-consent{margin-top:8px;color:#64748b;font-size:12px;text-align:center;font-weight:600}
    .pl-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:20px;align-items:start;margin-top:20px}
    .card{border:1px solid var(--border);border-radius:16px;background:#fff;box-shadow:0 12px 28px rgba(12,41,106,.06);padding:18px}
    .card-title{font-size:18px;font-weight:900;color:#1f2937;margin-bottom:12px}
    .pl-emi .controls{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .pl-emi .chips{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:10px}
    .chip{display:inline-flex;align-items:center;justify-content:center;padding:8px 12px;border-radius:12px;border:1px solid var(--border);background:#f8fbff;color:#0f172a;font-weight:800}
    .chip.active{background:#e6f0ff;color:#0b46c1;border-color:#cfe0ff}
    .pl-emi .range{display:flex;align-items:center;gap:10px}
    .pl-emi input[type=range]{width:100%}
    .pl-emi .result{border-left:1px solid var(--border);background:#f3f8ff;border-radius:16px;padding:18px}
    .pl-emi .result .big{font-size:28px;font-weight:900;color:#166534}
    .pl-emi .result .list{list-style:none;margin:10px 0 0;padding:0;color:#334155;font-weight:700}
    .pl-emi .result .list li{display:flex;align-items:center;justify-content:space-between;margin:6px 0}
    .pl-elig .offer-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
    .pl-elig .offer-card{border:1px solid var(--border);border-radius:16px;box-shadow:0 8px 20px rgba(12,41,106,.06);padding:16px;background:linear-gradient(180deg,#fff,#f5f9ff)}
    .pl-elig .offer-card .salary{font-size:22px;font-weight:900;color:#0f172a}
    .pl-elig .offer-card .tag{color:#334155;font-weight:700}
    .pl-elig .offer-card .btn{margin-top:10px}
    .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 12px;border-radius:12px;background:#0b46c1;color:#fff;border:0;font-weight:800}
    @media(max-width:980px){.pl-hero{grid-template-columns:1fr}.pl-grid{grid-template-columns:1fr}}
    @media(max-width:560px){.pl-container{padding:12px}.pl-rating{grid-template-columns:1fr 1fr}.pl-elig .offer-grid{grid-template-columns:1fr 1fr}.pl-emi .controls{grid-template-columns:1fr}}
    @media(max-width:420px){.pl-rating{grid-template-columns:1fr}.pl-elig .offer-grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <?php include __DIR__.'/../../includes/header.php'; ?>
  <section class="pl">
    <div class="pl-container">
      <div class="pl-breadcrumb"><a href="/">Home</a> / Personal Loan</div>
      <div class="pl-hero">
        <div class="pl-hero-left">
          <h1>Personal Loan</h1>
          <ul class="pl-points">
            <li><span class="icon">✓</span><span>Personal Loans from 30+ lenders</span></li>
            <li><span class="icon">✓</span><span>Choose best offer based on eligibility</span></li>
            <li><span class="icon">✓</span><span>Pre‑approved loans without documents</span></li>
            <li><span class="icon">✓</span><span>Digital process, instant disbursal</span></li>
          </ul>
          <div class="pl-hero-ill"><img src="../../assets/img/hero/personal-loan-upto-50-lakhs.png" alt="Personal Loan Offers"></div>
          <div class="pl-rating">
            <div class="card">
              <div>Customer Rating</div>
              <div class="stars">★★★★★</div>
              <div><strong>4.2/5</strong> | 2839 Reviews</div>
            </div>
            <div class="card"><div><strong>51M+</strong></div><div>Satisfied Customers</div></div>
            <div class="card"><div><strong>65+</strong></div><div>Lending Partners</div></div>
            <div class="card"><div><strong>800+</strong></div><div>Cities across India</div></div>
          </div>
        </div>
        <div class="pl-form-card">
          <div class="title">Apply Personal Loan Online</div>
          <?php if($error): ?><div class="card" style="border-color:#fecaca;background:#fee2e2;color:#7f1d1d"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div><?php endif; ?>
          <?php if($submitted && !$error): ?><div class="card" style="border-color:#bbf7d0;background:#dcfce7;color:#14532d"><?php echo htmlspecialchars($successMsg, ENT_QUOTES); ?></div><?php endif; ?>
          <form method="post" class="pl-form" id="plForm" novalidate>
            <div class="field">
              <label for="name">Full Name (as on PAN)</label>
              <input type="text" id="name" name="name" required autocomplete="name" placeholder="Full Name">
            </div>
            <div class="field">
              <label for="mobile">Mobile Number</label>
              <input type="tel" id="mobile" name="mobile" required inputmode="numeric" pattern="[0-9]{10}" placeholder="9876543210" autocomplete="tel">
            </div>
            <button type="submit" class="pl-btn">Apply Now →</button>
            <div class="pl-consent">By submitting this form, you agree to receive updates over call/SMS and accept our terms.</div>
          </form>
        </div>
      </div>

      <div class="pl-grid pl-emi">
        <div class="card">
          <div class="card-title">Personal Loan EMI Calculator</div>
          <div class="chips" id="amountChips">
            <button type="button" class="chip" data-val="100000">₹1 L</button>
            <button type="button" class="chip active" data-val="500000">₹5 L</button>
            <button type="button" class="chip" data-val="1000000">₹10 L</button>
            <button type="button" class="chip" data-val="1500000">₹15 L</button>
            <button type="button" class="chip" data-val="5000000">₹50 L</button>
          </div>
          <div class="controls">
            <div>
              <div>Amount</div>
              <div class="range"><input type="range" id="plAmount" min="50000" max="5000000" step="10000" value="500000"><span id="plAmountOut"></span></div>
            </div>
            <div>
              <div>Rate of Interest (p.a.)</div>
              <div class="range"><input type="range" id="plRate" min="8" max="30" step="0.1" value="10.5"><span id="plRateOut"></span></div>
            </div>
            <div>
              <div>Tenure</div>
              <div class="range"><input type="range" id="plYears" min="1" max="10" step="1" value="3"><span id="plYearsOut"></span></div>
            </div>
            <div>
              <div>&nbsp;</div>
              <div class="range"><label><input type="checkbox" id="plTenureMonths"> Show in months</label></div>
            </div>
          </div>
        </div>
        <aside class="card result" id="plResult">
          <div>Your Monthly EMI Payment</div>
          <div class="big" id="plEmi">₹0</div>
          <ul class="list">
            <li><span>Principal Amount</span><span id="plPrincipal">₹0</span></li>
            <li><span>Interest Amount</span><span id="plInterest">₹0</span></li>
            <li><span>Total Amount</span><span id="plTotal">₹0</span></li>
          </ul>
        </aside>
      </div>

      <section class="pl-elig">
        <h2 class="card-title">Check Curated Personal Loan Offers Based on Your Salary</h2>
        <div class="offer-grid">
          <?php foreach([25000,30000,50000,60000,80000,100000] as $sal): ?>
          <div class="offer-card">
            <div class="salary">₹<?php echo number_format($sal); ?></div>
            <div class="tag">salary</div>
            <a href="#" class="btn">Read More →</a>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php include __DIR__.'/../loans-footer.php'; ?>
    </div>
  </section>

  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $fullTitle,
    'description' => $seoDescription,
    'url' => $canonical,
    'breadcrumb' => 'Home > Personal Loan'
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
      ['@type'=>'Question','name'=>'What is a personal loan?','acceptedAnswer'=>['@type'=>'Answer','text'=>'An unsecured loan for personal expenses with fixed tenure and monthly EMIs.']],
      ['@type'=>'Question','name'=>'How is EMI calculated?','acceptedAnswer'=>['@type'=>'Answer','text'=>'EMI depends on loan amount, interest rate, and tenure using the standard amortization formula.']],
      ['@type'=>'Question','name'=>'How quickly can a personal loan be disbursed?','acceptedAnswer'=>['@type'=>'Answer','text'=>'With digital processing, disbursal can be as quick as 24–48 hours, subject to verification.']]
    ]
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
  <script>
  (function(){
    function ru(x){return new Intl.NumberFormat('en-IN',{maximumFractionDigits:0}).format(x)}
    var amt=document.getElementById('plAmount');
    var rate=document.getElementById('plRate');
    var yrs=document.getElementById('plYears');
    var mToggle=document.getElementById('plTenureMonths');
    var chips=document.querySelectorAll('#amountChips .chip');
    function update(){
      var P=+amt.value;
      var annual=+rate.value;
      var years=+yrs.value;
      var months=mToggle.checked?years*12:years*12;
      var r=annual/12/100;
      var pow=Math.pow(1+r,months);
      var emi=Math.round(P*r*pow/(pow-1));
      var total=emi*months;
      var interest=total-P;
      document.getElementById('plAmountOut').textContent='₹'+ru(P);
      document.getElementById('plRateOut').textContent=annual.toFixed(1)+'%';
      document.getElementById('plYearsOut').textContent=(mToggle.checked?(years*12+' Mo'):(years+' Yrs'));
      document.getElementById('plEmi').textContent='₹'+ru(emi);
      document.getElementById('plPrincipal').textContent='₹'+ru(P);
      document.getElementById('plInterest').textContent='₹'+ru(interest);
      document.getElementById('plTotal').textContent='₹'+ru(total);
    }
    [amt,rate,yrs,mToggle].forEach(function(el){el.addEventListener('input',update)});
    chips.forEach(function(c){c.addEventListener('click',function(){chips.forEach(function(o){o.classList.remove('active')});c.classList.add('active');amt.value=c.getAttribute('data-val');update()})});
    update();
    var form=document.getElementById('plForm');
    if(form){form.addEventListener('submit',function(e){var m=document.getElementById('mobile').value.replace(/[^0-9]/g,'');if(m.length<10){e.preventDefault();alert('Please enter valid mobile number');}})}
  })();
  </script>
</body>
</html>
