<?php 
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
?>