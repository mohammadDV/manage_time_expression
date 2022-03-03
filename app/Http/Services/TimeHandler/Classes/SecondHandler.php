<?php

namespace App\Http\Services\TimeHandler\Classes;

use App\Http\Services\TimeHandler\Traits\HandleExpression;

class SecondHandler extends AbstractTimeHandler {
    use  HandleExpression;
    protected $default_amount = 1;
    protected $exp            = "s";

    /**
     * Handle time and expressions in Second.
     *
     * @return array
     */
    public function handle(string $timestamp,array $expressions) : ?array
    {
        $this->set_attribute($timestamp,$expressions);
        $minus = $this->get_difference();
        return $this->checkRemainTime($minus) ?: parent::handle($this->class_timestamp,$this->class_expressions);
    }
}
