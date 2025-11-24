<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'Term Life Insurance Calculator';
$seoBrand = 'Unique Finance Group';
$fullTitle = $seoTitle.' - '.$seoBrand;
$seoDescription = 'Estimate recommended term life cover, premium, and adequacy with our mobile‑responsive Term Life Insurance Calculator. Compute years to retirement, debts, savings, and get guidance.';
$ogImagePath = '/assets/img/hero/hero-banner-2.avif';
$ogImage = $origin . $ogImagePath;
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta name="theme-color" content="#0b46c1">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='12' fill='%230b46c1'/%3E%3Ccircle cx='32' cy='32' r='18' fill='%23ffffff'/%3E%3C/svg%3E">
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
  <link rel="stylesheet" href="../../assets/css/term-life-calculator.css">
  <script defer src="../../assets/js/term-life-calculator.js"></script>
  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $fullTitle,
    'url' => $canonical,
    'description' => $seoDescription
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name' => 'What is a Term Life Insurance Calculator?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'A tool that estimates suitable term life cover based on income, years to retirement, debts, and savings, and may offer premium guidance.' ]
      ],
      [
        '@type' => 'Question',
        'name' => 'How much term cover do I need?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'A common benchmark is 10–20× annual income, adjusted for liabilities and existing savings.' ]
      ],
      [
        '@type' => 'Question',
        'name' => 'Does age affect premium?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Yes, premiums generally increase with age and policy term. Healthy lifestyle and non‑smoker status can lower rates.' ]
      ]
    ]
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
</head>
<body>
  <?php include __DIR__.'/../../includes/header.php'; ?>
  <section class="tlc">
    <div class="tlc-container">
      <header class="tlc-head">
        <h1 class="tlc-title">Term Life Insurance Calculator</h1>
        <p class="tlc-sub">Estimate recommended cover and premium using income, years to retirement, debts, and savings.</p>
      </header>
      <div class="tlc-grid">
        <div class="tlc-form" aria-labelledby="tlc-calc-title">
          <div class="card">
            <div class="card-title" id="tlc-calc-title">Calculate Cover</div>
            <form id="tlcForm" novalidate>
              <div class="fields">
                <div class="field-group">
                  <label for="age">Age</label>
                  <input type="number" id="age" min="18" max="65" step="1" inputmode="numeric" placeholder="30">
                </div>
                <div class="field-group">
                  <label for="retireAge">Retirement age</label>
                  <input type="number" id="retireAge" min="40" max="75" step="1" inputmode="numeric" placeholder="60">
                </div>
                <div class="field-group">
                  <label for="income">Annual income (₹)</label>
                  <input type="number" id="income" min="50000" max="100000000" step="1000" inputmode="decimal" placeholder="800000">
                </div>
                <div class="field-group">
                  <label for="expenses">Monthly expenses (₹)</label>
                  <input type="number" id="expenses" min="1000" max="1000000" step="500" inputmode="decimal" placeholder="40000">
                </div>
                <div class="field-group">
                  <label for="loans">Outstanding loans (₹)</label>
                  <input type="number" id="loans" min="0" max="100000000" step="1000" inputmode="decimal" placeholder="1000000">
                </div>
                <div class="field-group">
                  <label for="savings">Existing savings (₹)</label>
                  <input type="number" id="savings" min="0" max="100000000" step="1000" inputmode="decimal" placeholder="300000">
                </div>
              </div>
              <button type="button" class="btn" id="tlcCalcBtn">Calculate</button>
            </form>
          </div>
        </div>
        <div class="tlc-result" aria-live="polite">
          <div class="card">
            <div class="card-title">Your Recommendation</div>
            <div class="result-top">
              <div class="result-main">
                <div class="result-value" id="sumAssured">₹0</div>
                <span class="result-badge badge-under" id="adequacyBadge">Low</span>
              </div>
              <div class="result-range">
                <div>Coverage range</div>
                <div class="range-values"><span id="rangeMinSa">—</span> – <span id="rangeMaxSa">—</span></div>
              </div>
            </div>
            <div class="gauge">
              <div class="indicator indicator-top" id="tlcNeedleTop"></div>
              <div class="gauge-track">
                <span class="seg seg1">Low</span>
                <span class="seg seg2">Adequate</span>
                <span class="seg seg3">High</span>
                <span class="seg seg4">Very High</span>
              </div>
              <div class="indicator indicator-bottom" id="tlcNeedleBottom"></div>
            </div>
            <div class="premium">
              <div>Estimated monthly premium</div>
              <div class="premium-value" id="premiumValue">₹0</div>
            </div>
            <div class="tips">
              <div class="tip">Choose a term that covers income until retirement.</div>
              <div class="tip">Account for liabilities and existing savings while finalizing cover.</div>
            </div>
          </div>
        </div>
      </div>
      <section class="tlc-intro">
        <h2>What is Term Life Insurance Calculator?</h2>
        <div class="intro-wrap">
          <p>A term life insurance calculator helps estimate an appropriate sum assured. This term life insurance calculator takes your annual income, years to retirement, outstanding loans, savings, and monthly expenses to suggest cover and premium guidance. Using a term life insurance calculator ensures you compare plans with a realistic benchmark.</p>
          <p>The term life insurance calculator is built for quick use and mobile responsiveness. With a few inputs, the term life insurance calculator delivers a recommended coverage range backed by common adequacy guidelines such as 10–20× annual income. The term life insurance calculator also provides a premium estimate based on age.</p>
          <p>Beyond numbers, this term life insurance calculator gives context through a visual gauge that indicates low, adequate, high, or very high coverage relative to income. Regularly using a term life insurance calculator can help you refine your protection level as your income, goals, or liabilities change.</p>
          <p>If you are planning a new policy or reviewing existing cover, a term life insurance calculator simplifies decision‑making. Try the term life insurance calculator to understand how much cover you might need and how it translates into an estimated monthly premium.</p>
        </div>
      </section>
      <section class="tlc-faq">
        <h2>Term Life Calculator FAQs</h2>
        <div class="faq-list">
          <details>
            <summary>How is recommended cover calculated?</summary>
            <div>The calculator uses a simplified method: income × years to retirement + outstanding loans − savings, then produces a suggested range.</div>
          </details>
          <details>
            <summary>What adequacy benchmarks are used?</summary>
            <div>Common guidelines suggest 10–20× annual income for many households, adjusted by liabilities and existing savings.</div>
          </details>
          <details>
            <summary>How is premium estimated?</summary>
            <div>An age‑based rate per ₹100,000 of cover is applied to provide an indicative monthly premium; actual quotes vary by insurer.</div>
          </details>
        </div>
      </section>
    </div>
  </section>
  <?php include __DIR__.'/../../includes/footer.php'; ?>
</body>
</html>