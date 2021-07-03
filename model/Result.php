<?php


class Result
{
    public int $code;
    public string $message;

   public function __construct($code, $mes="")
    {
        $this->code = $code;
        $this->message = $mes;
    }

}