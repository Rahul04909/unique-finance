<?php
require_once __DIR__.'/../database/db-config.php';
$pdo=db();
$pdo->exec("CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(64) NOT NULL UNIQUE,
  email VARCHAR(190) NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$username='admin';
$email='admin@example.com';
$password='Admin@123';
$exists=$pdo->prepare('SELECT id FROM admins WHERE username=?');
$exists->execute([$username]);
if(!$exists->fetch()){
  $ins=$pdo->prepare('INSERT INTO admins (username,email,password_hash) VALUES (?,?,?)');
  $ins->execute([$username,$email,password_hash($password, PASSWORD_DEFAULT)]);
  echo 'Inserted default admin. Username: admin, Password: Admin@123';
} else {
  echo 'Admin already exists. Username: admin';
}