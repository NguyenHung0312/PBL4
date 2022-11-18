<?php 
include_once("../Model/M_Admin.php");
class Ctrl_Admin{
    public function invoke(){
        if(isset($_REQUEST['username'])&&isset($_REQUEST['password'])){
            $modelStudent = new Model_Admin();
            $student = $modelStudent->getAdminLogin($_REQUEST['username'],$_REQUEST['password']);
            // include_once("./View/StudentDetail.php");
        }
    }
};
$C_Student = new Ctrl_Admin();
$C_Student->invoke();
?>