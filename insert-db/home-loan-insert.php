<?php
require_once __DIR__.'/../database/db-config.php';
$autoload = __DIR__.'/../vendor/autoload.php';
if (file_exists($autoload)) { require_once $autoload; }
$useMailer = class_exists('PHPMailer\PHPMailer\PHPMailer');
$pdo = db();
$redirect = '../loans/home-loan/index.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: '.$redirect);
  exit;
}
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$mobile = isset($_POST['mobile']) ? preg_replace('/[^0-9]/','', $_POST['mobile']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$employment = isset($_POST['employment']) ? trim($_POST['employment']) : '';
$income = isset($_POST['income']) ? floatval($_POST['income']) : 0.0;
$property_value = isset($_POST['property_value']) ? floatval($_POST['property_value']) : 0.0;
$loan_amount = isset($_POST['loan_amount']) ? floatval($_POST['loan_amount']) : 0.0;
$tenure_years = isset($_POST['tenure_years']) ? intval($_POST['tenure_years']) : 0;
if (!($name && $mobile && strlen($mobile) >= 10 && filter_var($email, FILTER_VALIDATE_EMAIL) && $city && $tenure_years > 0 && $loan_amount > 0)) {
  header('Location: '.$redirect.'?error='.urlencode('Please fill all required fields correctly.'));
  exit;
}
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
$stmt = $pdo->prepare("INSERT INTO home_loan_applications (name, mobile, email, city, employment, income, property_value, loan_amount, tenure_years) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->execute([$name,$mobile,$email,$city,$employment,$income,$property_value,$loan_amount,$tenure_years]);
if ($useMailer) {
  try {
    $row = $pdo->query('SELECT * FROM smtp_settings ORDER BY id ASC LIMIT 1')->fetch();
    if ($row && $row['host'] && (int)$row['port']>0 && $row['from_email']) {
      $mail = new PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = $row['host'];
      $mail->Port = (int)$row['port'];
      $mail->SMTPAuth = $row['username'] !== '';
      if ($mail->SMTPAuth) { $mail->Username = $row['username']; $mail->Password = $row['password']; }
      if ($row['encryption'] !== 'none') { $mail->SMTPSecure = $row['encryption']; }
      $mail->setFrom($row['from_email'], $row['from_name'] ?: 'Admin');
      if (!empty($row['reply_to'])) { $mail->addReplyTo($row['reply_to']); }
      $mail->addAddress($email, $name ?: $email);
      $mail->Subject = 'Home Loan Application Received';
      $mail->isHTML(true);
      $mail->Body = '<div style="font-family:Segoe UI,Roboto,Arial,sans-serif;color:#0f172a"><h2>Thank you for applying</h2><p>Hi '.htmlspecialchars($name,ENT_QUOTES).',</p><p>We have received your home loan application.</p><ul><li>City: '.htmlspecialchars($city,ENT_QUOTES).'</li><li>Employment: '.htmlspecialchars($employment,ENT_QUOTES).'</li><li>Loan amount: ₹'.number_format((float)$loan_amount,2).'</li><li>Tenure: '.(int)$tenure_years.' years</li></ul><p>Our team will contact you shortly.</p><p>Regards,<br>'.htmlspecialchars($row['from_name'] ?: 'Admin',ENT_QUOTES).'</p></div>';
      $mail->AltBody = 'Thank you for applying. We have received your home loan application.';
      $mail->send();
    }
  } catch (Throwable $e) {
  }
}
header('Location: '.$redirect.'?success=1');
exit;