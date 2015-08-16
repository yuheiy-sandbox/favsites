<?php

require_once 'Def.php';
define('ADMIN_PASSWORD', '');

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function getPageTitle($url) {
  static $ch;
  if (!$ch) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  }
  curl_setopt($ch, CURLOPT_URL, $url);
  $html = curl_exec($ch);
  $dom = new DOMDocument();
  @$dom->loadHTML($html);
  $xpath = new DOMXPath($dom);
  return $xpath->query('head/title')->item(0)->nodeValue;
}

function getThumbUrl($url) {
  return 'http://s.wordpress.com/mshots/v1/' . urlencode($url) . '?w=320';
}

try {
  $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['send'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
      $url = $_POST['url'];
      $title = getPageTitle($url);
      $thumb_url = getThumbUrl($url);

      $stmt = $pdo->prepare('INSERT INTO websites (title, url, thumb_url) VALUES (?, ?, ?)');
      $stmt->bindValue(1, $title, PDO::PARAM_STR);
      $stmt->bindValue(2, $url, PDO::PARAM_STR);
      $stmt->bindValue(3, $thumb_url, PDO::PARAM_STR);
      $stmt->execute();

      session_start();
      $_SESSION['status'] = 'done';
    } else {
      session_start();
      $_SESSION['status'] = 'fail';
    }
  }
  header('Location: admin.php');

} catch (PDOException $e) {
  echo $e->getMessage();
}
