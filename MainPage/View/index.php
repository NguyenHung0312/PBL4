<?php
// session_start();
// if (empty($_COOKIE['Name'])) {
//   header("Location: ../");
//   exit();
// }
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
  <!-- <link rel="stylesheet" href="./assets/style.css"> -->
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <link href="https://nguyenhung0312.github.io/Hip/asset/css/img/Hip_Hip-removebg-preview.png" rel="icon" type="image/x-icon">
  <!-- <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'> -->
  <!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'> -->
  <!-- <link href="https://nguyenhung0312.github.io/Hip/asset/css/img/Hip_Hip-removebg-preview.png" rel="icon" type="image/x-icon"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
  <script>
    function RS() {
      document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
  </script>
  <style>
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #232e33;
      font-family: 'Calibri', sans-serif !important;
    }

    .card {
      max-width: 1224px !important;
    }

    .card-no-border .card {
      border: 0px;
      border-radius: 4px;
      -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
      box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
      /* max-width: 452px!important; */
    }

    .card-body {
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1.25rem
    }

    .comment-widgets .comment-row:hover {
      background: rgba(0, 0, 0, 0.02);
      cursor: pointer;
    }

    .comment-widgets .comment-row {
      border-bottom: 1px solid rgba(120, 130, 140, 0.13);
      padding: 15px;
    }

    .comment-text:hover {
      visibility: hidden;
    }

    .comment-text:hover {
      visibility: visible;
    }

    .label {
      padding: 3px 10px;
      line-height: 13px;
      color: #232e33;
      font-weight: 400;
      border-radius: 4px;
      font-size: 75%;
    }

    .round img {
      border-radius: 100%;
    }

    .label-info {
      background-color: #1976d2;
    }

    .label-success {
      background-color: green;
    }

    .label-danger {
      /* background-color: #ef5350; */
      background-color: #232e33;
    }

    .action-icons a {
      padding-left: 7px;
      vertical-align: middle;
      color: #99abb4;
    }

    .action-icons a:hover {
      color: #1976d2;
    }

    .mt-100 {
      margin-top: 100px
    }

    .mb-100 {
      margin-bottom: 100px
    }

    ::-webkit-scrollbar {
      width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);
  </style>
</head>

