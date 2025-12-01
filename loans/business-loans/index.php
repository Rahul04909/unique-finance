<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'Business Loan - Apply Online';
$seoBrand = 'Unique Finance Group';
$fullTitle = $seoTitle.' - '.$seoBrand;
$seoDescription = 'Apply for a business loan online. Fast approvals, minimal paperwork, and flexible repayment. Mobile responsive page with secure form.';
$ogImagePath = '/assets/img/hero/personal-loan-upto-50-lakhs.png';
$ogImage = $origin . $ogImagePath;
$submitted = false;
$error = '';
$successMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['name']) ? trim($_POST['name']) : '';
  $mobile = isset($_POST['mobile']) ? preg_replace('/[^0-9]/','', $_POST['mobile']) : '';
  $email = isset($_POST['email']) ? trim($_POST['email']) : '';
  $city = isset($_POST['city']) ? trim($_POST['city']) : '';
  $business = isset($_POST['business']) ? trim($_POST['business']) : '';
  $turnover = isset($_POST['turnover']) ? floatval($_POST['turnover']) : 0.0;
  $loan_amount = isset($_POST['loan_amount']) ? floatval($_POST['loan_amount']) : 0.0;
  $tenure_years = isset($_POST['tenure_years']) ? intval($_POST['tenure_years']) : 0;
  if ($name && $mobile && strlen($mobile) >= 10 && filter_var($email, FILTER_VALIDATE_EMAIL) && $city && $business && $loan_amount > 0 && $tenure_years > 0) {
    $submitted = true;
    $successMsg = 'Your business loan request has been submitted.';
  } else {
    $error = 'Please fill all required fields correctly.';
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
    .bl{--bg:#f7f8fc;--text:#0f172a;--muted:#64748b;--border:#e5e7eb;--card:#ffffff;--primary:#0b46c1}
    .bl *, .bl *::before, .bl *::after{box-sizing:border-box}
    body{margin:0}
    .bl{padding:18px;background:var(--bg);color:var(--text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .bl-container{max-width:1200px;margin:0 auto}
    .bl-hero{display:flex;align-items:center;justify-content:center;padding:24px 0}
    .bl .hero-copy{max-width:880px;text-align:center}
    .bl .hero-copy h1{font-size:36px;line-height:1.15;margin:0 0 10px;font-weight:900}
    .bl .hero-copy p{font-size:16px;color:var(--muted);font-weight:600}
    .bl .hero-points{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin:16px 0 0;padding:0;list-style:none}
    .bl .hero-points li{display:inline-flex;align-items:center;padding:8px 12px;border-radius:999px;background:#fff;border:1px solid var(--border);font-weight:800;color:#0b46c1;position:relative;padding-left:28px}
    .bl .hero-points li::before{content:"✓";position:absolute;left:10px;color:#16a34a;font-weight:900}
    .bl-grid{display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-top:18px}
    .bl .card{background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.08);padding:16px;transition:box-shadow .2s ease, transform .2s ease}
    .bl .card:hover{transform:translateY(-2px);box-shadow:0 14px 34px rgba(2,6,23,.12)}
    .bl .card-title{font-weight:900;margin-bottom:12px}
    .bl .fields{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .bl #businessLoanForm{scroll-margin-top:80px}
    .bl .field-group{display:flex;flex-direction:column;gap:6px}
    .bl .field-group label{font-size:12px;color:var(--muted);font-weight:800}
    .bl .field-group input,.bl .field-group select{padding:12px 14px;border-radius:12px;border:1px solid var(--border);background:#fff;color:var(--text);font-weight:600;transition:border-color .2s ease, box-shadow .2s ease}
    .bl .field-group input:focus,.bl .field-group select:focus{outline:none;border-color:#7aa2ff;box-shadow:0 0 0 4px rgba(11,70,193,.12)}
    .bl .btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 16px;border-radius:12px;border:1px solid var(--border);background:#ffffff;color:var(--text);font-weight:900;transition:all .2s ease}
    .bl .btn:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(2,6,23,.08)}
    .bl .btn-primary{background:var(--primary);border-color:var(--primary);color:#ffffff}
    .bl .btn-primary:hover{filter:brightness(1.05)}
    .bl .alert{margin:10px 0;padding:10px;border-radius:12px}
    .bl .alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444}
    .bl .alert-success{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.25);color:#16a34a}
    .bl-info .list{margin:0;padding-left:18px}
    .bl .cta-block{margin-top:12px;display:flex;align-items:center;justify-content:space-between}
    .bl .cta-block .btn{padding:10px 12px}
    .bl-ad{margin-top:18px}
    .bl .ad-card{position:relative;overflow:hidden;border-radius:16px}
    .bl .ad-img{width:100%;height:auto;display:block}
    .bl .ad-overlay{position:absolute;left:0;right:0;bottom:0;background:linear-gradient(180deg,rgba(2,6,23,0),rgba(2,6,23,.6));padding:16px;color:#fff;display:flex;align-items:center;justify-content:space-between}
    .bl-features{margin-top:24px}
    .bl .features-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
    .bl .feature-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:14px}
    .bl-elig{margin-top:24px}
    .bl .elig-table{width:100%;border-collapse:collapse}
    .bl .elig-table th,.bl .elig-table td{padding:10px;border-bottom:1px solid var(--border);text-align:left}
    .bl .elig-table tbody tr:nth-child(odd){background:#fafbff}
    .bl .chip{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;border:1px solid var(--border);background:#fff;font-weight:800;color:#0b46c1}
    .bl-faq{margin-top:24px}
    .bl .faq-item{border:1px solid var(--border);border-radius:12px;padding:12px;background:#fff}
    .bl .faq-q{font-weight:900}
    .bl .faq-a{color:var(--muted);font-weight:600}
    @media(max-width:960px){.bl-grid{grid-template-columns:1fr}.bl .features-grid{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:640px){.bl .fields{grid-template-columns:1fr}.bl .features-grid{grid-template-columns:1fr}.bl .hero-copy h1{font-size:28px}}
  </style>
</head>
<body>
  <?php include __DIR__.'/../../includes/header.php'; ?>
  <section class="bl">
    <div class="bl-container">
      <div class="bl-hero">
        <div class="hero-copy">
          <h1>Business Loan</h1>
          <p>Fuel growth with quick, flexible business loans designed for SMEs and startups. Secure application and rapid processing.</p>
          <ul class="hero-points">
            <li>Loan amounts up to ₹2 Cr</li>
            <li>Tenure up to 10 years</li>
            <li>Minimal documentation</li>
            <li>Working capital & expansion</li>
          </ul>
        </div>
      </div>
      <div class="bl-grid">
        <div class="bl-form">
          <div class="card">
            <div class="card-title">Apply for Business Loan</div>
            <?php if($error): ?><div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div><?php endif; ?>
            <?php if($submitted && !$error): ?><div class="alert alert-success"><?php echo htmlspecialchars($successMsg, ENT_QUOTES); ?></div><?php endif; ?>
            <form method="post" id="businessLoanForm" novalidate>
              <div class="fields">
                <div class="field-group">
                  <label for="name">Full name</label>
                  <input type="text" id="name" name="name" required autocomplete="name">
                </div>
                <div class="field-group">
                  <label for="mobile">Mobile</label>
                  <input type="tel" id="mobile" name="mobile" required inputmode="numeric" pattern="[0-9]{10}" placeholder="9876543210" autocomplete="tel">
                </div>
                <div class="field-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required autocomplete="email">
                </div>
                <div class="field-group">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" required autocomplete="address-level2">
                </div>
                <div class="field-group">
                  <label for="business">Business type</label>
                  <select id="business" name="business" autocomplete="organization">
                    <option value="Proprietorship">Proprietorship</option>
                    <option value="Partnership">Partnership</option>
                    <option value="LLP">LLP</option>
                    <option value="Private Limited">Private Limited</option>
                  </select>
                </div>
                <div class="field-group">
                  <label for="turnover">Annual turnover (₹)</label>
                  <input type="number" id="turnover" name="turnover" min="100000" step="1000" inputmode="decimal" placeholder="2500000" autocomplete="off">
                </div>
                <div class="field-group">
                  <label for="loan_amount">Loan amount (₹)</label>
                  <input type="number" id="loan_amount" name="loan_amount" min="100000" step="1000" inputmode="decimal" placeholder="1000000" required autocomplete="off">
                </div>
                <div class="field-group">
                  <label for="tenure_years">Tenure (years)</label>
                  <input type="number" id="tenure_years" name="tenure_years" min="1" max="10" step="1" inputmode="numeric" placeholder="5" required autocomplete="off">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Apply Now</button>
            </form>
          </div>
        </div>
        <div class="bl-info">
          <div class="card">
            <div class="card-title">Benefits</div>
            <ul class="list">
              <li>Quick approval and disbursal</li>
              <li>Collateral‑free options available</li>
              <li>Custom repayment schedules</li>
              <li>Top‑up for inventory and expansion</li>
            </ul>
            <div class="cta-block">
              <div>Get tailored offers for your business</div>
              <a class="btn" href="#businessLoanForm">Talk to an expert</a>
            </div>
          </div>
        </div>
      </div>
      <section class="bl-ad">
        <div class="ad-card">
          <img src="../../assets/img/hero/personal-loan-upto-50-lakhs.png" alt="Business Loan Offers" class="ad-img">
          <div class="ad-overlay">
            <div>Special Business Loan Offers</div>
            <a class="btn" href="#businessLoanForm">Apply Now</a>
          </div>
        </div>
      </section>
      <section class="bl-features">
        <div class="card">
          <div class="card-title">Why choose our Business Loans</div>
          <div class="features-grid">
            <div class="feature-card">Flexible repayment tenure</div>
            <div class="feature-card">Transparent charges</div>
            <div class="feature-card">Dedicated relationship manager</div>
            <div class="feature-card">Doorstep document pickup</div>
            <div class="feature-card">Pre‑approved upgrade offers</div>
            <div class="feature-card">Secure online processing</div>
          </div>
        </div>
      </section>
      <section class="bl-elig">
        <div class="card">
          <div class="card-title">Business Loan Eligibility</div>
          <table class="elig-table">
            <thead>
              <tr>
                <th>Eligibility Criteria</th>
                <th>Requirement</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Age</td>
                <td>21–65 years</td>
              </tr>
              <tr>
                <td>Business Vintage</td>
                <td>Minimum 1–3 years depending on lender</td>
              </tr>
              <tr>
                <td>Entity Type</td>
                <td>
                  <span class="chip">Proprietorship</span>
                  <span class="chip">Partnership</span>
                  <span class="chip">LLP</span>
                  <span class="chip">Private Limited</span>
                </td>
              </tr>
              <tr>
                <td>Credit Score</td>
                <td>Preferably 700+</td>
              </tr>
              <tr>
                <td>Turnover</td>
                <td>₹10 lakh+ annually (varies by lender)</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <section class="bl-faq">
        <div class="card">
          <div class="card-title">Frequently Asked Questions</div>
          <div class="faq-item"><div class="faq-q">What is the interest rate?</div><div class="faq-a">Rates vary by lender and profile; typical range is 10%–24% p.a.</div></div>
          <div class="faq-item"><div class="faq-q">Is collateral required?</div><div class="faq-a">Secured and collateral‑free options exist depending on eligibility.</div></div>
          <div class="faq-item"><div class="faq-q">How long does approval take?</div><div class="faq-a">Initial approval may be as quick as 24–48 hours post document verification.</div></div>
        </div>
      </section>
    </div>
  </section>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "<?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?>",
    "description": "<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>",
    "url": "<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>",
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo htmlspecialchars($seoBrand, ENT_QUOTES); ?>"
    }
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type": "Question","name": "What is the interest rate?","acceptedAnswer": {"@type": "Answer","text": "Rates vary by lender and profile; typical range is 10%–24% p.a."}},
      {"@type": "Question","name": "Is collateral required?","acceptedAnswer": {"@type": "Answer","text": "Secured and collateral‑free options exist depending on eligibility."}},
      {"@type": "Question","name": "How long does approval take?","acceptedAnswer": {"@type": "Answer","text": "Initial approval may be as quick as 24–48 hours post document verification."}}
    ]
  }
  </script>
  <script>
    (function(){
      var form = document.getElementById('businessLoanForm');
      if (!form) return;
      form.addEventListener('submit', function(e){
        var mobile = document.getElementById('mobile').value.replace(/[^0-9]/g,'');
        var email = document.getElementById('email').value;
        if (mobile.length < 10 || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
          e.preventDefault();
          alert('Please enter valid mobile and email');
        }
      });
    })();
  </script>
</body>
</html>
