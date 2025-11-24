<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'Unique Finance Group';
$seoDescription = 'Compare and choose insurance and financial services with Unique Finance Group. Explore health and term insurance, loans, calculators, and trusted brands — fast and hassle-free.';
$ogImagePath = '/assets/img/hero/personal-loan-upto-50-lakhs.png';
$ogImage = $origin . $ogImagePath;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($seoTitle, ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta name="theme-color" content="#0b46c1">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='12' fill='%230b46c1'/%3E%3Ccircle cx='32' cy='32' r='18' fill='%23ffffff'/%3E%3C/svg%3E">
  <meta property="og:title" content="<?php echo htmlspecialchars($seoTitle, ENT_QUOTES); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($seoTitle, ENT_QUOTES); ?>">
  <meta property="og:locale" content="en_US">
  <meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
  <meta property="og:image:alt" content="<?php echo htmlspecialchars($seoTitle, ENT_QUOTES); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($seoTitle, ENT_QUOTES); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $seoTitle,
    'url' => $canonical,
    'potentialAction' => [
      '@type' => 'SearchAction',
      'target' => $canonical . '?s={search_term_string}',
      'query-input' => 'required name=search_term_string'
    ]
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
  <script type="application/ld+json">
  <?php echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $seoTitle,
    'url' => $canonical
  ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
</head>
<body>
  <?php include __DIR__.'/includes/header.php'; ?>
  <?php include __DIR__.'/component/hero.php'; ?>
  <?php include __DIR__.'/component/services.php'; ?>
  <?php include __DIR__.'/component/services2.php'; ?>
  <?php include __DIR__.'/component/calculators.php'; ?>
  <?php include __DIR__.'/component/brands.php'; ?>
  <?php include __DIR__.'/includes/footer.php'; ?>
</body>
</html>