<body>
  <header>
    <a href="./" class="logo">XSS Me</a>
    <a href="./" class="button">Home</a>
    <a href="./?page=About" class="button">About</a>
    <a href="./#name=Hung" class="button">DOM-based XSS</a>
    <a href="../Controller/C_Admin.php?del=0" class="button" style="float: right;" onclick="RS()">
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
          <!-- <form action="../Controller/C_Admin.php" method="post" accept-charset="utf-8" id="form" id="form" style="display: flex; flex-direction: column;"> -->
          <form action="../Controller/C_Admin.php" method="post" accept-charset="utf-8" id="form" style="display: flex; flex-direction: column;">

            <label for="comment_author" class="required">Your name</label>
            <input type="text" name="name" id="comment_author" value="" tabindex="1" required="required" value="<?php if (!empty($name)) {
                                                                                                                  echo $name;
                                                                                                                } ?>" style="width:240px ;flex: 1;" placeholder="Tên...">

            <label for="comment" class="required">Your comment</label>
            <textarea name="name2" id="comment" rows="10" tabindex="2" required="required" style="flex: 1;" placeholder="Binh luan..."></textarea>

            <input type="hidden" name="comment_post_ID" value="<?php echo ($comment_post_ID); ?>" id="comment_post_ID" />
            <input name="cmt" class="primary" type="submit" value="Submit comment" style="width: 180px;" />

          </form>
          <!-- //form gửi submit -->
          <!-- <form action="MainPage.php" method="post" accept-charset="utf-8" id="form" style="display: flex; flex-direction: column;">
            Tên bạn là: <input type="text" name="name" class="t1" style="width:240px ;flex: 1;" value="<?php if (!empty($name)) {
                                                                                                          echo $name;
                                                                                                        } ?>" placeholder="John Doe..." autofocus required>
            Binh luan: <input type="text" name="name2" class="t2" style="width:240px ; flex: 1;" value="" placeholder="Binh Luan.." required>
            <button type="submit" class="primary" style="width: 80px;">Submit!</button>
          </form> -->
          <!-- //form gửi submit -->

        <?php endif; ?>
        <!-- <img src="smiley.gif" alt="Smiley face" width="42" height="42" style="vertical-align:middle"> -->
        <div>
          <!-- <center><img src="https://scontent.fdad1-4.fna.fbcdn.net/v/t1.15752-9/301701055_465250165461896_4261023679521712020_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=ae9488&_nc_ohc=pKdUf_hBI7kAX9uH-1r&_nc_ht=scontent.fdad1-4.fna&oh=03_AdR_4E5suBxNEuqClaXkiVKcTrCUURdfJ9gd7IoMFn5RWA&oe=638CA889" alt="Đề bài" width="500" height="500" style="vertical-align:middle; align-items: center;"></center> -->

        </div>

        <div id="name">
          <?php
          if (!empty($_REQUEST['name']) && !empty($_REQUEST['name2'])) : ?>
            <span class="toast large">
              Bình luận của <?php echo $_REQUEST['name']; ?>: <?php echo $_REQUEST['name2'] ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-12">

        <div class="card" style="max-width: 1224px!important;">
          <div class="card-body">
            <h4 class="card-title">Recent Comments</h4>
            <h6 class="card-subtitle">Latest Comments section by users</h6>
          </div>
          <div class="comment-widgets m-b-20">
            <?php
            if (sizeof($commentAll) > 0) {
              for ($i = 1; $i <= sizeof($commentAll); $i++) {
                echo ' <div class="d-flex flex-row comment-row">
                  <div class="p-2"><span class="round"><img src="https://i.imgur.com/uIgDDDd.jpg" alt="user" width="50"></span></div>
                  <div class="comment-text w-100">
                    <h5 style="text-decoration:underline ;">' . $commentAll[$i]->name . '</h5>
                    <div class="comment-footer">
                      <span class="date">' . $commentAll[$i]->date . '</span>
                      <span class="label label-info">Pending</span> <span class="action-icons">
                        <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a>
                        <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a>
                        <a href="#" data-abc="true"><i class="fa fa-heart"></i></a>
                      </span>
                    </div>
                    <p class="m-b-5 m-t-10" >' . $commentAll[$i]->cmt . '</p>
                  </div>
                </div>';
              }
            }
            ?>

            <!-- <div class="d-flex flex-row comment-row">
              <div class="p-2"><span class="round"><img src="https://i.imgur.com/uIgDDDd.jpg" alt="user" width="50"></span></div>
              <div class="comment-text w-100">
                <h5>Nguyen Hung</h5>
                <div class="comment-footer">
                  <span class="date">April 14, 2022</span>
                  <span class="label label-info">Pending</span> <span class="action-icons">
                    <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a>
                    <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a>
                    <a href="#" data-abc="true"><i class="fa fa-heart"></i></a>
                  </span>
                </div>
                <p class="m-b-5 m-t-10">Test XSS cho vui thoi</p>
              </div>
            </div>

            <div class="d-flex flex-row comment-row ">
              <div class="p-2"><span class="round"><img src="https://i.imgur.com/tT8rjKC.jpg" alt="user" width="50"></span></div>
              <div class="comment-text active w-100">
                <h5>Jonty Andrews</h5>
                <div class="comment-footer">
                  <span class="date">March 13, 2020</span>
                  <span class="label label-success">Approved</span> <span class="action-icons active">
                    <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a>
                    <a href="#" data-abc="true"><i class="fa fa-rotate-right text-success"></i></a>
                    <a href="#" data-abc="true"><i class="fa fa-heart text-danger"></i></a>
                  </span>
                </div>
                <p class="m-b-5 m-t-10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites</p>
              </div>
            </div> -->
          </div>
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