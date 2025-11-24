<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'BMI Calculator';
$seoBrand = 'Unique Finance Group';
$fullTitle = $seoTitle.' - '.$seoBrand;
$seoDescription = 'Calculate your Body Mass Index (BMI) instantly. Get category, healthy weight range, and tips. Mobile responsive and accurate BMI calculator.';
$ogImagePath = '/assets/img/hero/hero-banner-3.avif';
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
  <link rel="stylesheet" href="../../assets/css/bmi-calculator.css">
  <script defer src="../../assets/js/bmi-calculator.js"></script>
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
        'name' => 'What is BMI?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'BMI is Body Mass Index: weight divided by height squared, used to categorize underweight, normal, overweight, and obesity.' ]
      ],
      [
        '@type' => 'Question',
        'name' => 'How do I calculate BMI?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Metric: kg / (m²). Imperial: (lbs × 703) / (in²).' ]
      ],
      [
        '@type' => 'Question',
        'name' => 'What are BMI ranges?',
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Underweight < 18.5, Normal 18.5–24.9, Overweight 25–29.9, Obesity ≥ 30.' ]
      ]
    ]
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
</head>
<body>
  <?php include __DIR__.'/../../includes/header.php'; ?>
  <section class="bmi">
    <div class="bmi-container">
      <header class="bmi-head">
        <h1 class="bmi-title">BMI Calculator</h1>
        <p class="bmi-sub">Check your Body Mass Index and healthy weight range using metric or imperial units.</p>
      </header>
      <div class="bmi-grid">
        <div class="bmi-form" aria-labelledby="calc-title">
          <div class="card">
            <div class="card-title" id="calc-title">Calculate BMI</div>
            <form id="bmiForm" novalidate>
              <div class="unit-toggle" role="radiogroup" aria-label="Units">
                <label class="unit-btn"><input type="radio" name="unit" value="metric" checked><span>Metric</span></label>
                <label class="unit-btn"><input type="radio" name="unit" value="imperial"><span>Imperial</span></label>
              </div>
              <div class="fields">
                <div class="field-group metric">
                  <label for="heightCm">Height (cm)</label>
                  <input type="number" id="heightCm" min="50" max="250" step="0.1" inputmode="decimal" placeholder="170">
                </div>
                <div class="field-group metric">
                  <label for="weightKg">Weight (kg)</label>
                  <input type="number" id="weightKg" min="10" max="300" step="0.1" inputmode="decimal" placeholder="65">
                </div>
                <div class="field-group imperial">
                  <label for="heightFt">Height (ft)</label>
                  <input type="number" id="heightFt" min="2" max="8" step="1" inputmode="numeric" placeholder="5">
                </div>
                <div class="field-group imperial">
                  <label for="heightIn">Height (in)</label>
                  <input type="number" id="heightIn" min="0" max="11" step="1" inputmode="numeric" placeholder="7">
                </div>
                <div class="field-group imperial">
                  <label for="weightLb">Weight (lb)</label>
                  <input type="number" id="weightLb" min="20" max="660" step="0.1" inputmode="decimal" placeholder="143">
                </div>
              </div>
              <button type="button" class="btn" id="calcBtn">Calculate</button>
            </form>
          </div>
        </div>
        <div class="bmi-result" aria-live="polite">
          <div class="card">
            <div class="card-title">Your Result</div>
            <div class="result-top">
              <div class="result-main">
                <div class="result-value" id="bmiValue">0.0</div>
                <span class="result-badge badge-under" id="bmiBadge">Underweight</span>
              </div>
              <div class="result-range">
                <div>Healthy weight range</div>
                <div class="range-values"><span id="rangeMin">—</span> – <span id="rangeMax">—</span></div>
              </div>
            </div>
            <div class="gauge">
              <div class="indicator indicator-top" id="needleTop"></div>
              <div class="gauge-track">
                <span class="seg seg1">Under</span>
                <span class="seg seg2">Normal</span>
                <span class="seg seg3">Over</span>
                <span class="seg seg4">Obese</span>
              </div>
              <div class="indicator indicator-bottom" id="needleBottom"></div>
            </div>
            <div class="tips">
              <div class="tip">Maintain a balanced diet rich in whole foods.</div>
              <div class="tip">Aim for regular physical activity and adequate sleep.</div>
            </div>
          </div>
        </div>
      </div>
      <section class="bmi-intro">
        <h2>What is BMI Calculator?</h2>
        <div class="intro-wrap">
          <p>The BMI calculator is a simple and essential health tool that estimates your Body Mass Index using height and weight. A BMI calculator helps you quickly understand whether you fall under underweight, normal weight, overweight, or obesity categories. Using a BMI calculator regularly supports better lifestyle decisions and keeps your health goals on track.</p>
          <p>Our BMI calculator supports both metric and imperial units, making it easy for anyone to compute results accurately. By entering basic details, the BMI calculator provides your score, category, and healthy weight range. You can use this BMI calculator to compare progress over time and stay aligned with recommended ranges.</p>
          <p>Beyond just a number, the BMI calculator offers context and guidance. With a clear gauge and category indicator, the BMI calculator helps you visualize where you stand. Use the BMI calculator to assess current goals, adjust diet and activity, and discuss results with a professional if needed.</p>
          <p>For everyday health tracking, a BMI calculator is fast, reliable, and informative. Whether you are starting a new routine or maintaining fitness, the BMI calculator empowers you with actionable insights. Try the BMI calculator now to make informed choices and move towards a healthier lifestyle.</p>
        </div>
      </section>
      <section class="bmi-faq">
        <h2>BMI Frequently Asked Questions</h2>
        <div class="faq-list">
          <details>
            <summary>What is BMI?</summary>
            <div>BMI stands for Body Mass Index. It helps assess weight category using height and weight.</div>
          </details>
          <details>
            <summary>How is BMI calculated?</summary>
            <div>Metric: BMI = kg / (m²). Imperial: BMI = (lb × 703) / (in²).</div>
          </details>
          <details>
            <summary>What are the BMI categories?</summary>
            <div>Underweight &lt; 18.5, Normal 18.5–24.9, Overweight 25–29.9, Obesity ≥ 30.</div>
          </details>
        </div>
      </section>
    </div>
  </section>
  <?php include __DIR__.'/../../includes/footer.php'; ?>
</body>
</html>