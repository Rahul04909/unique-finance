<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: ../login.php'); exit; }
require_once __DIR__.'/../../vendor/autoload.php';
use samdark\sitemap\Sitemap;
use samdark\sitemap\Index;
use samdark\sitemap\TempFileGZIPWriter;
use samdark\sitemap\PlainFileWriter;
$root = dirname(__DIR__, 2);
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$baseUrl = $scheme.'://'.$host;
$message = null; $error = null; $log = [];
function addUrl($sitemap, $url, $path, $freq='weekly', $prio=0.7){
  $last = file_exists($path) ? filemtime($path) : time();
  $sitemap->addItem($url, $last, $freq, $prio);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $baseUrl = trim($_POST['base_url'] ?? $baseUrl);
  if ($baseUrl === '') { $error = 'Base URL required'; }
  if (!$error) {
    try {
      $indexPath = $root.'/sitemap-index.xml';
      $mapGzPath = $root.'/sitemap-1.xml.gz';
      $mapXmlPath = $root.'/sitemap-1.xml';
      $useGzip = function_exists('gzopen');
      $writer = $useGzip ? new TempFileGZIPWriter($mapGzPath) : new PlainFileWriter($mapXmlPath);
      $sitemap = new Sitemap($writer);
      $urls = [];
      $home = $root.'/index.php';
      $urls[] = ['url' => $baseUrl.'/', 'path' => $home, 'freq' => 'daily', 'prio' => 1.0];
      foreach (glob($root.'/loans/*/index.php') as $p) {
        $rel = str_replace($root, '', $p);
        $slug = str_replace(['\\'], ['/' ], $rel);
        $dir = substr($slug, 0, strrpos($slug, '/'));
        $urls[] = ['url' => $baseUrl.$dir.'/', 'path' => $p, 'freq' => 'weekly', 'prio' => 0.8];
      }
      foreach (glob($root.'/calculators/*/index.php') as $p) {
        $rel = str_replace($root, '', $p);
        $slug = str_replace(['\\'], ['/' ], $rel);
        $dir = substr($slug, 0, strrpos($slug, '/'));
        $urls[] = ['url' => $baseUrl.$dir.'/', 'path' => $p, 'freq' => 'weekly', 'prio' => 0.7];
      }
      foreach ($urls as $u) { addUrl($sitemap, $u['url'], $u['path'], $u['freq'], $u['prio']); $log[] = $u['url']; }
      $sitemap->write();
      $index = new Index($indexPath);
      $index->addSitemap($baseUrl.'/sitemap-1.xml'.($useGzip?'.gz':''), time());
      $index->write();
      $robots = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /vendor/\nDisallow: /database/\nDisallow: /insert-db/\nDisallow: /component/\nDisallow: /includes/\nSitemap: ".$baseUrl."/sitemap-index.xml\nSitemap: ".$baseUrl."/sitemap-1.xml".($useGzip?".gz":"")."\n";
      file_put_contents($root.'/robots.txt', $robots);
      $ht = [];
      $ht[] = 'Options -Indexes';
      $ht[] = 'Options -MultiViews';
      $ht[] = 'DirectoryIndex index.php';
      $ht[] = 'RewriteEngine On';
      $ht[] = 'RewriteBase /';
      $ht[] = 'RewriteRule ^sitemap\.xml$ sitemap-index.xml [L]';
      $ht[] = 'RewriteRule ^robots\.txt$ robots.txt [L]';
      $ht[] = 'RewriteCond %{REQUEST_FILENAME} !-d';
      $ht[] = 'RewriteCond %{REQUEST_FILENAME} !-f';
      $ht[] = 'RewriteCond %{REQUEST_FILENAME}.php -f';
      $ht[] = 'RewriteRule ^(.+)$ $1.php [L,QSA]';
      file_put_contents($root.'/.htaccess', implode("\n", $ht));
      $message = 'Sitemap generated';
    } catch (Throwable $e) { $error = 'Generation failed: '.htmlspecialchars($e->getMessage(), ENT_QUOTES); }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sitemap Generator</title>
  <style>
    :root{--bg:#f6f8fc;--text:#0f172a;--muted:#64748b;--border:#e5e7eb;--card:#ffffff;--primary:#2563eb;--sidebar-width:264px}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;background:var(--bg);color:var(--text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .admin-sidebar + .admin-content{margin-left:var(--sidebar-width)}
    .admin-content{min-height:100vh;display:flex;flex-direction:column}
    .topbar{position:sticky;top:0;z-index:900;background:#ffffff;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:12px 18px}
    .title{font-weight:900}
    .wrapper{padding:18px}
    .card{background:#ffffff;border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.08);padding:16px}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .field{display:flex;flex-direction:column;gap:6px}
    .input{padding:10px 12px;border:1px solid var(--border);border-radius:12px;font-weight:700}
    .btn{padding:12px;border-radius:12px;border:1px solid var(--border);background:#2563eb;color:#fff;font-weight:800}
    .msg{margin:12px 0;padding:10px;border-radius:12px}
    .msg.success{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.25);color:#16a34a}
    .msg.error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444}
    .list{list-style:none;margin:0;padding:0;display:grid;grid-template-columns:1fr 1fr;gap:6px}
    @media(max-width:960px){.grid{grid-template-columns:1fr}.list{grid-template-columns:1fr}}
  </style>
  <meta name="robots" content="noindex, nofollow">
  <link rel="canonical" href="/admin/seo/sitemap-generator.php">
</head>
<body>
  <?php include __DIR__.'/../sidebar.php'; ?>
  <main class="admin-content">
    <div class="topbar"><div class="title">Sitemap Generator</div><div style="color:var(--muted);font-weight:700">samdark/sitemap</div></div>
    <div class="wrapper">
      <div class="card">
        <?php if($message){ echo '<div class="msg success">'.htmlspecialchars($message,ENT_QUOTES).'</div>'; } ?>
        <?php if($error){ echo '<div class="msg error">'.htmlspecialchars($error,ENT_QUOTES).'</div>'; } ?>
        <form method="post" class="grid">
          <div class="field"><label>Base URL</label><input class="input" type="url" name="base_url" value="<?php echo htmlspecialchars($baseUrl,ENT_QUOTES); ?>" placeholder="https://example.com" required></div>
          <div class="field"><label>&nbsp;</label><button class="btn" type="submit">Generate Sitemap</button></div>
        </form>
        <?php if($message && $log){ echo '<h3 style="margin-top:12px">Included URLs</h3><ul class="list">'; foreach($log as $u){ echo '<li class="card" style="padding:10px">'.htmlspecialchars($u,ENT_QUOTES).'</li>'; } echo '</ul>'; } ?>
        <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap">
          <a class="btn" href="/sitemap-index.xml" target="_blank">View sitemap-index.xml</a>
          <a class="btn" href="/sitemap-1.xml.gz" target="_blank">Download sitemap-1.xml.gz</a>
          <a class="btn" href="/robots.txt" target="_blank">View robots.txt</a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
