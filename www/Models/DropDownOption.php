<?php
class DropDownOption
{
    private $value, $text, $selected;

    public function __construct($value, $text, $selected = false)
    {
        $this->value = $value;
        $this->text = $text;
        $this->selected = $selected;
    }
    
    public function Html()
    {
        $selected = ($this->selected) ? "selected" : "";
        return PartialParser::Parse('dropdownoption', ["content"=>$this->text, "value"=>$this->value, "selected"=>$selected]);
    }
    
    public function Value()
    {
        return $this->value;
    }
    
    public function Text()
    {
        return $this->text;
    }
    
    public function IsSelected()
    {
        return $this->selected;
    }
}