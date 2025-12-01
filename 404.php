<?php
http_response_code(404);
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$origin = $scheme.'://'.$host;
$requested = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/404';
$canonical = $origin.$requested;
$title = 'Page Not Found (404)';
$desc = 'We could not find the page you’re looking for. Explore loans, insurance, and calculators or return to the homepage.';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($title,ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($desc,ENT_QUOTES); ?>">
  <meta name="robots" content="noindex, follow">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical,ENT_QUOTES); ?>">
  <meta name="theme-color" content="#0b46c1">
  <style>
    .nf{--text:#0f172a;--muted:#64748b;--border:#e5e7eb;--primary:#0b46c1}
    .nf-container{max-width:980px;margin:0 auto;padding:24px 16px}
    .nf-card{border:1px solid var(--border);border-radius:16px;background:#fff;box-shadow:0 10px 28px rgba(12,41,106,.08);padding:24px}
    .nf-title{font-size:28px;font-weight:900;color:#1f2937;margin:0}
    .nf-sub{color:var(--muted);font-weight:700;margin:6px 0 16px}
    .nf-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px}
    .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 12px;border-radius:12px;border:1px solid var(--border);background:#fff;color:#0f172a;font-weight:800}
    .btn.primary{background:rgba(11,70,193,.08);color:var(--primary);border-color:rgba(11,70,193,.24)}
    .nf-links{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px}
    .link-card{border:1px solid var(--border);border-radius:12px;padding:14px;background:#f8fbff;color:#0f172a;font-weight:800;text-decoration:none;display:flex;align-items:center;justify-content:space-between}
    @media(max-width:800px){.nf-links{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:520px){.nf-links{grid-template-columns:1fr}.nf-container{padding:18px 12px}}
  </style>
</head>
<body>
  <?php include __DIR__.'/includes/header.php'; ?>
  <section class="nf">
    <div class="nf-container">
      <div class="nf-card">
        <h1 class="nf-title">This page isn’t available</h1>
        <div class="nf-sub">Error 404 • The URL may be incorrect or the page has moved.</div>
        <div class="nf-actions">
          <a class="btn primary" href="/">Go to Homepage →</a>
          <a class="btn" href="/loans/personal-loan/">Personal Loan</a>
          <a class="btn" href="/loans/home-loan/">Home Loan</a>
          <a class="btn" href="/loans/business-loans/">Business Loan</a>
        </div>
        <div class="nf-links">
          <a class="link-card" href="/calculators/term-life-calculator/">Term Insurance Calculator →</a>
          <a class="link-card" href="/calculators/bmi-calculator/">BMI Calculator →</a>
          <a class="link-card" href="/component/services.php">Explore Services →</a>
        </div>
      </div>
    </div>
  </section>
  <?php include __DIR__.'/includes/footer.php'; ?>
</body>
</html>
