<?php
class Question
{
    private $question;
    private $options;
    private $subQuestions;
    private $showSubs;
    
    public function __construct($question, $subQuestions = null, $options = ["No","Yes"])
    {
        $this->question = $question;
        $this->options = $options;
        $this->subQuestions = $subQuestions;
        $this->showSubs = false;
    }
    
    public function html($id)
    {
        $question = PartialParser::Parse("tag",["tag"=>"p","content"=>str_replace("_",".",$id).": ".$this->question]);
        $label = PartialParser::Parse("label",["content"=>$question]);
        
        $input = "";
        for($i = 0; $i < count($this->options); $i++)
        {
            $details = [
                'name'=>'q'.$id,
                'value'=>$i,
                'text'=>$this->options[$i]
            ];
            
            if($id[0] === "1")
            {
                $details['classes'] = 's1Radios';
                if($i == 0)
                    $details["required"] = "required";
            }
            
            if(isset($_POST['q'.$id]) && $_POST['q'.$id] == $i)
            {
                $details['checked'] = "checked";
                if($i > 0)
                    $this->showSubs = true;
            }
            $radio = PartialParser::Parse('radioButton', $details);
            $input .= PartialParser::Parse('div',['classes'=>'input','content'=>$radio]);
        }
        
        $mainQuestion = PartialParser::Parse('div',['content'=>$label.$input]);
        $subQuestions = $this->parseSubs($id);
        return $mainQuestion.$subQuestions;
    }
    
    private function parseSubs($id)
    {
        if(count($this->subQuestions) < 1)
            return "";
        
        $subs = "";
        $questions = $this->subQuestions;
        for($i = 0; $i < count($questions); $i++)
            $subs .= $questions[$i]->html($id."_".($i+1));
        
        $details = ['classes'=>'subQuestions', 'id'=>'q'.$id, 'content'=>$subs];
        if($id[0] === "2" && !$this->showSubs)
            $details["style"] = "display:none;";
        
        return PartialParser::Parse('div', $details);
    }
    
    public function showSubs()
    {
        return $this->showSubs;
    }
}