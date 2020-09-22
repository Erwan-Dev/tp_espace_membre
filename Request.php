<?php
include_once './IRequest.php';

class Request implements IRequest
{

    public function __construct()
    {
        $this->bootstrapSelf();
    }

    public function getBody()
    {
        if($this->requestMethod === "GET") {
            return;
        }

        if ($this->requestMethod == "POST") {
            $body = [];
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
    }

    private function bootstrapSelf() 
    {
        foreach($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    private function toCamelCase($string)
    {
        $result = strtolower($string);
            
        preg_match_all('/_[a-z]/', $result, $matches);

        foreach($matches[0] as $value)
        {
            $c = str_replace('_', '', strtoupper($value));
            $result = str_replace($value, $c, $result);
        }

        return $result;
    }
}