<?php 
class E_Cmt
{
    public $id;
    public $name;
    public $cmt;
    public function __construct($id, $name, $cmt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cmt = $cmt;
    }
}
?>