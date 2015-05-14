<?php
class DropDown
{
    private $name, $options;

    public function __construct($name, $options, $selected = -1)
    {
        $this->name = $name;
        $this->options = [];
        $this->parseSelected($options, $selected);
    }
    
    private function parseSelected($options, $selected)
    {
        $keys = array_keys($options);
        foreach($keys as $key)
            $this->options[] = new DropDownOption($options[$key], $key, ($selected === $key) ? true : false);
    }
    
    public function AddOption($value, $text, $selected = false)
    {
        $this->options[] = new DropDownOption($value, $text, $selected);
    }
    
    public function RemoveOption($value)
    {
        for($i = 0; $i < count($this->options); $i++)
        {
            $option = $this->options[$i];
            if($option->Value() === $value)
            {
                unset($this->options[$i]);
                break;
            }
        }
    }
    
    public function Html()
    {
        $options = "";
        foreach($this->options as $option)
            $options .= $option->Html();
        
        return PartialParser::Parse('dropdown',["name"=>$this->name, "options"=>$options]);
    }
}