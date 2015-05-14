<?php
class Validator extends Singleton
{
    private $types = [
        "email" => ['s' => FILTER_SANITIZE_EMAIL, 'v' => FILTER_VALIDATE_EMAIL],
        "string" => ['s' => FILTER_SANITIZE_STRING],
		"int" => ['s' => FILTER_SANITIZE_NUMBER_INT]
    ];

    public function Validate($type, $value)
    {
        // There isn't anything we can do to validate $value
        if(!$this->checkType($type, "v"))
            return $value;

        return filter_var($value, $this->types[$type]["v"]);
    }

    public function Sanitize($type, $value)
    {
        // We don't have the knowledge to sanitize $value
        if (!$this->checkType($type, "s"))
            return $value;

        return filter_var($value, $this->types[$type]["s"]);
    }
    
    public function SanitizeArray($type, $values)
    {
        // We don't have the knowledge to sanitize $value OR it's not an array
        if (!$this->checkType($type, "s") || !is_array($values))
            return $values;
        
        $keys = array_keys($values);
        $sanitized = array();
        for($i = 0; $i < count($keys); $i++)
            $sanitized[$keys[$i]] = $this->Sanitize($type, $values[$keys[$i]]);
        
        return $sanitized;
    }

    private function checkType($type, $filter)
    {
        if(!array_key_exists($type, $this->types) || !array_key_exists($filter, $this->types[$type]))
            return false;

        return true;
    }
}