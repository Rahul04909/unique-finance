<?php
$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_PORT = getenv('DB_PORT') ?: '3306';
$DB_NAME = getenv('DB_NAME') ?: 'dendyal';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_CHARSET = getenv('DB_CHARSET') ?: 'utf8mb4';

function db_config(): array {
  return [
    'host' => getenv('DB_HOST') ?: (isset($GLOBALS['DB_HOST']) ? $GLOBALS['DB_HOST'] : '127.0.0.1'),
    'port' => getenv('DB_PORT') ?: (isset($GLOBALS['DB_PORT']) ? $GLOBALS['DB_PORT'] : '3306'),
    'name' => getenv('DB_NAME') ?: (isset($GLOBALS['DB_NAME']) ? $GLOBALS['DB_NAME'] : 'dendyal'),
    'user' => getenv('DB_USER') ?: (isset($GLOBALS['DB_USER']) ? $GLOBALS['DB_USER'] : 'root'),
    'pass' => getenv('DB_PASS') ?: (isset($GLOBALS['DB_PASS']) ? $GLOBALS['DB_PASS'] : ''),
    'charset' => getenv('DB_CHARSET') ?: (isset($GLOBALS['DB_CHARSET']) ? $GLOBALS['DB_CHARSET'] : 'utf8mb4'),
  ];
}

function db(): PDO {
  static $pdo = null;
  if ($pdo instanceof PDO) return $pdo;
  $c = db_config();
  $dsn = 'mysql:host='.$c['host'].';port='.$c['port'].';dbname='.$c['name'].';charset='.$c['charset'];
  $pdo = new PDO($dsn, $c['user'], $c['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);
  return $pdo;
}