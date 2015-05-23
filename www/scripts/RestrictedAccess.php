<?php

class RestrictedAccess
{
    protected $accesslevel;
    protected $mode;

    public function __construct($accesslevel = UserLevel::Anon, $mode = "all")
    {
        $this->accesslevel = $accesslevel;
        $this->mode = $mode;
    }
    
    public function HasAccess($level)
    {
        $accesslevel = $this->accesslevel;
        $mode = $this->mode;
        return $accesslevel == $level || ($accesslevel < $level && $mode === "all");
    }
}