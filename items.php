<?php

require_once 'Def.php';
define('MAX_NUM', 24);

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

try {
  $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('SELECT * FROM websites ORDER BY `id` DESC LIMIT ?, ?');
  $stmt->execute([($page - 1) * MAX_NUM, MAX_NUM]);
  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $item_count = $pdo->query('SELECT COUNT(*) FROM websites')->fetchColumn();
  $page_count = ceil($item_count / MAX_NUM);

  echo json_encode(['items' => $items, 'page_count' => $page_count]);
  header('Content-Type: application/json');

} catch (PDOException $e) {
  echo $e->getMessage();
}
