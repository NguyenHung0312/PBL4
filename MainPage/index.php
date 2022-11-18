<?php
require_once("./lib.php");
if(isset($_REQUEST['error']))
{
    $er=$_REQUEST['error'];
    echo '<script> alert("'.$er.'")</script>';
}
    ?>
<body style="background-color:#1c2529; padding-top: 100px;">
    <div class="col-5 offset-4 mt-4">
        <form name="form" action="./Controller/C_Admin.php" method='post'>
            <input type="text" name="lb" value="./MainPage.php" hidden>

            <div class="card">
                <div class="card-header">
                    <b>LOGIN </b>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <input type="reset" class="float-right btn btn-primary ml-2" value="Reset">
                    <input type="submit" class="float-right btn btn-primary" value="OK" onclick="check()">
                </div>
            </div>
        </form>
    </div>
    <script>
        function check() {
            var username = document.form.username.value;
            var password = document.form.password.value;
            if (username === "") {
                alert("Bạn chưa nhập username !");
            }
            if (password === "") {
                alert("Bạn chưa nhập password !");
            }
        }
    </script>
</body>

</html>