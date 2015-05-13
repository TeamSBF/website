<?php
class RadioButton
{
    private $name, $text, $checked, $value;

    public function __construct($name, $text, $checked, $value)
    {
        $this->name = $name;
        $this->text = $text;
        $this->checked = $checked;
        $this->value = $value;
    }
    
    public function Checked($yes)
    {
        if(is_bool($yes))
            $this->checked = $yes;
    }
    
    public function IsChecked()
    {
        return $this->checked;
    }
    
    public function Html()
    {
        $data['name'] = $this->name;
        $data['text'] = $this->text;
        $data['value'] = $this->value;
        $data['checked'] = $this->checked? "checked" : "";
        return PartialParser::Parse('radio-button', $data);
    }
}