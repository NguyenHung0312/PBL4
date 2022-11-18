<?php 
class E_admin
{
    public $id;
    public $user;
    public $password;
    public function __construct($_id, $_user, $_password)
    {
        $this->id = $_id;
        $this->name = $_user;
        $this->age = $_password;
    }
}
?>