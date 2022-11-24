<?php
include_once("./E_Admin.php");
include_once("./E_Cmt.php");
class Model_Admin
{
    public function __construct()
    {
    }
    public function conn()
    {
        $user = "pbl4";
        $password = "Nguyenhung@0312";
        $database = "dulieu1";
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        return $db;
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
                            header("Location: ../View/");
                            exit();
                            // header("Location:formLogin.php");
                        } else {
                            header("Location: ../?error=Incorect User name or password");
                            exit();
                        }
                    }
                } catch (PDOException $e) {
                }
            }
        } else {

            header("Location: ../");

            exit();
        }
    }
    public function getComment($u, $p)
    {
        $user = "pbl4";
        $password = "Nguyenhung@0312";
        $database = "dulieu1";
        $table = "comments";
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        foreach ($db->query("SELECT * FROM $table") as $row) {
            $ID= $row['IDcmt'];
            $Name= $row['Name'];
            $cmt= $row['Comment'];
            $i++;
              $phongban[$i] = new E_Cmt($ID, $Name, $cmt);
        return $phongban;

        }
    }
}
date_default_timezone_set('UTC');

class Persistence {
  
  private $data = array();
  
  function __construct() {
    session_start();
    
    if( isset($_SESSION['blog_comments']) == true ){
      $this->data = $_SESSION['blog_comments'];
    }
  }
  
  /**
   * Get all comments for the given post.
   */
  function get_comments($comment_post_ID) {
    $comments = array();
    if( isset($this->data[$comment_post_ID]) == true ) {
      $comments = $this->data[$comment_post_ID];
    }
    return $comments;
  }
  
  /**
   * Get all comments.
   */
  function get_all_comments() {
    return $this->data;
  }
  
  /**
   * Store the comment.
   */
  function add_comment($vars) {
    
    $added = false;
    
    $comment_post_ID = $vars['comment_post_ID'];
    $input = array(
     'comment_author' => $vars['comment_author'],
     'email' => $vars['email'],
     'comment' => $vars['comment'],
     'comment_post_ID' => $comment_post_ID,
     'date' => date('r'));
    
    if($this->validate_input($input) == true) {
      if( isset($this->data[$comment_post_ID]) == false ) {
        $this->data[$comment_post_ID] = array();
      }
      
      $input['id'] = uniqid('comment_');
      
      $this->data[$comment_post_ID][] = $input;
      
      $this->sync();
      
      $added = $input;
    }
    return $added;
  }
  
  function delete_all() {
    $this->data = array();
    $this->sync();
  }
  
  private function sync() {
    $_SESSION['blog_comments'] = $this->data;    
  }
  
  /**
   * TODO: much more validation and sanitization. Use a library.
   */  
  private function validate_input($input) {
    $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($input['email'], FILTER_VALIDATE_EMAIL) == false) {
      return false;
    }
    
    $input['comment_author'] = substr($input['comment_author'], 0, 70);
    if($this->check_string($input['comment_author']) == false) {
      return false;
    }
    $input['comment_author'] = htmlentities($input['comment_author']);

    $input['comment'] = substr($input['comment'], 0, 300);
    if($this->check_string($input['comment'], 5) == false) {
      return false;
    }
    $input['comment'] = htmlentities($input['comment']);

    $input['comment_post_ID'] = filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT);  
    if (filter_var($input['comment_post_ID'], FILTER_VALIDATE_INT) == false) {
      return false;
    }

    return true;
  }
  
  private function check_string($string, $min_size = 1) {
    return strlen(trim($string)) >= $min_size;
  }
}

?>
