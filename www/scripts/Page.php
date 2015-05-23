<?php
class Page extends RestrictedAccess
{
    private $name;
    private $page;

    public function __construct($name, $page, $priv = UserLevel::Anon, $mode = "all")
    {
        parent::__construct($priv, $mode);
        $this->name = $name;
        $this->page = $page;
    }

    public function __get($name)
    {
        if(property_exists($this, $name))
            return $this->{$name};
    }
}