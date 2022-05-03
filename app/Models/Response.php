<?php


namespace App\Models;


use JsonSerializable;

class Response implements JsonSerializable
{
    public $data;
    public $message;
    public $errors;

    public function __construct($data = null, $message = null, $errors = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->errors = $errors;
    }

//    /**
//     * @inheritDoc
//     */
    public function jsonSerialize()
    {
        $returnValue = [];

        if (isset($this->data))
            $returnValue['data'] = $this->data;

        if ($this->message)
            $returnValue['message'] = $this->message;

        if($this->errors)
            $returnValue['errors'] = $this->errors;

        return $returnValue;
    }
}
