<?php
include_once("../Model/M_Admin.php");
class Ctrl_Admin
{
    public function invoke()
    {
        if (isset($_REQUEST['login'])) {

            if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
                $modelLogin = new Model_Admin();
                $student = $modelLogin->getAdminLogin($_REQUEST['username'], $_REQUEST['password']);
                $commentAll=$modelLogin->getComment();
                if($student==1)
                {
                    include_once("../View/index.php");
                }else if($student==0)
                {
                    header("Location: ../?error=Incorect User name or password");
                }else{
                    header("Location: ../");
                }
            }
        }
        if (isset($_REQUEST['del'])) {
            session_start();

            session_unset();

            session_destroy();

            header("Location: ../");
        }
        if (isset($_POST['cmt'])) {
            $modelCMT = new Model_Admin();
            $comment=$modelCMT->addComment($_REQUEST['name'],$_REQUEST['name2'],date("Y/m/d G.i:s"));
            $commentAll=$modelCMT->getComment();
            include_once("../View/index.php");
        }
    }
};
$C_Student = new Ctrl_Admin();
$C_Student->invoke();
