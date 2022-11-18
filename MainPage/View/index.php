<?php
session_start();
if (!empty($_SESSION['user']) && !empty($_SESSION['pass']) && !empty($_SESSION['id'])){
  $u = $_SESSION['user'];
  $p = $_SESSION['pass'];
  $id = $_SESSION['id'];
  setcookie($u, $p, time() + 3600); // secret cookie for demo
}
// if (isset($_POST['name2']) && !empty($_POST['name2'])) {
//   $name2 = $_POST['name2'];
// } 
// if (isset($_POST['name']) && !empty($_POST['name'])) {
//   $name = $_POST['name'];
//   setcookie('name', $name, 0);
// } else {
//   $name = isset($_COOKIE['name']) ? $_COOKIE['name'] : '';
// }
// $html = "";

if ($_SERVER['form'] == "POST") {
    if (!isset ($_SESSION['user'])) {
        $_SESSION['user'] = 'null';
    }
    // $_SESSION['user']++;
    $cookie_value = $_SESSION['user'];
    setcookie("dvwaSession", $cookie_value);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Hip Hip">
  <meta name="copyright" content="PBL4">
  <meta name="description" content="A simple web application to test about Cross-Site Scripting (XSS)">
  <title>Web Test PBL4</title>
  <link href="https://nguyenhung0312.github.io/Hip/asset/css/img/Hip_Hip-removebg-preview.png" rel="icon" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
  <script>
    function RS() {
      document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
  </script>
</head>

<body>
  <header>
    <a href="./" class="logo">XSS Me</a>
    <a href="./" class="button">Home</a>
    <a href="./?page=About" class="button">About</a>
    <a href="./#name=Hung" class="button">DOM-based XSS</a>
    <a href="../" class="button" style="float: right;" onclick="RS()">
      Log Out
    </a>

    <div id="scrollLock">
      <input class="disableScrollLock btn btn-success" type="button" value="Disable Scroll Lock" />
      <input class="enableScrollLock btn btn-warning" style="display: none;" type="button" value="Enable Scroll Lock" />
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumbs">
          <li><a href="MainPage.php">Home</a></li>
          <?php if (isset($_GET['page']) && !empty($_GET['page'])) : ?><li><?php echo $_GET['page']; ?></li><?php endif; ?>
        </ul>
        <?php if (isset($_GET['page']) && strtolower($_GET['page']) === 'about') : ?>
          <p>Web tạo ra nhằm thực hiện và khắc phục lỗ hổng XSS.</p>
        <?php else : ?>

          <!-- //form gửi submit -->
          <form action="MainPage.php" method="post" accept-charset="utf-8" id="form" style="display: flex; flex-direction: column;">
            Tên bạn là: <input type="text" name="name" class="t1" style="width:240px ;flex: 1;" value="<?php if (!empty($name)) {
                                                                            echo $name;
                                                                          } ?>" placeholder="John Doe..." autofocus required>
            Binh luan: <input type="text" name="name2" class="t2" style="width:240px ; flex: 1;" value="" placeholder="Binh Luan.." required>
            <button type="submit" class="primary" style="width: 80px;">Submit!</button>
          </form>
          <!-- //form gửi submit -->

        <?php endif; ?>
        <!-- <img src="smiley.gif" alt="Smiley face" width="42" height="42" style="vertical-align:middle"> -->
        <div>
          <center><img src="https://scontent.fdad1-4.fna.fbcdn.net/v/t1.15752-9/301701055_465250165461896_4261023679521712020_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=ae9488&_nc_ohc=pKdUf_hBI7kAX9uH-1r&_nc_ht=scontent.fdad1-4.fna&oh=03_AdR_4E5suBxNEuqClaXkiVKcTrCUURdfJ9gd7IoMFn5RWA&oe=638CA889" alt="Đề bài" width="500" height="500" style="vertical-align:middle; align-items: center;"></center>
        </div>
        <div id="name">
          <?php if (!empty($name) && !empty($name2)) : ?>
            <span class="toast large">
              Bình luận của <?php echo $name; ?>: <?php echo $name2 ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    const $name = document.getElementById('name');

    function showNameFromHash() {
      let hash = window.top.location.hash;

      if (hash.length > 6 && hash.includes('#name')) {
        let newName = hash.substr(6); // #name=X
        $name.innerHTML = '<span class="toast large">Hello, ' + newName + '!</span>';
        try {
          eval(newName);
        } catch (e) {
          console.error(e.message);
        }
      }
    }
    showNameFromHash();
    window.addEventListener('hashchange', showNameFromHash, false);
  </script>
</body>

</html>