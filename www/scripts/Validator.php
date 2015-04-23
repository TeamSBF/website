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

    private function checkType($type, $filter)
    {
        if(!array_key_exists($type, $this->types) || !array_key_exists($filter, $this->types[$type]))
            return false;

        return true;
    }
}