<?php
namespace App\Http\Services\TimeHandler\Classes;

use App\Http\Services\TimeHandler\Interfaces\TimeHandler;

abstract class AbstractTimeHandler implements TimeHandler {

    private $nextHandler;
    public $text;
    protected $class_expressions  = [];
    protected $class_timestamp    = 0;
    protected $exp_array          = 0;

    public function setNext(TimeHandler $handler): TimeHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $timestamp,array $expressions) : ?array
    {
        $this->class_expressions    = $expressions;
        $this->class_timestamp      = $timestamp;
        if ($this->nextHandler){
            return $this->nextHandler->handle($timestamp,$expressions);
        }

        return null;
    }

}
