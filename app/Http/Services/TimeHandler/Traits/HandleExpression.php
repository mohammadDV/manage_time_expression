<?php

namespace App\Http\Services\TimeHandler\Traits;

use phpDocumentor\Reflection\Types\Integer;

trait HandleExpression  {
    /**
     * Set attributes for classes.
     *
     * @param    $timestamp
     * @param    $expressions
     * @return void
     */
    public function set_attribute($timestamp,$expressions) {
        $this->class_expressions    = $expressions;
        $this->class_timestamp      = $timestamp;
        $this->exp_array            = $this->get_related_expressions();
    }
    /**
     * Get difference between request seconds and const second.
     *
     * @return int
     */
    public function get_difference() : int
    {
        return $this->class_timestamp - $this->default_amount;
    }

    /**
     * Check key exist or not
     *
     * @return bool
     */
    public function search_key($haystack,$needle) : bool {
        return strpos("z".$haystack, $needle);
    }
    /**
     * Delete expression after calculating.
     * @param $value of expression
     * @return void
     */
    public function delete_expression($needle)
    {
        if (($search_key = array_search($needle, $this->class_expressions)) !== false) {
            unset($this->class_expressions[$search_key]);
        }
    }
    /**
     * Get expressions same name and sort of them.
     *
     * @return array
     */
    public function get_related_expressions() : array
    {
        $exp_array = [];
        foreach ($this->class_expressions as $expression) {
            if ($this->search_key($expression,$this->exp)){
                $exp_array[explode($this->exp,$expression)[0] ?: 1 ] = $expression;
            }
        }
        krsort($exp_array);
        return $exp_array;
    }
    /**
     * return remain time for calculating expressions when result positive number.
     *
     * @return
     */
    public function set_positive_result()
    {
        if (!empty($this->exp_array)){
            foreach ($this->exp_array as $key => $item) {
                $this->delete_expression($item);
                $exp_result         = $key == 1 || empty($key) ? $this->exp ." = 0|": $key . $this->exp . " = 0|";
                $remain_time        = $this->class_timestamp;
                if ($this->class_timestamp >= $key * $this->default_amount){
                    $times          = ($key * $this->default_amount);
                    $ceil           = !empty($this->class_expressions) ? floor($this->class_timestamp / $times) : $this->class_timestamp / $times;
                    $remain_time    = !empty($this->class_expressions) ? $this->class_timestamp - ($ceil * $times) : 0;
                    $exp_result     = $key == 1 || empty($key) ? $this->exp . " = " . $ceil . "|" : $key . $this->exp . " = " . $ceil . "|";
                }
                return [
                    "remain_time"   => $remain_time,
                    "expression"    => $exp_result,
                    "exp_array"     => $this->class_expressions
                ];
            }
        }
        return false;
    }

    /**
     * return remain time for calculating expressions when result negative number.
     *
     * @return
     */
    public function set_negative_result()
    {
        if (!empty($this->exp_array)){
            foreach ($this->exp_array as $key => $item) {
                $this->delete_expression($item);
                $exp_result = $key == 1 || empty($key) ? $this->exp ." = 0|": $key . $this->exp . " = 0|";

                if (empty($this->class_expressions)){
                    $times                  = ($key * $this->default_amount);
                    $ceil                   = $this->class_timestamp / $times;
                    $exp_result             = $key == 1 || empty($key) ? $this->exp . " = " . $ceil . "|" : $key . $this->exp . " = " . $ceil . "|";
                    $this->class_timestamp  = 0;
                }

                return [
                    "remain_time"   => $this->class_timestamp,
                    "expression"    => $exp_result,
                    "exp_array"     => $this->class_expressions
                ];
            }
        }
        return false;
    }

    public function checkRemainTime($minus)
    {
        return $minus >= 0 ? $this->set_positive_result() : $this->set_negative_result();
    }

}
