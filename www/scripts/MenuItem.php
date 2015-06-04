<?php
class MenuItem
{
    private $name;
    private $page;
    private $priv;
    private $mode;

    public function __construct($name, $page, $priv = UserLevel::Anon, $mode = "all")
    {
        $this->name = $name;
        $this->page = $page;
        $this->priv = $priv;
        $this->mode = $mode;
    }

    public function __get($name)
    {
        if(property_exists($this, $name))
            return $this->{$name};
    }
}