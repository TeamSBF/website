<?php
class RadioGroup
{
    private $name, $checked, $sep, $buttons;
    
    public function __construct($name, $checked = -1, $data = null)
    {
        $this->name = $name;
        $this->checked = $checked;
        $this->buttons = array();
        $this->parseData($data);
        
        $this->sep = "<br />";
        if(array_key_exists("separator", $data))
            $this->sep = $data['separator'];
        
    }
    
    private function parseData($data)
    {
        $ret = array();
        for($i = 0; $i < count($data); $i++)
        {
            $this->Add($data[$i][0], $data[$i][1]);
            if($this->checked === $data[$i][1])
                $this->buttons[$i]->Checked(true);
        }
    }
    
    public function Add($text, $value, $checked = false)
    {
        $this->buttons[] = new RadioButton($this->name, $text, $checked, $value);
    }
    
    public function Html()
    {
        $content = "";
        foreach($this->buttons as $button)
            $content .= $button->Html().'<br />';
        return $content;
    }
}