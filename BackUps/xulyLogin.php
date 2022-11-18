<?php
$section = $_REQUEST['lb'];
$user = "pbl4";
$password = "Nguyenhung@0312";
$database = "dulieu1";
$table = "admin";
// if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
//     $u = $_REQUEST['username'];
//     $p = $_REQUEST['password'];
// } else {
//     echo '<h1>ko cos dau ma tim </h1>';
// }
// try {
//     $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
//     foreach ($db->query("SELECT * FROM $table") as $row) {
//         if ($row[1] == $user && $row[2] == $pass) {
//             header("Location:formLogin.php");
//         } else {
//             // setcookie("user",$u,0);
//             setcookie("user", $u, time() + 3600);
//             // setcookie("pass",$p,0);
//             setcookie("pass", $p, time() + 3600);
//             // header("Location: " . $section . "?user=" . $u . "&pass=" . $p. "&id=" . $row[0]);
//             header("Location: " . $section);
//         }
//     }
// } catch (PDOException $e) {
// }
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }

    $uname = validate($_POST['username']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: ../View/formLogin.php?error=User Name is required");

        exit();
    } else if (empty($pass)) {

        header("Location: ../View/formLogin.php?error=Password is required");

        exit();
    } else {

        try {
            $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
            foreach ($db->query("SELECT * FROM $table") as $row) {
                if ($row[1] == $user && $row[2] == $pass) {
                    echo "Logged in!";
                    $_SESSION['user'] = $row[1];

                    $_SESSION['pass'] = $row[2];

                    $_SESSION['id'] = $row[0];
                    header("Location: ../View/index.php");
                    exit();
                    // header("Location:formLogin.php");
                } else {
                    header("Location: ../View/formLogin.php?error=Incorect User name or password");
                    exit();
                }
            }
        } catch (PDOException $e) {
        }
    }
} else {

    header("Location: ../View/index.php");

    exit();
}
// $_SESSION["username"] = $username;
// $_SESSION["password"] = $password;
// $link = mysqli_connect("localhost", "pbl4", "Nguyenhung@0312") or die("Khong the ket noi den CSDL MYSQL");
// mysqli_select_db($link, "dulieu1");
// $sql = "SELECT * FROM dulieu1.admin WHERE username = '$username' and password = '$password'";
// $result = mysqli_query($link, $sql);
// while ($row = mysqli_fetch_array($result)) {
//     if (mysqli_num_rows($result) == 0) {
//         header("Location:formLogin.php");
//     } else {
//         header("Location: " . $section . "?user=" . $username . "&pass=" . $password . "&id=" . $row[0]);
//     }
// }
// mysqli_free_result($result);
// mysqli_close($link);