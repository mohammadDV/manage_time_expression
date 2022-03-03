<?php

namespace App\Http\Services\TimeHandler;

use App\Http\Services\TimeHandler\Classes\HourHandler;
use App\Http\Services\TimeHandler\Classes\SecondHandler;
use App\Http\Services\TimeHandler\Interfaces\TimeHandler;
use App\Http\Services\TimeHandler\Classes\DayHandler;
use App\Http\Services\TimeHandler\Classes\MinuteHandler;
use App\Http\Services\TimeHandler\Classes\MonthHandler;

class TimeHandlerService {
    protected $month    = null;
    protected $day      = null;
    protected $hour     = null;
    protected $minute   = null;
    protected $second   = null;
    protected $result   = null;
    /**
     * Preparing models and set properties.
     *
     * @return void
     */
    public function __construct()
    {
         $this->month   = new MonthHandler();
         $this->day     = new DayHandler();
         $this->hour    = new HourHandler();
         $this->minute  = new MinuteHandler();
         $this->second  = new SecondHandler();
    }
    /**
     * Preparing data for show response.
     *
     * @return void
     */
    private function show_response(TimeHandler $timeHandler,$timestamp,$expressions)
    {
        while(!empty($expressions)){
            $data = $timeHandler->handle($timestamp,$expressions);
            if ($data['remain_time'] >= 0){
                $this->result  .= $data['expression'];
                $timestamp      = $data['remain_time'];
                $expressions    = $data['exp_array'];
            }else{
                $timestamp      = 0;
                $expressions    = [];
                $this->result   = ' time not found' ;
            }
        }
    }
    /**
     * Execute chain of Responsibility and run main service.
     *
     * @return string
     */
    public function run($timestamp = 0,array $expressions = []) : string
    {
        $this->month->setNext($this->day)->setNext($this->hour)->setNext($this->minute)->setNext($this->second);
        $this->show_response($this->month,$timestamp,$expressions);
        return $this->result;
    }
}
