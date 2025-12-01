<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: ../login.php'); exit; }
require_once __DIR__.'/../../database/db-config.php';
require_once __DIR__.'/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$pdo = db();
$pdo->exec("CREATE TABLE IF NOT EXISTS smtp_settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  host VARCHAR(190) NOT NULL DEFAULT '',
  port INT UNSIGNED NOT NULL DEFAULT 0,
  encryption VARCHAR(10) NOT NULL DEFAULT 'none',
  username VARCHAR(190) NOT NULL DEFAULT '',
  password VARCHAR(255) NOT NULL DEFAULT '',
  from_email VARCHAR(190) NOT NULL DEFAULT '',
  from_name VARCHAR(190) NOT NULL DEFAULT '',
  reply_to VARCHAR(190) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$row = $pdo->query('SELECT * FROM smtp_settings ORDER BY id ASC LIMIT 1')->fetch();
if (!$row) {
  $ins = $pdo->prepare('INSERT INTO smtp_settings (host,port,encryption,username,password,from_email,from_name) VALUES (?,?,?,?,?,?,?)');
  $ins->execute(['',0,'none','','','','']);
  $row = $pdo->query('SELECT * FROM smtp_settings ORDER BY id ASC LIMIT 1')->fetch();
}
$message = null; $error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? 'save';
  if ($action === 'save') {
    $host = trim($_POST['host'] ?? '');
    $port = (int)($_POST['port'] ?? 0);
    $enc = in_array($_POST['encryption'] ?? 'none', ['none','ssl','tls']) ? $_POST['encryption'] : 'none';
    $user = trim($_POST['username'] ?? '');
    $pwd = $_POST['password'] ?? '';
    $from_email = trim($_POST['from_email'] ?? '');
    $from_name = trim($_POST['from_name'] ?? '');
    $reply_to = trim($_POST['reply_to'] ?? '');
    if ($host && $port && $from_email) {
      if ($pwd === '') { $pwd = $row['password']; }
      $upd = $pdo->prepare('UPDATE smtp_settings SET host=?, port=?, encryption=?, username=?, password=?, from_email=?, from_name=?, reply_to=? WHERE id=?');
      $upd->execute([$host,$port,$enc,$user,$pwd,$from_email,$from_name,$reply_to,$row['id']]);
      $message = 'Settings saved';
      $row = $pdo->query('SELECT * FROM smtp_settings ORDER BY id ASC LIMIT 1')->fetch();
    } else {
      $error = 'Host, Port and From Email are required';
    }
  } elseif ($action === 'test') {
    $to = trim($_POST['test_email'] ?? '');
    if ($to) {
      try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $row['host'];
        $mail->Port = (int)$row['port'];
        $mail->SMTPAuth = $row['username'] !== '';
        if ($mail->SMTPAuth) { $mail->Username = $row['username']; $mail->Password = $row['password']; }
        if ($row['encryption'] !== 'none') { $mail->SMTPSecure = $row['encryption']; }
        $mail->setFrom($row['from_email'] ?: 'no-reply@localhost', $row['from_name'] ?: 'Admin');
        if (!empty($row['reply_to'])) { $mail->addReplyTo($row['reply_to']); }
        $mail->addAddress($to);
        $mail->Subject = 'SMTP Test';
        $mail->Body = 'SMTP configuration test successful.';
        $mail->send();
        $message = 'Test email sent to '.$to;
      } catch (Exception $e) {
        $error = 'Failed to send: '.$mail->ErrorInfo;
      }
    } else {
      $error = 'Enter a test email';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMTP Settings</title>
  <style>
    :root{--bg:#f6f8fc;--text:#0f172a;--muted:#64748b;--border:#e5e7eb;--card:#ffffff;--primary:#2563eb;--sidebar-width:264px}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;background:var(--bg);color:var(--text);font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
    .admin-sidebar + .admin-content{margin-left:var(--sidebar-width)}
    .admin-sidebar ~ .admin-content{margin-left:var(--sidebar-width)}
    .admin-content{min-height:100vh;display:flex;flex-direction:column}
    .topbar{position:sticky;top:0;z-index:900;background:#ffffff;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:12px 18px}
    .title{font-weight:900}
    .wrapper{padding:18px}
    .grid{display:grid;grid-template-columns:2fr 1fr;gap:16px}
    .card{background:#ffffff;border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.08);padding:16px}
    .section-title{font-weight:800;margin-bottom:12px}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .field{margin-bottom:12px}
    .label{display:block;font-size:12px;font-weight:800;color:var(--muted);margin-bottom:6px}
    .input,.select{width:100%;padding:12px 14px;border-radius:12px;border:1px solid var(--border);background:#fff;color:var(--text);font-weight:600}
    .note{font-size:12px;color:var(--muted);margin-top:6px}
    .actions{display:flex;gap:10px;margin-top:10px}
    .btn{padding:10px 12px;border-radius:12px;border:1px solid var(--border);background:#ffffff;color:var(--text);font-weight:800}
    .btn.primary{background:rgba(37,99,235,.08);border-color:rgba(37,99,235,.2);color:#2563eb}
    .msg{margin:12px 0;padding:10px;border-radius:12px}
    .msg.success{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.25);color:#16a34a}
    .msg.error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444}
    @media(max-width:960px){.grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <?php include __DIR__.'/../sidebar.php'; ?>
  <main class="admin-content">
    <div class="topbar"><div class="title">SMTP Settings</div><div style="color:var(--muted);font-weight:700">Last updated: <?php echo htmlspecialchars($row['updated_at'],ENT_QUOTES); ?></div></div>
    <div class="wrapper">
      <?php if($message){ echo '<div class="msg success">'.htmlspecialchars($message,ENT_QUOTES).'</div>'; } ?>
      <?php if($error){ echo '<div class="msg error">'.htmlspecialchars($error,ENT_QUOTES).'</div>'; } ?>
      <div class="grid">
        <div class="card">
          <div class="section-title">Configuration</div>
          <form action="" method="post">
            <input type="hidden" name="action" value="save">
            <div class="row">
              <div class="field"><label class="label" for="host">SMTP Host</label><input class="input" id="host" name="host" type="text" value="<?php echo htmlspecialchars($row['host'],ENT_QUOTES); ?>" required></div>
              <div class="field"><label class="label" for="port">SMTP Port</label><input class="input" id="port" name="port" type="number" value="<?php echo htmlspecialchars($row['port'],ENT_QUOTES); ?>" required></div>
            </div>
            <div class="row">
              <div class="field"><label class="label" for="encryption">Encryption</label><select class="select" id="encryption" name="encryption"><option value="none" <?php echo $row['encryption']==='none'?'selected':''; ?>>None</option><option value="ssl" <?php echo $row['encryption']==='ssl'?'selected':''; ?>>SSL</option><option value="tls" <?php echo $row['encryption']==='tls'?'selected':''; ?>>TLS</option></select></div>
              <div class="field"><label class="label" for="username">Username</label><input class="input" id="username" name="username" type="text" value="<?php echo htmlspecialchars($row['username'],ENT_QUOTES); ?>"></div>
            </div>
            <div class="row">
              <div class="field"><label class="label" for="password">Password</label><input class="input" id="password" name="password" type="password" placeholder="Enter new password"></div>
              <div class="field"><label class="label" for="reply_to">Reply-To</label><input class="input" id="reply_to" name="reply_to" type="email" value="<?php echo htmlspecialchars($row['reply_to']??'',ENT_QUOTES); ?>"></div>
            </div>
            <div class="row">
              <div class="field"><label class="label" for="from_name">From Name</label><input class="input" id="from_name" name="from_name" type="text" value="<?php echo htmlspecialchars($row['from_name'],ENT_QUOTES); ?>"></div>
              <div class="field"><label class="label" for="from_email">From Email</label><input class="input" id="from_email" name="from_email" type="email" value="<?php echo htmlspecialchars($row['from_email'],ENT_QUOTES); ?>" required></div>
            </div>
            <div class="note">Leave password blank to keep existing.</div>
            <div class="actions"><button class="btn primary" type="submit">Save Settings</button></div>
          </form>
        </div>
        <div class="card">
          <div class="section-title">Send Test Email</div>
          <form action="" method="post">
            <input type="hidden" name="action" value="test">
            <div class="field"><label class="label" for="test_email">Recipient Email</label><input class="input" id="test_email" name="test_email" type="email" placeholder="name@example.com" required></div>
            <div class="actions"><button class="btn primary" type="submit">Send Test</button></div>
          </form>
          <div class="note">Uses current saved configuration.</div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>