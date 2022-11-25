<?php
// include_once("./E_Admin.php");
// include_once("./E_Cmt.php");
class E_admin
{
    public $id;
    public $user;
    public $password;
    public function __construct($_id, $_user, $_password)
    {
        $this->_id = $_id;
        $this->user = $_user;
        $this->password = $_password;
    }
}
class E_Cmt
{
    public $id;
    public $name;
    public $cmt;
    public $date;
    public function __construct($id, $name, $cmt,$date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cmt = $cmt;
        $this->date = $date;
    }
}
class Model_Admin
{
  public function __construct()
  {
  }
  public function getAdminLogin($u, $p)
  {
    $section = $_REQUEST['lb'];
    $user = "pbl4";
    $password = "Nguyenhung@0312";
    $database = "dulieu1";
    $table = "admin";
    session_start();

    if (isset($u) && isset($p)) {

      function validate($data)
      {

        // $data = trim($data);

        // $data = stripslashes($data);

        // $data = htmlspecialchars($data);

        return $data;
      }

      $uname = validate($u);

      $pass = validate($p);

      if (empty($uname)) {

        header("Location: ../?error=User Name is required");
        exit();
      } else if (empty($pass)) {

        header("Location: ../?error=Password is required");

        exit();
      } else {

        try {
          $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
          foreach ($db->query("SELECT * FROM $table") as $row) {
            if ($row[1] == $u && $row[2] == $p) {
              $_SESSION['user'] = $row[1];

              $_SESSION['pass'] = $row[2];

              $_SESSION['id'] = $row[0];
              if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $cookie_value = $_SESSION['user'];
                setcookie("Name", $cookie_value, 0, "/PBL4/MainPage/View/");
              }
              // header("Location: ../View/");
              // $ok="../View/";
              return 1;
              exit();
              // header("Location:formLogin.php");
            } else {
              // header("Location: ../?error=Incorect User name or password");
              // $ko="../?error=Incorect User name or password";
              return 0;
              exit();
            }
          }
        } catch (PDOException $e) {
        }
      }
    } else {

      // header("Location: ../");
      $no=100;
      return $no;
      exit();
    }
  }
  public function getComment()
  {
    // $link = mysqli_connect("localhost", "pbl4", "Nguyenhung@0312") or die("Khong the ket noi den CSDL MYSQL");
    //   mysqli_select_db($link, "dulieu1");
    //   $sql = "select * from comments";
    //   $result = mysqli_query($link, $sql);
    //   $i = 0;
    //   $num_rows = mysqli_num_rows($result);
    //   while ($row = mysqli_fetch_array($result)) {
    //      $ID = $row['IDcmt'];
    //      $Name = $row['Name'];
    //      $Comment = $row['Comment'];
    //      $i++;
    //      $nhanvien[$i] = new E_Cmt($ID, $Name, $Comment);
    //   }
    //   return $nhanvien;
    $user = "pbl4";
    $password = "Nguyenhung@0312";
    $database = "dulieu1";
    $table = "comments";
    $i = 0;
    try {

      $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
      $link = mysqli_connect("localhost", "pbl4", "Nguyenhung@0312") or die("Khong the ket noi den CSDL MYSQL");
      mysqli_select_db($link, "dulieu1");
      foreach ($db->query("SELECT * FROM $table") as $row) {
        $ID = $row['IDcmt'];
        $Name = $row['Name'];
        $cmt = $row['Comment'];
        $date = $row['Date'];
        $i++;
        $comment[$i] = new E_Cmt($ID, $Name, $cmt,$date);
      }
      return $comment;
    } catch (Exception $e) {
    }
  }
  public function getAllAdmin()
  {
    $user = "pbl4";
    $password = "Nguyenhung@0312";
    $database = "dulieu1";
    $table = "admin";
    $i = 0;
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    foreach ($db->query("SELECT * FROM $table") as $row) {

      $name = $row[1];

      $cmt = $row[2];

      $id = $row[0];
      $i++;
      $comment[$i] = new E_admin($id, $name, $cmt);
    }
    return $comment;

  }
  public function addComment($Name, $cmt,$date)
  {
    $link = mysqli_connect("localhost", "pbl4", "Nguyenhung@0312") or die("Khong the ket noi den CSDL MYSQL");
    mysqli_select_db($link, "dulieu1");
    $ID = $this->getcmtID();
    $IDs = 100;
    $sql = "insert into comments values('$ID','$Name','$cmt','$date')";
    $rs = mysqli_query($link, $sql);
    mysqli_close($link);
  }
  public function getcmtID()
  {
    $allnhanvien = $this->getComment();
    $k = sizeof($allnhanvien) + 1;
    return $k;
  }
}
date_default_timezone_set('UTC');

// class Persistence
// {

//   private $data = array();

//   function __construct()
//   {
//     session_start();

//     if (isset($_SESSION['blog_comments']) == true) {
//       $this->data = $_SESSION['blog_comments'];
//     }
//   }

//   /**
//    * Get all comments for the given post.
//    */
//   function get_comments($comment_post_ID)
//   {
//     $comments = array();
//     if (isset($this->data[$comment_post_ID]) == true) {
//       $comments = $this->data[$comment_post_ID];
//     }
//     return $comments;
//   }

//   /**
//    * Get all comments.
//    */
//   function get_all_comments()
//   {
//     return $this->data;
//   }

//   /**
//    * Store the comment.
//    */
//   function add_comment($vars)
//   {

//     $added = false;

//     $comment_post_ID = $vars['comment_post_ID'];
//     $input = array(
//       'comment_author' => $vars['comment_author'],
//       'email' => $vars['email'],
//       'comment' => $vars['comment'],
//       'comment_post_ID' => $comment_post_ID,
//       'date' => date('r')
//     );

//     if ($this->validate_input($input) == true) {
//       if (isset($this->data[$comment_post_ID]) == false) {
//         $this->data[$comment_post_ID] = array();
//       }

//       $input['id'] = uniqid('comment_');

//       $this->data[$comment_post_ID][] = $input;

//       $this->sync();

//       $added = $input;
//     }
//     return $added;
//   }

//   function delete_all()
//   {
//     $this->data = array();
//     $this->sync();
//   }

//   private function sync()
//   {
//     $_SESSION['blog_comments'] = $this->data;
//   }

//   /**
//    * TODO: much more validation and sanitization. Use a library.
//    */
//   private function validate_input($input)
//   {
//     $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
//     if (filter_var($input['email'], FILTER_VALIDATE_EMAIL) == false) {
//       return false;
//     }

//     $input['comment_author'] = substr($input['comment_author'], 0, 70);
//     if ($this->check_string($input['comment_author']) == false) {
//       return false;
//     }
//     $input['comment_author'] = htmlentities($input['comment_author']);

//     $input['comment'] = substr($input['comment'], 0, 300);
//     if ($this->check_string($input['comment'], 5) == false) {
//       return false;
//     }
//     $input['comment'] = htmlentities($input['comment']);

//     $input['comment_post_ID'] = filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT);
//     if (filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT) == false) {
//       return false;
//     }

//     return true;
//   }

//   private function check_string($string, $min_size = 1)
//   {
//     return strlen(trim($string)) >= $min_size;
//   }
// }
