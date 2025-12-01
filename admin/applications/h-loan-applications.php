<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: ../login.php'); exit; }
require_once __DIR__.'/../../database/db-config.php';
$pdo = db();
$pdo->exec("CREATE TABLE IF NOT EXISTS home_loan_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  mobile VARCHAR(20),
  email VARCHAR(150),
  city VARCHAR(150),
  employment VARCHAR(50),
  income DECIMAL(12,2),
  property_value DECIMAL(12,2),
  loan_amount DECIMAL(12,2),
  tenure_years INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$message = null; $error = null; $detail = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';
  if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
      try { $stmt=$pdo->prepare('DELETE FROM home_loan_applications WHERE id=?'); $stmt->execute([$id]); $message = 'Deleted #'.$id; } catch (Throwable $e) { $error = 'Delete failed'; }
    }
  }
}
$q = trim($_GET['q'] ?? '');
if (isset($_GET['view'])) {
  $vid = (int)$_GET['view'];
  if ($vid > 0) { $st=$pdo->prepare('SELECT * FROM home_loan_applications WHERE id=?'); $st->execute([$vid]); $detail=$st->fetch(); }
}
if ($q !== '') {
  $stmt = $pdo->prepare("SELECT * FROM home_loan_applications WHERE name LIKE ? OR mobile LIKE ? OR email LIKE ? OR city LIKE ? ORDER BY created_at DESC, id DESC");
  $like = '%'.$q.'%';
  $stmt->execute([$like,$like,$like,$like]);
  $rows = $stmt->fetchAll();
} else {
  $rows = $pdo->query('SELECT * FROM home_loan_applications ORDER BY created_at DESC, id DESC')->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Loan Applications</title>
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
    .card{background:#ffffff;border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.08);padding:16px}
    .search{display:flex;gap:8px;margin-bottom:12px}
    .input{flex:1;padding:10px 12px;border:1px solid var(--border);border-radius:12px;background:#fff;color:var(--text);font-weight:600}
    .btn{padding:10px 12px;border-radius:12px;border:1px solid var(--border);background:#fff;color:var(--text);font-weight:800}
    .btn.view{color:#2563eb;border-color:rgba(37,99,235,.25);background:rgba(37,99,235,.06)}
    .btn.del{color:#ef4444;border-color:rgba(239,68,68,.25);background:rgba(239,68,68,.06)}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border-bottom:1px solid var(--border);text-align:left}
    th{color:var(--muted)}
    .mono{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;color:#334155}
    .msg{margin:12px 0;padding:10px;border-radius:12px}
    .msg.success{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.25);color:#16a34a}
    .msg.error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444}
    .modal-backdrop{position:fixed;left:0;top:0;right:0;bottom:0;background:rgba(2,6,23,.5);display:flex;align-items:center;justify-content:center;z-index:2000}
    .modal{background:#ffffff;border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(2,6,23,.18);width:96%;max-width:720px;padding:16px}
    .modal-title{font-weight:900;margin-bottom:10px}
    .modal-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .field{padding:8px;border:1px solid var(--border);border-radius:10px}
    .label{font-size:12px;color:var(--muted);font-weight:800;margin-bottom:6px}
    .val{font-weight:800}
    @media(max-width:960px){.table-wrap{overflow:auto}}
  </style>
</head>
<body>
  <?php include __DIR__.'/../sidebar.php'; ?>
  <main class="admin-content">
    <div class="topbar"><div class="title">Home Loan Applications</div><div style="color:var(--muted);font-weight:700">Total: <?php echo count($rows); ?></div></div>
    <div class="wrapper">
      <div class="card">
        <form class="search" method="get">
          <input class="input" type="search" name="q" value="<?php echo htmlspecialchars($q,ENT_QUOTES); ?>" placeholder="Search name, mobile, email, city">
          <button class="btn" type="submit">Search</button>
        </form>
        <?php if($message){ echo '<div class="msg success">'.htmlspecialchars($message,ENT_QUOTES).'</div>'; } ?>
        <?php if($error){ echo '<div class="msg error">'.htmlspecialchars($error,ENT_QUOTES).'</div>'; } ?>
        <div class="table-wrap">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Created</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $r): ?>
              <tr>
                <td class="mono">#<?php echo (int)$r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['created_at'],ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($r['name'],ENT_QUOTES); ?></td>
                <td class="mono"><?php echo htmlspecialchars($r['mobile'],ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($r['city'],ENT_QUOTES); ?></td>
                <td>
                  <a class="btn view" href="?<?php echo ($q!==''?'q='.urlencode($q).'&':''); ?>view=<?php echo (int)$r['id']; ?>">View</a>
                  <form style="display:inline" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
                    <button class="btn del" type="submit" onclick="return confirm('Delete this application?')">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php if($detail): ?>
  <div class="modal-backdrop">
    <div class="modal">
      <div class="modal-title">Application #<?php echo (int)$detail['id']; ?></div>
      <div class="modal-grid">
        <div class="field"><div class="label">Created</div><div class="val"><?php echo htmlspecialchars($detail['created_at'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">Name</div><div class="val"><?php echo htmlspecialchars($detail['name'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">Mobile</div><div class="val mono"><?php echo htmlspecialchars($detail['mobile'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">Email</div><div class="val"><?php echo htmlspecialchars($detail['email'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">City</div><div class="val"><?php echo htmlspecialchars($detail['city'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">Employment</div><div class="val"><?php echo htmlspecialchars($detail['employment'],ENT_QUOTES); ?></div></div>
        <div class="field"><div class="label">Monthly income</div><div class="val mono">₹<?php echo number_format((float)$detail['income'],2); ?></div></div>
        <div class="field"><div class="label">Property value</div><div class="val mono">₹<?php echo number_format((float)$detail['property_value'],2); ?></div></div>
        <div class="field"><div class="label">Loan amount</div><div class="val mono">₹<?php echo number_format((float)$detail['loan_amount'],2); ?></div></div>
        <div class="field"><div class="label">Tenure</div><div class="val mono"><?php echo (int)$detail['tenure_years']; ?> yrs</div></div>
      </div>
      <div style="margin-top:12px;display:flex;gap:8px;justify-content:flex-end">
        <a class="btn" href="h-loan-applications.php<?php echo $q!==''?'?q='.urlencode($q):''; ?>">Close</a>
      </div>
    </div>
  </div>
  <?php endif; ?>
</body>
</html>