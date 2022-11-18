<?php
include_once("./E_Admin.php");
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
    public function getAdminLogin($u,$p)
    {
        // $link = mysqli_connect("localhost","root","") or die ("Khong the ket noi den CSDL MYSQL");
        // mysqli_select_db($link, "dulieu");
        // $sql = "select * from sinhvien";
        $section = $_REQUEST['lb'];
        $user = "pbl4";
        $password = "Nguyenhung@0312";
        $database = "dulieu1";
        $table = "admin";
        session_start();

        if (isset($u) && isset($p)) {

            function validate($data)
            {

                $data = trim($data);

                $data = stripslashes($data);

                $data = htmlspecialchars($data);

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
                            echo "Logged in!";
                            $_SESSION['user'] = $row[1];

                            $_SESSION['pass'] = $row[2];

                            $_SESSION['id'] = $row[0];
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
    // public function getAdminDetail($stid)
    // {
    //     $allAdmin = $this->getAdminLogin();
    //     return $allAdmin[$stid];
    // }
}
