<?php 
class E_Cmt
{
    public $id;
    public $name;
    public $cmt;
    public function __construct($_id, $_name, $_cmt)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->cmt = $_cmt;
    }
}
?>