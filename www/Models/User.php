<?php

class User
{
    /**
     * The user ID of the user
     * @var int
     */
    private $id;
    /**
     * The privilege level of the user
     * @var int
     */
    private $accesslevel;

    /**
     * The class constructor
     *
     * @param $info The array of info the model will store
     */
    public function __construct($id, $accesslevel)
    {
        $this->id = $id;
        $this->accesslevel = $accesslevel;
    }

    public function __get($name)
    {
        $name = strtolower($name);
        if(property_exists(__CLASS__, $name))
            return $this->{$name};
    }
    
    public function isLoggedIn()
    {
        return $this->id > 0;
    }
}