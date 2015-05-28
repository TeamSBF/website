<?php
class Page extends RestrictedAccess
{
    private $name;
    private $page;
	private $display;

    public function __construct($name, $page, $priv = UserLevel::Anon, $mode = "all", $display = true)
    {
        parent::__construct($priv, $mode);
        $this->name = $name;
        $this->page = $page;
		$this->display = $display;
    }

    public function __get($name)
    {
        if(property_exists($this, $name))
            return $this->{$name};
    }
}